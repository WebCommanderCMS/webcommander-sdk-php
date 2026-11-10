<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The Google Ads conversion the product page reports. */
final class ProductSeoGoogleAds extends Dto
{
    public function __construct(
        public readonly ?string $conversionId = null,
        public readonly ?string $conversionLabel = null,
    ) {
    }
}
