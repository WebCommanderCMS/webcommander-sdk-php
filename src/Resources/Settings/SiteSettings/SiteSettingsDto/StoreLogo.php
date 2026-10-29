<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `store_logo` section; `image` is read-only. */
final class StoreLogo extends Dto
{
    public const ENVELOPE_KEY = 'store_logo';

    public function __construct(
        public readonly ?MediaImage $image = null,
        public readonly ?StoreLogoVariants $variants = null,
    ) {
    }
}
