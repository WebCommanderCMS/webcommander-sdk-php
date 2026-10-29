<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `gmail` and `office365` blocks, each set through its interactive `connect_url`, not this API. */
final class OauthProvider extends Dto
{
    public function __construct(
        public readonly ?string $connectUrl = null,
    ) {
    }
}
