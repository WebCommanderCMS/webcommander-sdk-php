<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One cart: the answer of the add, the read and the line update. `$groupMeta` is read from beside
 *  the envelope, and only the read sends it. */
final class Cart extends Dto
{
    public const ENVELOPE_KEY = 'cart';

    /** @param list<CartItem|null>|null $items */
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?string $sessionId = null,
        public readonly ?string $currencyCode = null,
        public readonly ?string $currencySymbol = null,
        public readonly ?string $deliveryType = null,
        public readonly ?CartTotals $totals = null,
        public readonly ?CartShipping $shipping = null,
        #[ListOf(CartItem::class)]
        public readonly ?array $items = null,
        public readonly ?CartDiscount $discount = null,
        public readonly ?CartMessages $messages = null,
        public readonly ?GroupMeta $groupMeta = null,
    ) {
    }
}
