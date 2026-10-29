<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions\TransactionsDto;

use WebCommander\Client\Dto;

/** One `by_type` row of a number's read: `count` is `created` plus `updated`, and `trashed` counts
 *  those of them now in the trash. `items_url` is sent on every row, `count` `0` included; it
 *  form-encodes the number, so a space arrives as `+`. */
final class TransactionTypeCount extends Dto
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?int $count = null,
        public readonly ?int $created = null,
        public readonly ?int $updated = null,
        public readonly ?int $trashed = null,
        public readonly ?string $itemsUrl = null,
    ) {
    }
}
