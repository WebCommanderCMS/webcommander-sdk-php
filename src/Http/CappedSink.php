<?php

declare(strict_types=1);

namespace WebCommander\Http;

use GuzzleHttp\Psr7\StreamDecoratorTrait;
use Psr\Http\Message\StreamInterface;

/** The sink curl writes a response into, which stops accepting bytes at a limit. */
final class CappedSink implements StreamInterface
{
    use StreamDecoratorTrait;

    /** Declared rather than left to the trait, which assigns it dynamically (deprecated in 8.2). */
    private StreamInterface $stream;

    private int $written = 0;
    private bool $exceeded = false;

    public function __construct(StreamInterface $stream, private readonly int $cap)
    {
        $this->stream = $stream;
    }

    public function write($string): int
    {
        if ($this->exceeded) {
            return 0;
        }
        $length = strlen($string);
        if ($this->written + $length > $this->cap) {
            $this->exceeded = true;
            return 0;
        }
        $this->written += $length;
        return $this->stream->write($string);
    }

    public function exceeded(): bool
    {
        return $this->exceeded;
    }

    public function accepted(): int
    {
        return $this->written;
    }
}
