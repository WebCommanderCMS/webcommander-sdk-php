<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ShippingSettings\ShippingSettingsDto;

use WebCommander\Client\Dto;

/** The area's body, seven fields flat under `shipping_settings`. A reference field is typed as read;
 *  a write by id, or one clearing it to `null`, is an array payload. */
final class ShippingSettings extends Dto
{
    public const ENVELOPE_KEY = 'shipping_settings';

    public function __construct(
        public readonly ?ProfileReference $defaultShippingProfile = null,
        public readonly ?bool $enableShippingDefaultTax = null,
        public readonly ?ProfileReference $defaultDeliveryProfile = null,
        public readonly ?bool $enableDeliveryDefaultTax = null,
        public readonly ?ProfileReference $shippingTaxProfile = null,
        public readonly ?bool $enableShippingClass = null,
        public readonly ?bool $enableFlatViewClass = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
