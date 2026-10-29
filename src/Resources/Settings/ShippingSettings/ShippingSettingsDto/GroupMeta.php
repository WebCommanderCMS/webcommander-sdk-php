<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ShippingSettings\ShippingSettingsDto;

use WebCommander\Client\Dto;

/** The `group_meta` block, a single `AreaMeta` keyed by the area itself. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?AreaMeta $shippingSettings = null,
    ) {
    }
}
