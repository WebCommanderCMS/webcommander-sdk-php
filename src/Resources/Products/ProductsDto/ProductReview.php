<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** One review. `product_id`, `comment` and `created_at` repeat `productId`, `review` and `date`;
 *  `created_at` carries a `Z`. `$productIdSnake` reads `product_id`, `$productId` the camelCase
 *  `productId`. */
final class ProductReview extends Dto
{
    /** @param list<mixed>|null $files */
    public function __construct(
        public readonly ?int $id = null,
        #[WireName('productId')]
        public readonly ?int $productId = null,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?string $review = null,
        public readonly ?float $rating = null,
        public readonly ?string $date = null,
        public readonly ?string $status = null,
        public readonly ?array $files = null,
        #[WireName('product_id')]
        public readonly ?int $productIdSnake = null,
        public readonly ?ProductReviewer $reviewer = null,
        public readonly ?string $comment = null,
        public readonly ?string $createdAt = null,
    ) {
    }
}
