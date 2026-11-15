<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The add-lines body. Adding a product already on the cart raises that line's quantity. */
final class AdminCartItemsInput extends Dto
{
    /** @param list<AdminCartProductInput|null>|null $products */
    public function __construct(
        #[ListOf(AdminCartProductInput::class)]
        public readonly ?array $products = null,
    ) {
    }
}
