<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The product page's analytics settings. */
final class ProductSeoAnalytics extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $platform = null,
        public readonly ?ProductSeoGoogleAnalytics $googleAnalytics = null,
        public readonly ?ProductSeoFacebookPixel $facebookPixel = null,
        public readonly ?ProductSeoGoogleAds $googleAds = null,
    ) {
    }
}
