<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** One entry of `default.domains`: a platform sending domain and this store's sender identity on it. */
final class DefaultDomain extends Dto
{
    public function __construct(
        public readonly ?bool $configure = null,
        public readonly ?string $domain = null,
        public readonly ?string $emailPrefix = null,
        public readonly ?ReplyTo $reply = null,
        public readonly ?string $senderName = null,
    ) {
    }
}
