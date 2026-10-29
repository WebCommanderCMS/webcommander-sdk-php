<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `captcha` block, the challenge shown after failed logins; `fail_count` is bounded. */
final class LoginCaptcha extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?int $failCount = null,
    ) {
    }
}
