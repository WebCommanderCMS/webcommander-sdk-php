<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: full product records, where they sit and any schema. */
final class ProductPage extends Dto
{
    /** @param list<Product|null>|null $products */
    public function __construct(
        #[ListOf(Product::class)]
        public readonly ?array $products = null,
        public readonly ?Pagination $pagination = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
