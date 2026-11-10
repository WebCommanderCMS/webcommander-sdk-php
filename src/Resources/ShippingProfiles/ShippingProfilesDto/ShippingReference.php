<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles\ShippingProfilesDto;

use WebCommander\Client\Dto;

/** An `{id, name}` pair: a rule's rate on a profile, and a zone named in the wizard, where a write sends `{"id": ...}` for an existing zone or `{"name": ...}` to create one. */
final class ShippingReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
