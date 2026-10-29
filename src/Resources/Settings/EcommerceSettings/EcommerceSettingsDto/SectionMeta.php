<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** One `group_meta` entry; `location_settings` alone adds `$locationsHref`. */
final class SectionMeta extends Dto
{
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?bool $writable = null,
        public readonly ?string $href = null,
        public readonly ?string $locationsHref = null,
    ) {
    }
}
