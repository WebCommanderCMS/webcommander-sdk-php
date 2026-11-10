<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One product's reviews; the listing has no paging block. */
final class ProductReviewList extends Dto
{
    /** @param list<ProductReview|null>|null $reviews */
    public function __construct(
        #[ListOf(ProductReview::class)]
        public readonly ?array $reviews = null,
    ) {
    }
}
