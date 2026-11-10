<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The stock patch's body, no envelope. `tracking` merges; `locations` sets the stock per location; `note` and `transaction_no` go on the adjustment. */
final class ProductStockPatchInput extends Dto
{
    /** @param list<ProductStockLocationInput|null>|null $locations */
    public function __construct(
        public readonly ?ProductStockTracking $tracking = null,
        #[ListOf(ProductStockLocationInput::class)]
        public readonly ?array $locations = null,
        public readonly ?string $note = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
