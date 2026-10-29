<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `discount` block: where the discount line shows, and whether it hides at zero or carries tax. */
final class Discount extends Dto
{
    public function __construct(
        public readonly ?DisplayScopes $show = null,
        public readonly ?ScopedToggle $hideIfZero = null,
        public readonly ?ScopedToggle $includeTax = null,
    ) {
    }
}
