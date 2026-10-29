<?php

declare(strict_types=1);

namespace WebCommander\Auth;

/** Token persistence and refresh coordination; a store moves plain arrays. */
interface TokenStore
{
    /** The stored token, or null when nothing is cached; a store that cannot read a cache it
     *  does have raises rather than answering null.
     *  @return array<string,mixed>|null */
    public function readTokenRecord(): ?array;

    /** @param array<string,mixed> $record */
    public function writeTokenRecord(array $record): void;

    public function clearTokenRecord(): void;

    public function acquireTokenRefreshLock(): TokenRefreshLock;
}
