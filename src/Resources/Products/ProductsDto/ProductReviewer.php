<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Who wrote a review; `name` and `email` again. */
final class ProductReviewer extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $email = null,
    ) {
    }
}
