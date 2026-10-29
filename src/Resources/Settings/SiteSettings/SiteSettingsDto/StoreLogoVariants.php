<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/**
 * The `store_logo.variants` block - the logos for dark backgrounds and the sticky header.
 * Both read null while the main logo is used; a set variant's shape has not been measured.
 */
final class StoreLogoVariants extends Dto
{
    public function __construct(
        public readonly mixed $darkBackground = null,
        public readonly mixed $stickyHeader = null,
    ) {
    }
}
