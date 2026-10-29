<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `sso` section; turning `enabled` on demands the whole `azure_ad_b2c` block, secret included. */
final class Sso extends Dto
{
    public const ENVELOPE_KEY = 'sso';

    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $requireSiteAccess = null,
        public readonly ?string $serviceProvider = null,
        public readonly ?AzureAd $azureAd = null,
        public readonly ?AzureAdB2c $azureAdB2c = null,
    ) {
    }
}
