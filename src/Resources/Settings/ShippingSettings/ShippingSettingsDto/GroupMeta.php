<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ShippingSettings\ShippingSettingsDto;

use WebCommander\Client\Dto;

/** The `group_meta` block: the settings area and the two collections beside it. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?AreaMeta $shippingSettings = null,
        public readonly ?AreaMeta $shippingMethods = null,
        public readonly ?AreaMeta $shippingClasses = null,
    ) {
    }
}
