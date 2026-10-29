<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ShippingSettings\ShippingSettingsDto;

use WebCommander\Client\Dto;

/** What a reference field holds: the stored id and the name it resolves to, or `null`. */
final class ProfileReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
