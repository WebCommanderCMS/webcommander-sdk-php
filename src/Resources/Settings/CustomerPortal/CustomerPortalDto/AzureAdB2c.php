<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `azure_ad_b2c` block, the B2C provider, required when `service_provider` is `AZURE_AD_B2C`. */
final class AzureAdB2c extends Dto
{
    public function __construct(
        public readonly ?string $tenantName = null,
        public readonly ?string $policyName = null,
        public readonly ?string $clientId = null,
        public readonly ?string $clientSecret = null,
        public readonly ?string $replyUrlPrefix = null,
        public readonly ?string $replyUrlPostfix = null,
    ) {
    }
}
