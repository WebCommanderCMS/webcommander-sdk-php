<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions\TransactionsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One number's read: a bare body, its 15 `by_type` rows always in the same order. */
final class Transaction extends Dto
{
    /** @param list<TransactionTypeCount|null>|null $byType */
    public function __construct(
        public readonly ?string $transactionNo = null,
        public readonly ?int $totalRecords = null,
        #[ListOf(TransactionTypeCount::class)]
        public readonly ?array $byType = null,
    ) {
    }
}
