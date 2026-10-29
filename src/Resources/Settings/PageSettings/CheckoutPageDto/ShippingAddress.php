<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

/** The read-only `shipping_address` section. */
final class ShippingAddress extends AddressForm
{
    public const ENVELOPE_KEY = 'shipping_address';
}
