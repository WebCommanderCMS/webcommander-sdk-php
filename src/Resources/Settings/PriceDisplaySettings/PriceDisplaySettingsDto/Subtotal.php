<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The `subtotal` block; `$show` is a `DisplayScopes` in its own right rather than a toggle. */
final class Subtotal extends Dto
{
    public function __construct(
        public readonly ?DisplayScopes $show = null,
        public readonly ?ScopedToggle $includeTax = null,
        public readonly ?ScopedToggle $includeDiscount = null,
    ) {
    }
}
