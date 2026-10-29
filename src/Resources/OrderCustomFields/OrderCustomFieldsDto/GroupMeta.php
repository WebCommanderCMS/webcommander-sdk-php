<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderCustomFields\OrderCustomFieldsDto;

use WebCommander\Client\Dto;

/** The listing's `group_meta` block, keyed by the collection's own name. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?ResourceMeta $orderCustomFields = null,
    ) {
    }
}
