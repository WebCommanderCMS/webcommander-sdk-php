<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways\PaymentGatewaysDto;

use WebCommander\Client\Dto;

/** The surcharge block, null on gateways without one, and its write; `$percentAmount` reads null
 *  when no percentage is set. Each range stays a map of `id`, `from`, `to` and `amount`. */
final class PaymentGatewaySurcharge extends Dto
{
    /** @param list<array<string,mixed>>|null $ranges */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?float $flatAmount = null,
        public readonly ?float $percentAmount = null,
        public readonly ?array $ranges = null,
    ) {
    }
}
