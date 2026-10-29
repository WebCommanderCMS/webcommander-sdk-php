<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** An order's comments, oldest first and unpaged. */
final class OrderCommentList extends Dto
{
    /** @param list<OrderComment|null>|null $comments */
    public function __construct(
        #[ListOf(OrderComment::class)]
        public readonly ?array $comments = null,
    ) {
    }
}
