<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `login` section: whether customers may sign in, and what the sign-in page offers. */
final class Login extends Dto
{
    public const ENVELOPE_KEY = 'login';

    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $loginDisabledMessage = null,
        public readonly ?string $awaitingApprovalMessage = null,
        public readonly ?bool $passwordRecovery = null,
        public readonly ?bool $registrationLink = null,
        public readonly ?LoginCaptcha $captcha = null,
        public readonly ?bool $enableLandingPageAfterSuccessfulLogin = null,
        public readonly ?string $landingPageAfterSuccessfulLogin = null,
    ) {
    }
}
