<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettingsDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $orderItem = null,
        public readonly ?SectionMeta $orderSummary = null,
    ) {
    }
}
