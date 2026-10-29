<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

/** The read-only `billing_address` section. */
final class BillingAddress extends AddressForm
{
    public const ENVELOPE_KEY = 'billing_address';
}
