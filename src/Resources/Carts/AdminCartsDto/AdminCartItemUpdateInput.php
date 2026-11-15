<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The line update body: the new `$quantity`, required. */
final class AdminCartItemUpdateInput extends Dto
{
    public function __construct(
        public readonly ?int $quantity = null,
    ) {
    }
}
