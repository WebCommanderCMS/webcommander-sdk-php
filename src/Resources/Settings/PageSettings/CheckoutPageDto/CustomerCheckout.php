<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `customer_checkout` section: who may check out and how; turning off sign-in, sign-up and
 *  guest checkout all at once is `400`. */
final class CustomerCheckout extends Dto
{
    public const ENVELOPE_KEY = 'customer_checkout';

    public function __construct(
        public readonly ?bool $allowSignIn = null,
        public readonly ?SignUp $allowSignUp = null,
        public readonly ?GuestCheckout $checkoutAsGuest = null,
        public readonly ?bool $newsletterSubscription = null,
        public readonly ?bool $multipleShippingMethods = null,
    ) {
    }
}
