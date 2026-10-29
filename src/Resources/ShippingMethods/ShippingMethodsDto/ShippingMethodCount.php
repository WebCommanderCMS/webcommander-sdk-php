<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingMethods\ShippingMethodsDto;

use WebCommander\Client\Dto;

/** The count sub-path's `{"shipping_methods": {"count": N}}`. */
final class ShippingMethodCount extends Dto
{
    public const ENVELOPE_KEY = 'shipping_methods';

    public function __construct(
        public readonly ?int $count = null,
    ) {
    }
}
