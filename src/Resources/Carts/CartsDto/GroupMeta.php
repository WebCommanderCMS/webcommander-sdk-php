<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;

/** The `group_meta` block, which only a read sends. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $cart = null,
    ) {
    }
}
