<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The type one option of a combination belongs to. */
final class ProductCombinationOptionType extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $role = null,
        public readonly ?string $name = null,
        public readonly ?string $standard = null,
        public readonly ?bool $isDisposable = null,
    ) {
    }
}
