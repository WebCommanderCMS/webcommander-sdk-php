<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `brand_kit` section, the site-wide palette. */
final class BrandKit extends Dto
{
    public const ENVELOPE_KEY = 'brand_kit';

    public function __construct(
        public readonly ?BrandColors $colors = null,
        public readonly ?bool $enabled = null,
        public readonly ?string $paletteName = null,
    ) {
    }
}
