<?php

declare(strict_types=1);

namespace WebCommander\Resources\Transactions\TransactionsDto;

use WebCommander\Client\Dto;

/** One record under a number as `detail=slim` sends it: `type`, `id`, `stamp` (`created` or
 *  `updated`), `trashed` and the fields of its `type`; a field the type does not send reads null. Under `detail=full` the row is the record's own read body, in `->map`. */
final class TransactionItem extends Dto
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?int $id = null,
        public readonly ?string $stamp = null,
        public readonly ?bool $trashed = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?float $rating = null,
        public readonly ?string $email = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?int $orderNo = null,
        public readonly ?float $grandTotal = null,
        public readonly ?string $status = null,
        public readonly ?string $code = null,
        public readonly ?string $symbol = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $stateName = null,
        public readonly ?string $postcode = null,
        public readonly ?float $rate = null,
        public readonly ?int $priority = null,
        public readonly ?string $description = null,
        public readonly ?string $policyType = null,
        public readonly ?string $url = null,
    ) {
    }
}
