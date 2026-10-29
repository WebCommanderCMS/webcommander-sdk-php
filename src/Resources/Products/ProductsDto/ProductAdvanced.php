<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The advanced block. */
final class ProductAdvanced extends Dto
{
    /** @param list<mixed>|null $metaTags */
    public function __construct(
        public readonly ?ProductAdvanceInformation $advanceInformation = null,
        public readonly ?bool $webtoolDisableTracking = null,
        public readonly ?array $metaTags = null,
        public readonly ?ProductFlags $productFlags = null,
        public readonly ?ProductDimension $productDimension = null,
        public readonly ?ProductIdentifiers $productIdentifiers = null,
        public readonly ?ProductWebtool $webtool = null,
    ) {
    }
}
