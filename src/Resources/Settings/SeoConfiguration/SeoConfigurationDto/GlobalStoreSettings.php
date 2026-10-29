<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** The `global_store_settings` section: the `{site_name}` store name, the title separator and one
 *  `SeoTemplates` block per content type. */
final class GlobalStoreSettings extends Dto
{
    public const ENVELOPE_KEY = 'global_store_settings';

    public function __construct(
        public readonly ?string $storeName = null,
        public readonly ?string $titleSeparator = null,
        public readonly ?SeoTemplates $pages = null,
        public readonly ?SeoTemplates $products = null,
        public readonly ?SeoTemplates $categories = null,
    ) {
    }
}
