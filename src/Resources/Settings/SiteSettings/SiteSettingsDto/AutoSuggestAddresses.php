<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `auto_suggest.addresses` block: suggest addresses while typing, and validate the one chosen. */
final class AutoSuggestAddresses extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $validate = null,
    ) {
    }
}
