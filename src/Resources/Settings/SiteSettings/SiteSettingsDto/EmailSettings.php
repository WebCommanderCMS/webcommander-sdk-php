<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;
use WebCommander\Client\WireName;

/** The `email_settings` section: which provider sends the store's mail, and each one's credentials. */
final class EmailSettings extends Dto
{
    public const ENVELOPE_KEY = 'email_settings';

    /** @param list<EmailProvider|null>|null $available */
    public function __construct(
        #[ListOf(EmailProvider::class)]
        public readonly ?array $available = null,
        public readonly ?DefaultEmail $default = null,
        public readonly ?OauthProvider $gmail = null,
        #[WireName('office365')]
        public readonly ?OauthProvider $office365 = null,
        public readonly ?SendGrid $sendgrid = null,
        public readonly ?string $serviceProvider = null,
        public readonly ?Smtp $smtp = null,
    ) {
    }
}
