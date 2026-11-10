<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The session block. `$sessionId` starts `PRV-` and is the `$previewSessionId` of every other call. `$expiresAt` is 30 minutes after `$createdAt`; a coupon or gift card call, applying or removing, moves it 30 minutes past that call, and a read does not. */
final class PreviewSession extends Dto
{
    public function __construct(
        public readonly ?string $sessionId = null,
        public readonly ?string $status = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $expiresAt = null,
    ) {
    }
}
