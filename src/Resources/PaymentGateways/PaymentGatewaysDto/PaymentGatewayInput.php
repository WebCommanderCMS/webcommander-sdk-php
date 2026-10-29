<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The writable fields, for the `PUT` and the `PATCH`; no envelope. `$zone` takes a zone's id or
 *  `{"id": ...}`; `code` and `promotional` are read-only. */
final class PaymentGatewayInput extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?bool $added = null,
        public readonly ?bool $enabled = null,
        public readonly ?bool $default = null,
        public readonly int|PaymentGatewayReference|null $zone = null,
        public readonly ?string $information = null,
        public readonly ?PaymentGatewayVisibilityInput $visibility = null,
        public readonly ?PaymentGatewayAllowedFor $allowedFor = null,
        public readonly ?PaymentGatewaySurcharge $surcharge = null,
        public readonly ?PaymentGatewayMessages $messages = null,
        public readonly ?PaymentGatewaySettings $settings = null,
    ) {
    }
}
