<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions\TransactionsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the records carrying a number, beside the number; each item names its own `type`.
 *  A number or a type with no records answers `items` empty and `pagination.total` `0`. */
final class TransactionItemPage extends Dto
{
    /** @param list<TransactionItem|null>|null $items */
    public function __construct(
        public readonly ?string $transactionNo = null,
        #[ListOf(TransactionItem::class)]
        public readonly ?array $items = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
