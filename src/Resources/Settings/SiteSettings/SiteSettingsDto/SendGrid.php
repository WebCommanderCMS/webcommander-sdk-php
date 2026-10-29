<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `sendgrid` block; `api_key` reads back as `***`. */
final class SendGrid extends Dto
{
    public function __construct(
        public readonly ?string $apiKey = null,
        public readonly ?ReplyTo $reply = null,
        public readonly ?string $senderEmail = null,
        public readonly ?string $senderName = null,
    ) {
    }
}
