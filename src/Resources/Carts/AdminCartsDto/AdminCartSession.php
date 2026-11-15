<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The session block. `$sessionId` starts `PRV-` and is the `$sessionId` of every other call. `$expiresAt` is 30 minutes after the last write. */
final class AdminCartSession extends Dto
{
    public function __construct(
        public readonly ?string $sessionId = null,
        public readonly ?string $status = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $expiresAt = null,
    ) {
    }
}
