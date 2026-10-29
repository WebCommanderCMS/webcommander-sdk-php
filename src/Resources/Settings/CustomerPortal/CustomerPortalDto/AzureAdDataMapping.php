<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `azure_ad.data_mapping` block: which assertion attribute fills which customer field. */
final class AzureAdDataMapping extends Dto
{
    public function __construct(
        public readonly ?string $addressLine1 = null,
        public readonly ?string $addressLine2 = null,
        public readonly ?string $postCode = null,
        public readonly ?string $phone = null,
        public readonly ?string $mobile = null,
        public readonly ?int $countryId = null,
        public readonly ?string $state = null,
        public readonly ?string $city = null,
    ) {
    }
}
