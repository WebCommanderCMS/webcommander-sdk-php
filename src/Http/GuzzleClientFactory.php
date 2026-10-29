<?php

declare(strict_types=1);

namespace WebCommander\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlFactory;
use GuzzleHttp\Handler\CurlMultiHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\RequestOptions;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use WebCommander\Config\SdkConfig;
use WebCommander\Redaction;

/** Builds the default Guzzle client: redirects never followed, verify from the config,
 *  connect/read timeouts, proxy, and 4xx/5xx returned as responses rather than thrown. */
final class GuzzleClientFactory
{
    public static function create(SdkConfig $config): ClientInterface
    {
        [$connect, $read] = $config->timeout();
        $handler = HandlerStack::create(new CurlMultiHandler([
            'handle_factory' => new CurlFactory($config->poolMaxsize),
        ]));
        $handler->push(self::capResponseBytes($config->maxResponseBytes), 'wc_response_cap');
        $options = [
            RequestOptions::ALLOW_REDIRECTS => false,
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::VERIFY => $config->caBundle ?? $config->verifySsl,
            RequestOptions::TIMEOUT => $read,
            RequestOptions::CONNECT_TIMEOUT => $connect,
            'handler' => $handler,
        ];
        if ($config->proxyUrl !== null && $config->proxyUrl !== '') {
            $options[RequestOptions::PROXY] = $config->proxyUrl;
        }
        return new Client($options);
    }

    public static function factory(): HttpFactory
    {
        return new HttpFactory();
    }

    /** An empty php://temp stream. */
    public static function newSpool(): StreamInterface
    {
        return Utils::streamFor(Utils::tryFopen('php://temp', 'r+'));
    }

    /** A fresh sink per request: it holds the running total. */
    private static function capResponseBytes(int $cap): callable
    {
        return static fn (callable $next): callable =>
            static function (RequestInterface $request, array $options) use ($next, $cap) {
                $sink = new CappedSink(self::newSpool(), $cap);
                $declared = null;
                // redacted here so the URI never reaches an exception trace
                $method = $request->getMethod();
                $redactedUrl = Redaction::redactText((string) $request->getUri());
                $options[RequestOptions::SINK] = $sink;
                $options[RequestOptions::ON_HEADERS] = static function (
                    ResponseInterface $response
                ) use ($method, $redactedUrl, $cap, &$declared): void {
                    $header = $response->getHeaderLine('Content-Length');
                    if ($header === '' || !ctype_digit($header) || (int) $header <= $cap) {
                        return;
                    }
                    $declared = (int) $header;
                    // A throw is the only way to tell curl to stop before the body starts.
                    throw new ResponseTooLargeException($method, $redactedUrl, $cap, $declared, null);
                };

                return $next($request, $options)->otherwise(
                    static function (\Throwable $failure) use ($method, $redactedUrl, $cap, $sink, &$declared) {
                        if ($declared !== null) {
                            throw new ResponseTooLargeException($method, $redactedUrl, $cap, $declared, null);
                        }
                        if ($sink->exceeded()) {
                            throw new ResponseTooLargeException($method, $redactedUrl, $cap, null, $sink->accepted());
                        }
                        throw $failure;
                    }
                );
            };
    }
}
