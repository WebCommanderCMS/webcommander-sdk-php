<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** One review to add: `name`, `email` and a `rating` of 1 to 5 are required, and `dateCreated` is
 *  `yyyy-MM-ddTHH:mm:ss`. */
final class ProductReviewInput extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?float $rating = null,
        public readonly ?string $review = null,
        public readonly ?string $comment = null,
        public readonly ?string $status = null,
        #[WireName('dateCreated')]
        public readonly ?string $dateCreated = null,
    ) {
    }
}
