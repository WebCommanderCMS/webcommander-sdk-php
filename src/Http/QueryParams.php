<?php

declare(strict_types=1);

namespace WebCommander\Http;

use WebCommander\Errors\SdkUsageError;

final class QueryParams
{
    /** @param array<string,mixed>|null $params
     *  @return array<string,mixed> */
    public static function build(?array $params): array
    {
        if ($params === null) {
            return [];
        }
        $normalised = [];
        foreach ($params as $key => $value) {
            if ($value === null) {
                continue;
            }
            $normalised[$key] = self::normalizeValue($value, (string) $key, 0);
        }
        return $normalised;
    }

    private static function normalizeValue(mixed $value, string $key, int $depth): mixed
    {
        if (is_array($value) && !array_is_list($value) && $value !== []) {
            throw new SdkUsageError(
                "query param '{$key}': nested objects cannot be encoded in a query string; "
                . 'flatten it or send it in the body'
            );
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if ($value instanceof \BackedEnum) {
            return self::normalizeValue($value->value, $key, $depth);
        }
        if ($value instanceof \DateTimeInterface) {
            return self::isoTime($value);
        }
        if (is_array($value) || $value instanceof \Traversable) {
            if ($depth >= 1) {
                throw new SdkUsageError(
                    "query param '{$key}': a sequence inside a sequence has no query-string "
                    . 'encoding; flatten it to one list of scalars'
                );
            }
            $items = is_array($value) ? $value : iterator_to_array($value, false);
            $out = [];
            foreach ($items as $entry) {
                if ($entry === null) {
                    continue;
                }
                $out[] = self::normalizeValue($entry, $key, $depth + 1);
            }
            return $out;
        }
        if (is_object($value) || is_resource($value)) {
            throw new SdkUsageError(
                "query param '{$key}': " . get_debug_type($value) . ' has no query-string form; '
                . 'pass a scalar, a DateTimeInterface, a BackedEnum, or a list of those'
            );
        }
        return $value;
    }

    /** An ISO 8601 instant that keeps the sub-second precision it was given. */
    private static function isoTime(\DateTimeInterface $value): string
    {
        return $value->format(((int) $value->format('u')) === 0 ? 'Y-m-d\TH:i:sP' : 'Y-m-d\TH:i:s.uP');
    }
}
