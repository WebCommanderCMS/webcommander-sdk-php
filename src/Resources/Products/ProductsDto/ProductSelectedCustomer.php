<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One customer an audience names: `id` is the customer's `customer_id`, `internal_id` its
 *  `internal_id`. */
final class ProductSelectedCustomer extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $internalId = null,
        public readonly ?string $name = null,
    ) {
    }
}
