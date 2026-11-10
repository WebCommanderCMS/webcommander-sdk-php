<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One custom code block and whether it is on. */
final class ProductSeoCode extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $code = null,
    ) {
    }
}
