<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class CheckoutPage extends Dto
{
    public const ENVELOPE_KEY = 'checkout_page';

    public function __construct(
        public readonly ?BillingAddress $billingAddress = null,
        public readonly ?ShippingAddress $shippingAddress = null,
        public readonly ?CustomerCheckout $customerCheckout = null,
        public readonly ?DeliveryOptions $deliveryOptions = null,
        public readonly ?OrderSummary $orderSummary = null,
        public readonly ?Others $others = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
