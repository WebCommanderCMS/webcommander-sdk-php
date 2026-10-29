<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `google` block; `client_id` is required when it is enabled. */
final class GoogleLogin extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $clientId = null,
    ) {
    }
}
