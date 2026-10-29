<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use WebCommander\Client\Dto;

/** A store-credit movement as the store accepts it. */
final class StoreCreditAdjustmentInput extends Dto
{
    public function __construct(
        public readonly ?string $action = null,
        public readonly ?float $amount = null,
        public readonly ?string $note = null,
    ) {
    }
}
