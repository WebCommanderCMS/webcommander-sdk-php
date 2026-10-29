<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `smtp` block: the server the store sends through and who it sends as. */
final class Smtp extends Dto
{
    public function __construct(
        public readonly ?SmtpAuthentication $authentication = null,
        public readonly ?string $encryption = null,
        public readonly ?string $host = null,
        public readonly ?int $port = null,
        public readonly ?string $senderEmail = null,
        public readonly ?string $senderName = null,
    ) {
    }
}
