<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The review import's body: `{"product": {"reviews": [...]}}` with `transaction_no` beside the
 *  envelope; `reviews` must not be empty. */
final class ProductReviewsImportInput extends Dto
{
    public const ENVELOPE_KEY = 'product';

    public const TOP_LEVEL = ['transaction_no'];

    /** @param list<ProductReviewInput|null>|null $reviews */
    public function __construct(
        #[ListOf(ProductReviewInput::class)]
        public readonly ?array $reviews = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
