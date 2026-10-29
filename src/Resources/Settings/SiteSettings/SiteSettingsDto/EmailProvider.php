<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** One provider the store can send through; `connect_url` comes only on the two `oauth` entries. */
final class EmailProvider extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $label = null,
        public readonly ?string $type = null,
        public readonly ?string $connectUrl = null,
    ) {
    }
}
