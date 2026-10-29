<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** One row of `order_flags` as the facade inlines it; nothing in this module writes one. */
final class OrderFlag extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $color = null,
        public readonly ?string $description = null,
        public readonly ?string $type = null,
    ) {
    }
}
