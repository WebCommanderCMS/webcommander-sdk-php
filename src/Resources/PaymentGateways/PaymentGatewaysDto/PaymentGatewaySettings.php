<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The row read's gateway-specific `settings`, every key any gateway answers; each gateway fills
 *  its own few and offline gateways answer `{}`. */
final class PaymentGatewaySettings extends Dto
{
    public function __construct(
        public readonly ?string $version = null,
        public readonly ?string $mode = null,
        public readonly ?PaymentGatewayPayPalStandard $standard = null,
        public readonly ?PaymentGatewayPayPalClassic $classic = null,
        public readonly ?PaymentGatewayCardProcessor $processor = null,
        public readonly ?PaymentGatewayCardLogo $cardLogo = null,
        public readonly ?PaymentGatewayGooglePay $googlePay = null,
        public readonly ?PaymentGatewayApplePay $applePay = null,
        public readonly ?PaymentGatewayExpressPayPal $paypal = null,
        public readonly ?bool $showInstallmentAmount = null,
        public readonly ?bool $showInProductDetails = null,
        public readonly ?string $apiKey = null,
        public readonly ?int $defaultTerm = null,
        public readonly ?float $amountPer100Points = null,
        public readonly ?string $merchantId = null,
        public readonly ?string $merchantSecretKey = null,
        public readonly mixed $image = null,
    ) {
    }
}
