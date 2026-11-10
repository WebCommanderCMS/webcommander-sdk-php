<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** What an upload answers: `$product` holds the files just stored, `$transactionNo` is the
 *  product's own. */
final class ProductMediaUploaded extends Dto
{
    public function __construct(
        public readonly ?ProductImageAndVideo $product = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
