<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `pricing_info` block: a note shown after the total, and whether the due amount is hidden on
 *  the order success page. */
final class PricingInfo extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $text = null,
        public readonly ?bool $customize = null,
        public readonly ?DisplayScopes $scopes = null,
        public readonly ?bool $doNotShowDueAmount = null,
    ) {
    }
}
