<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `brand_kit.colors` block: six roles, each a hex colour; one that does not parse is `400`. */
final class BrandColors extends Dto
{
    public function __construct(
        public readonly ?string $accent = null,
        public readonly ?string $background = null,
        public readonly ?string $primary = null,
        public readonly ?string $secondary = null,
        public readonly ?string $surface = null,
        public readonly ?string $text = null,
    ) {
    }
}
