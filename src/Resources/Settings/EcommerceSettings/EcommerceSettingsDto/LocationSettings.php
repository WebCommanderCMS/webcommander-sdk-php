<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `location_settings` section; `$enableMultiLocation` is the only field a write may name. */
final class LocationSettings extends Dto
{
    public const ENVELOPE_KEY = 'location_settings';

    /** @param list<InventoryLocation|null>|null $locations */
    public function __construct(
        public readonly ?bool $enableMultiLocation = null,
        #[ListOf(InventoryLocation::class)]
        public readonly ?array $locations = null,
    ) {
    }
}
