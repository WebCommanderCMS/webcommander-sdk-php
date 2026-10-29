<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

final class StoreContact extends Dto
{
    public function __construct(
        public readonly ?string $fax = null,
        public readonly ?string $mobile = null,
        public readonly ?string $phone = null,
    ) {
    }
}
