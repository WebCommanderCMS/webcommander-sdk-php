<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions\TransactionsDto;

use WebCommander\Client\Dto;

/** One listing row: a number, how many records carry it, and its read path. */
final class TransactionListEntry extends Dto
{
    public function __construct(
        public readonly ?string $transactionNo = null,
        public readonly ?int $totalRecords = null,
        public readonly ?string $url = null,
    ) {
    }
}
