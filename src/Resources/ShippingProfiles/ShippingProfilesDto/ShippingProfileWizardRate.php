<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;

/** The rate a wizard rule creates; the fields of a rate write, `name` and `method` required. */
final class ShippingProfileWizardRate extends Dto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $method = null,
        public readonly ?bool $calculateForEntireOrder = null,
        public readonly ?bool $priceEnteredWithTax = null,
        public readonly mixed $shippingCost = null,
        public readonly mixed $handlingCost = null,
        public readonly ?array $conditions = null,
        public readonly mixed $additionalRule = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
