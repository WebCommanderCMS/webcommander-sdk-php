<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Google Analytics on the product page. */
final class ProductSeoGoogleAnalytics extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $measurementId = null,
        public readonly ?ProductSeoGoogleAnalyticsEvents $events = null,
    ) {
    }
}
