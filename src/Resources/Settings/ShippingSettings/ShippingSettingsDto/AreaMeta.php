<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ShippingSettings\ShippingSettingsDto;

use WebCommander\Client\Dto;

/** The area's own `group_meta` entry: two fields and no `href`, since there are no sections. */
final class AreaMeta extends Dto
{
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?bool $writable = null,
    ) {
    }
}
