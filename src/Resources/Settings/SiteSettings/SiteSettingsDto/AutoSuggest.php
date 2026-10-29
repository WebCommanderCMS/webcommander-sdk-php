<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

final class AutoSuggest extends Dto
{
    public function __construct(
        public readonly ?AutoSuggestAddresses $addresses = null,
        public readonly ?bool $suburbsCities = null,
    ) {
    }
}
