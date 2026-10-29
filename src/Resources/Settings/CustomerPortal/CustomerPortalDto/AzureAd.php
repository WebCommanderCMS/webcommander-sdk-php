<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `azure_ad` block, the SAML provider, required when `service_provider` is `AZURE_AD`. */
final class AzureAd extends Dto
{
    public function __construct(
        public readonly ?AzureAdDataMapping $dataMapping = null,
        public readonly ?string $identifier = null,
        public readonly ?string $loginUrl = null,
        public readonly ?string $replyUrlPostfix = null,
    ) {
    }
}
