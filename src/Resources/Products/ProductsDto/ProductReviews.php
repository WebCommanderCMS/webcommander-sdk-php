<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The review import's answer: every review the product holds, the ones just added last. */
final class ProductReviews extends Dto
{
    public const ENVELOPE_KEY = 'product';

    /** @param list<ProductReview|null>|null $reviews */
    public function __construct(
        #[ListOf(ProductReview::class)]
        public readonly ?array $reviews = null,
    ) {
    }
}
