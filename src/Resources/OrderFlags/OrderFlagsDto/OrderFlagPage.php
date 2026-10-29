<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderFlags\OrderFlagsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. */
final class OrderFlagPage extends Dto
{
    /** @param list<OrderFlag|null>|null $orderFlags */
    public function __construct(
        #[ListOf(OrderFlag::class)]
        public readonly ?array $orderFlags = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
