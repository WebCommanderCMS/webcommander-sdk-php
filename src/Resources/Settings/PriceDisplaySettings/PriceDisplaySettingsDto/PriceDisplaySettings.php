<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$fieldMetadata` is `mixed`: its entries differ by field type. */
final class PriceDisplaySettings extends Dto
{
    public const ENVELOPE_KEY = 'price_display_settings';

    public function __construct(
        public readonly ?OrderItem $orderItem = null,
        public readonly ?OrderSummary $orderSummary = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
