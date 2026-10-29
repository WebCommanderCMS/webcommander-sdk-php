<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use WebCommander\Client\Dto;

/** One entry of a customer's `custom_properties`. */
final class CustomProperty extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $label = null,
        public readonly ?string $description = null,
    ) {
    }
}
