<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ShoppingCartDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $cartPage = null,
        public readonly ?SectionMeta $flyingCart = null,
    ) {
    }
}
