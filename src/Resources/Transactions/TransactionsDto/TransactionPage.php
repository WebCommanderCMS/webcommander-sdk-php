<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions\TransactionsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the numbers; a `transaction_no` filter answers `pagination` too. */
final class TransactionPage extends Dto
{
    /** @param list<TransactionListEntry|null>|null $transactions */
    public function __construct(
        #[ListOf(TransactionListEntry::class)]
        public readonly ?array $transactions = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
