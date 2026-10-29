<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingClasses\ShippingClassesDto;

use WebCommander\Client\Dto;

/** The body both writes take: `name`, required, unique and 50 characters or fewer, and
 *  `description`, 100 characters or fewer. */
final class ShippingClassInput extends Dto
{
    public const ENVELOPE_KEY = 'shipping_class';

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
    ) {
    }
}
