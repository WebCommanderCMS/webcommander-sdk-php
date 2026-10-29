<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** An audience to write: customer and group ids. A group written as `{"id": ...}` is `400`. */
final class ProductSelectedCustomersInput extends Dto
{
    /** @param list<int|null>|null $customers
     *  @param list<int|null>|null $groups */
    public function __construct(
        public readonly ?array $customers = null,
        public readonly ?array $groups = null,
    ) {
    }
}
