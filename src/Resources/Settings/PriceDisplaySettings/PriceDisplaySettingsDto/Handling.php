<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `handling` block: whether handling shows apart from shipping, and its two tax settings. */
final class Handling extends Dto
{
    public function __construct(
        public readonly ?DisplayScopes $showSeparately = null,
        public readonly ?ScopedToggle $includeTax = null,
        public readonly ?ScopedToggle $handlingTax = null,
    ) {
    }
}
