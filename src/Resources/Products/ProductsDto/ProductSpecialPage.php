<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** A special listing. `$max` is the page size applied; `$status` is `success` on a per-customer
 *  answer with no rows, and absent otherwise. */
final class ProductSpecialPage extends Dto
{
    /** @param list<ProductSpecial|null>|null $products */
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $total = null,
        public readonly ?int $max = null,
        public readonly ?int $offset = null,
        #[ListOf(ProductSpecial::class)]
        public readonly ?array $products = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
