<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** `password_protected` and `password` again; a set password reads `***`. */
final class ProductPasswordProtection extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $password = null,
    ) {
    }
}
