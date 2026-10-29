<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** Who `available_for: selected` admits, or whom a restriction names; both lists are empty when
 *  nobody is named. */
final class ProductSelectedCustomers extends Dto
{
    /** @param list<ProductSelectedCustomer|null>|null $customers
     *  @param list<ProductNamedReference|null>|null $groups */
    public function __construct(
        #[ListOf(ProductSelectedCustomer::class)]
        public readonly ?array $customers = null,
        #[ListOf(ProductNamedReference::class)]
        public readonly ?array $groups = null,
    ) {
    }
}
