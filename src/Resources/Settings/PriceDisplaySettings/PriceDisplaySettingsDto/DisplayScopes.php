<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The storefront surfaces one setting applies to; a surface outside the block's `allowed_scopes`
 *  is `400`. */
final class DisplayScopes extends Dto
{
    public function __construct(
        public readonly ?bool $shoppingCart = null,
        public readonly ?bool $checkout = null,
        public readonly ?bool $orderSuccess = null,
    ) {
    }
}
