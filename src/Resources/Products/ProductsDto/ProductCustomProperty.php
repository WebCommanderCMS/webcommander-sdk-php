<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One custom property. */
final class ProductCustomProperty extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $label = null,
        public readonly ?string $description = null,
    ) {
    }
}
