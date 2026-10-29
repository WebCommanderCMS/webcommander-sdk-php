<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** A setting with nothing but a master switch: no `customize` and no `scopes`. */
final class PlainToggle extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
    ) {
    }
}
