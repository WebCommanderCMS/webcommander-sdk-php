<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `image` record of either media section; `height`, `width` and `size_bytes` are not always sent. */
final class MediaImage extends Dto
{
    public function __construct(
        public readonly ?string $contentType = null,
        public readonly ?string $fileName = null,
        public readonly ?int $height = null,
        public readonly ?int $sizeBytes = null,
        public readonly ?string $url = null,
        public readonly ?int $width = null,
    ) {
    }
}
