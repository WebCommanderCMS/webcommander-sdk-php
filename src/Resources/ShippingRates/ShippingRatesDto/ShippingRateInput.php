<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates\ShippingRatesDto;

use WebCommander\Client\Dto;

/** The writable fields, wrapped in `shipping_rate`, for the create, the `PUT` replace and the `PATCH`. `name` and `method` are required on a create; a flat rate also needs `$shippingCost` and the `ship_by_*` methods need `$conditions`, rows such as `{"from": 1, "to": 5, "shipping_cost": {...}, "handling_cost": {...}}`. `PUT` needs every field of the rate, `$handlingCost` and `$additionalRule` as null when unused: pass an array holding null for those. `$shippingRuleId` attaches the new rate to a rule that has none. A null field is not sent. */
final class ShippingRateInput extends Dto
{
    public const ENVELOPE_KEY = 'shipping_rate';

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $method = null,
        public readonly ?bool $calculateForEntireOrder = null,
        public readonly ?bool $priceEnteredWithTax = null,
        public readonly ?ShippingCost $shippingCost = null,
        public readonly ?ShippingCost $handlingCost = null,
        public readonly ?array $conditions = null,
        public readonly ?ShippingAdditionalRule $additionalRule = null,
        public readonly ?int $shippingRuleId = null,
        public readonly ?string $transactionNo = null,
        public readonly ?bool $suggestName = null,
    ) {
    }
}
