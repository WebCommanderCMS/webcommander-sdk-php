<?php

declare(strict_types=1);

namespace WebCommander\Auth;

/** In-process token storage, isolated per instance; the refresh lock is a no-op handle. */
final class MemoryTokenStore implements TokenStore
{
    /** @var array<string,mixed>|null */
    private ?array $record = null;

    /** @return array<string,mixed>|null */
    public function readTokenRecord(): ?array
    {
        return $this->record;
    }

    /** @param array<string,mixed> $record */
    public function writeTokenRecord(array $record): void
    {
        $this->record = $record;
    }

    public function clearTokenRecord(): void
    {
        $this->record = null;
    }

    public function acquireTokenRefreshLock(): TokenRefreshLock
    {
        return new class implements TokenRefreshLock {
            public function release(): void
            {
            }
        };
    }
}
