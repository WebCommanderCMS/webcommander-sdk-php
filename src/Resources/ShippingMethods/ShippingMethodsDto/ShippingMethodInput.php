<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingMethods\ShippingMethodsDto;

use WebCommander\Client\Dto;

/** The body both writes take: `name`, required, unique and 100 characters or fewer. */
final class ShippingMethodInput extends Dto
{
    public const ENVELOPE_KEY = 'shipping_method';

    public function __construct(
        public readonly ?string $name = null,
    ) {
    }
}
