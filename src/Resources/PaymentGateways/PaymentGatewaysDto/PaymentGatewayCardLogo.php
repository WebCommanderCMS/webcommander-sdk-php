<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The card logos shown at checkout. */
final class PaymentGatewayCardLogo extends Dto
{
    /** @param list<string>|null $cards */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?array $cards = null,
        public readonly mixed $customImage = null,
    ) {
    }
}
