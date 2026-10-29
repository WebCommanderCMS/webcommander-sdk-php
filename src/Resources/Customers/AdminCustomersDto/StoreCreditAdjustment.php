<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use WebCommander\Client\Dto;

/** One movement of a customer's store credit; a history entry omits the balances, so
 *  `$balanceBefore`, `$balanceAfter` and `$storeCredit` are readable only on the write. */
final class StoreCreditAdjustment extends Dto
{
    public const ENVELOPE_KEY = 'store_credit_adjustment';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $customerId = null,
        public readonly ?int $internalId = null,
        public readonly ?string $action = null,
        public readonly ?float $amount = null,
        public readonly ?string $note = null,
        public readonly ?string $createdAt = null,
        public readonly mixed $createdBy = null,
        public readonly ?float $balanceBefore = null,
        public readonly ?float $balanceAfter = null,
        public readonly ?float $storeCredit = null,
    ) {
    }
}
