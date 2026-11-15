<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The checkout. The read and the update answer every field; the coupon, gift card and delivery schedule calls answer the parts they change. `$deliverySchedule` is null until one is set. */
final class AdminCheckout extends Dto
{
    public const ENVELOPE_KEY = 'checkout';

    /**
     *  @param list<AdminCartItem|null>|null $items
     *  @param list<CheckoutIssue|null>|null $issues */
    public function __construct(
        public readonly ?AdminCartSession $session = null,
        public readonly ?AdminCartCustomer $customer = null,
        public readonly ?string $deliveryType = null,
        public readonly ?string $currencyCode = null,
        #[ListOf(AdminCartItem::class)]
        public readonly ?array $items = null,
        public readonly ?CheckoutAddress $billingAddress = null,
        public readonly ?CheckoutAddress $shippingAddress = null,
        public readonly ?CheckoutShipping $shipping = null,
        public readonly ?CheckoutDiscounts $discounts = null,
        public readonly mixed $deliverySchedule = null,
        public readonly ?CheckoutTotals $totals = null,
        #[ListOf(CheckoutIssue::class)]
        public readonly ?array $issues = null,
    ) {
    }
}
