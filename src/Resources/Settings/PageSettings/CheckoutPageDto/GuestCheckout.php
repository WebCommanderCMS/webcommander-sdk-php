<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `checkout_as_guest` block: ordering without an account, and a one-click sign-up offer. */
final class GuestCheckout extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $quickSignup = null,
    ) {
    }
}
