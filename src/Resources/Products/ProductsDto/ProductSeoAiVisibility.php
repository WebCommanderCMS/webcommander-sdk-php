<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** What the product offers AI search; each field is `null` until set. */
final class ProductSeoAiVisibility extends Dto
{
    public function __construct(
        public readonly mixed $structuredAttributes = null,
        public readonly mixed $productFaq = null,
        public readonly mixed $citabilityScore = null,
        public readonly mixed $jsonLd = null,
    ) {
    }
}
