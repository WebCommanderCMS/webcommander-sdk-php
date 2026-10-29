<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `store_details.address` block; `address_line_1` is required. */
final class StoreAddress extends Dto
{
    public function __construct(
        public readonly ?string $addressLine1 = null,
        public readonly ?string $addressLine2 = null,
        public readonly ?string $city = null,
        public readonly ?Region $country = null,
        public readonly ?string $postCode = null,
        public readonly ?Region $state = null,
    ) {
    }
}
