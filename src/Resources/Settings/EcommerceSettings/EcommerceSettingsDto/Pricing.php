<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** The `pricing` section: purchase floors, credit and payment terms. Its `depends_on` switches are
 *  enforced, and the three amounts are typed as the numbers the body sends. */
final class Pricing extends Dto
{
    public const ENVELOPE_KEY = 'pricing';

    public function __construct(
        public readonly ?bool $updatePriceRange = null,
        public readonly ?bool $enableMinimumPurchaseAmount = null,
        public readonly ?float $minimumPurchaseAmount = null,
        public readonly ?bool $enableMinimumPurchaseAmountInCart = null,
        public readonly ?float $minimumPurchaseAmountInCart = null,
        public readonly ?bool $enableOnAccountPurchase = null,
        public readonly ?bool $assignCreditLimitPerOrder = null,
        public readonly ?float $creditLimitPerOrder = null,
        public readonly ?bool $enablePaymentTerms = null,
        public readonly ?string $paymentTerms = null,
        public readonly ?bool $enableCustomerPriceRestriction = null,
    ) {
    }
}
