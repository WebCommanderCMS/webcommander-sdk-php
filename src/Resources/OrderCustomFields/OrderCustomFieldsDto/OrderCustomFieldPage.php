<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderCustomFields\OrderCustomFieldsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing: the rows, where they sit, `group_meta`, and the schema when it was asked for. */
final class OrderCustomFieldPage extends Dto
{
    /** @param list<OrderCustomField|null>|null $orderCustomFields */
    public function __construct(
        #[ListOf(OrderCustomField::class)]
        public readonly ?array $orderCustomFields = null,
        public readonly ?Pagination $pagination = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
