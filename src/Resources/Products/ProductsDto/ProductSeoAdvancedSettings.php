<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The robots and canonical URL settings. */
final class ProductSeoAdvancedSettings extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $robotsMeta = null,
        public readonly ?string $canonicalUrl = null,
    ) {
    }
}
