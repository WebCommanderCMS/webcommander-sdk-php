<?php

declare(strict_types=1);

namespace WebCommander\Client;

use WebCommander\Errors\SdkError;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Http\QueryParams;
use WebCommander\Http\Transport;
use WebCommander\Http\UrlBuilder;

final class Pagination
{
    private const PAGINATION_KEY = 'pagination';
    private const NEXT_PAGE_KEY = 'next_page';

    /** @param array<string,mixed>|null $queryParams
     *  @return \Generator<int,ApiResponse> */
    public static function iterPages(
        object $client,
        string $path,
        ?array $queryParams = null,
        ?int $maxPages = null,
        bool $raiseOnError = true,
    ): \Generator {
        if ($maxPages !== null && $maxPages < 1) {
            throw new SdkUsageError("maxPages: expected a positive integer or null, got {$maxPages}");
        }

        // Seeded first, or a next_page pointing back at page one yields it twice.
        $visited = [];
        $firstPage = self::canonicalKey(self::resolveFirstPageUrl($client, $path, $queryParams));
        if ($firstPage !== null) {
            $visited[$firstPage] = true;
        }
        $pagesYielded = 0;
        $response = $client->sendGetRequest($path, queryParams: $queryParams, raiseOnError: $raiseOnError);
        while (true) {
            yield $response;
            $pagesYielded++;
            if (!$response->succeeded()) {
                return;
            }
            if ($maxPages !== null && $pagesYielded >= $maxPages) {
                return;
            }
            // `map`, never `data`: paging works the same whatever responseFormat is set.
            $nextPage = self::readNextPage($response->map);
            if ($nextPage === null) {
                return;
            }
            $key = self::canonicalKey($nextPage);
            if (isset($visited[$key])) {
                // The link is not named: it carries the record id and the search terms.
                throw new SdkError(
                    'pagination loop: next_page repeats a page already fetched, at page ' . ($pagesYielded + 1)
                );
            }
            $visited[$key] = true;
            $response = $client->sendGetRequest($nextPage, raiseOnError: $raiseOnError);
        }
    }

    /** Null for a client that cannot be asked how it resolves a path.
     *  @param array<string,mixed>|null $queryParams */
    private static function resolveFirstPageUrl(object $client, string $path, ?array $queryParams): ?string
    {
        if (!method_exists($client, 'config')) {
            return null;
        }
        try {
            $config = $client->config();
            $apiVersion = $config->apiVersion;
            $resolved = in_array('api_version', UrlBuilder::findPathParamNames($path), true)
                ? UrlBuilder::substitutePathParams($path, ['api_version' => $apiVersion])
                : $path;
            $url = UrlBuilder::buildUrl($config->baseUrl(), $resolved);
            $query = Transport::encodeQuery(QueryParams::build($queryParams));
        } catch (\Throwable) {
            // The request itself is about to make the same attempt and report it.
            return null;
        }
        return $query === '' ? $url : $url . (str_contains($url, '?') ? '&' : '?') . $query;
    }

    /** Private comparison state, never printed. */
    private static function canonicalKey(?string $url): ?string
    {
        if ($url === null || trim($url) === '') {
            return null;
        }
        $parts = parse_url($url);
        if ($parts === false) {
            return $url;
        }
        $scheme = strtolower($parts['scheme'] ?? '');
        $host = strtolower($parts['host'] ?? '');
        $port = $parts['port'] ?? null;
        if ($port === (UrlBuilder::IMPLIED_PORTS[$scheme] ?? null)) {
            $port = null;
        }
        $pairs = [];
        if (isset($parts['query']) && $parts['query'] !== '') {
            $pairs = explode('&', $parts['query']);
            sort($pairs);
        }
        return ($scheme === '' ? '' : $scheme . '://')
            . $host
            . ($port === null ? '' : ':' . $port)
            . ($parts['path'] ?? '')
            . ($pairs === [] ? '' : '?' . implode('&', $pairs));
    }

    /** @param array<string,mixed>|null $queryParams
     *  @return \Generator<int,mixed> */
    public static function iterRecords(
        object $client,
        string $path,
        string $recordKey,
        ?array $queryParams = null,
        ?int $maxPages = null,
    ): \Generator {
        if (trim($recordKey) === '') {
            throw new SdkUsageError("recordKey: expected the envelope key holding the records, like 'customers'");
        }
        foreach (self::iterPages($client, $path, $queryParams, $maxPages, true) as $page) {
            $records = self::recordsList($page, $recordKey);
            if ($records === null) {
                $available = is_array($page->map)
                    ? implode(', ', array_map('strval', array_keys($page->map)))
                    : 'a ' . get_debug_type($page->map) . ' body';
                throw new SdkUsageError(
                    "recordKey '{$recordKey}': this page has no list under that key; it carries {$available}"
                );
            }
            // Not `yield from`: it reuses the source keys, losing all but the last page.
            foreach ($records as $record) {
                yield $record;
            }
        }
    }

    /** The list under $recordKey; an empty JSON object is not a list.
     *  @return list<mixed>|null */
    private static function recordsList(ApiResponse $page, string $recordKey): ?array
    {
        $body = $page->map;
        $records = is_array($body) ? ($body[$recordKey] ?? null) : null;
        if (!is_array($records) || !array_is_list($records)) {
            return null;
        }
        if ($records !== [] || !self::emptyObjectUnderKey($page->json, $recordKey)) {
            return $records;
        }
        return null;
    }

    private static function emptyObjectUnderKey(?string $bodyText, string $recordKey): bool
    {
        if ($bodyText === null || $bodyText === '') {
            return false;
        }
        $decoded = json_decode($bodyText);
        return $decoded instanceof \stdClass && ($decoded->{$recordKey} ?? null) instanceof \stdClass;
    }

    private static function readNextPage(mixed $data): ?string
    {
        if (!is_array($data)) {
            return null;
        }
        $pagination = $data[self::PAGINATION_KEY] ?? null;
        if (!is_array($pagination)) {
            return null;
        }
        $nextPage = $pagination[self::NEXT_PAGE_KEY] ?? null;
        return is_string($nextPage) && trim($nextPage) !== '' ? $nextPage : null;
    }
}
