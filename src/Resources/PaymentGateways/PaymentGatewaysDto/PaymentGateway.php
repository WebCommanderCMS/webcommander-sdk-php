<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** One gateway: a listing row, and the row path's and every write's body, which add `$settings`. */
final class PaymentGateway extends Dto
{
    public const ENVELOPE_KEY = 'payment_gateway';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?bool $added = null,
        public readonly ?bool $enabled = null,
        public readonly ?bool $default = null,
        public readonly ?bool $promotional = null,
        public readonly ?PaymentGatewayReference $zone = null,
        public readonly ?string $information = null,
        public readonly ?PaymentGatewayVisibility $visibility = null,
        public readonly ?PaymentGatewayAllowedFor $allowedFor = null,
        public readonly ?PaymentGatewaySurcharge $surcharge = null,
        public readonly ?PaymentGatewayMessages $messages = null,
        public readonly ?PaymentGatewaySettings $settings = null,
    ) {
    }
}
