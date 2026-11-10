<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRates\ShippingRatesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One rate, the same fourteen keys on a listing row, the row read and every write's answer, whatever the method. `$method` is `flat_rate`, `free_shipping`, `ship_by_price`, `ship_by_quantity`, `ship_by_weight`, `ship_by_variation` or `shipping_variant`. A flat rate carries `$shippingCost` and `$handlingCost`, the `ship_by_*` methods carry them per row in `$conditions`, and a key the method does not use reads null or an empty list. `$weightUnit` is the store's, null unless the method is `ship_by_weight`. Each condition row stays an array. */
final class ShippingRate extends Dto
{
    public const ENVELOPE_KEY = 'shipping_rate';

    /** @param list<ShippingReference|null>|null $shippingRules */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $method = null,
        public readonly ?bool $calculateForEntireOrder = null,
        public readonly ?bool $priceEnteredWithTax = null,
        public readonly ?ShippingCost $shippingCost = null,
        public readonly ?ShippingCost $handlingCost = null,
        public readonly ?string $weightUnit = null,
        public readonly ?array $conditions = null,
        public readonly ?ShippingAdditionalRule $additionalRule = null,
        #[ListOf(ShippingReference::class)]
        public readonly ?array $shippingRules = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
