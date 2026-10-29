<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** A flag and the label shown with it. */
final class ProductFlag extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $label = null,
    ) {
    }
}
