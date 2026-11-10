<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The top-up's answer. `$transactionNo` is the product's own from before the write, `null` on its
 *  first top-up, though the header is stored on the product by then. */
final class ProductInventoryResult extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?string $message = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
