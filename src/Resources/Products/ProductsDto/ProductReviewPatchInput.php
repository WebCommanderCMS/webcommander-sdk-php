<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The review moderation body, no envelope; `$status` is `pending` or `approved`. */
final class ProductReviewPatchInput extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?float $rating = null,
        public readonly ?string $comment = null,
    ) {
    }
}
