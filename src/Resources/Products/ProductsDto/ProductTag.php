<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One tag on the product, with its values. */
final class ProductTag extends Dto
{
    /** @param list<ProductTagValue|null>|null $values */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $tagId = null,
        public readonly ?string $name = null,
        #[ListOf(ProductTagValue::class)]
        public readonly ?array $values = null,
        public readonly ?bool $displayInProductPage = null,
        public readonly ?bool $enableExpandedView = null,
    ) {
    }
}
