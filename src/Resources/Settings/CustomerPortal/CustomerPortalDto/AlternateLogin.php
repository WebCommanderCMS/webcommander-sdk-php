<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `alternate_login` block: third-party login, and whether it offers an email field. */
final class AlternateLogin extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $enableEmailField = null,
    ) {
    }
}
