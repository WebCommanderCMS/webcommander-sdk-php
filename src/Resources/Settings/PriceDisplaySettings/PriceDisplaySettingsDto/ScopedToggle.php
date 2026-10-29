<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** A setting with a master switch and optional per-surface control; while `customize` is off, the
 *  store answers `scopes` following `enabled`. */
final class ScopedToggle extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $customize = null,
        public readonly ?DisplayScopes $scopes = null,
    ) {
    }
}
