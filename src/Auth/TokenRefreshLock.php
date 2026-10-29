<?php

declare(strict_types=1);

namespace WebCommander\Auth;

/** A held refresh lock, released in a try/finally. */
interface TokenRefreshLock
{
    public function release(): void;
}
