<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The import's body, no envelope; `variations` must not be empty. */
final class ProductVariationsImportInput extends Dto
{
    /** @param list<ProductVariationGroupInput|null>|null $variations */
    public function __construct(
        #[ListOf(ProductVariationGroupInput::class)]
        public readonly ?array $variations = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
