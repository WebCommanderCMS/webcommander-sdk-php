<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** A cart: what every cart call but the deletes answers. */
final class AdminCart extends Dto
{
    public const ENVELOPE_KEY = 'cart';

    /** @param list<AdminCartItem|null>|null $items */
    public function __construct(
        public readonly ?AdminCartSession $session = null,
        public readonly ?AdminCartCustomer $customer = null,
        public readonly ?string $currencyCode = null,
        #[ListOf(AdminCartItem::class)]
        public readonly ?array $items = null,
        public readonly ?AdminCartTotals $totals = null,
    ) {
    }
}
