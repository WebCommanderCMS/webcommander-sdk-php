<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** An `enabled` switch and its `amount`: `minimum_purchase`, `max_purchase` and `credit_limit` all
 *  take this shape. The store sends whole amounts, read here as floats. */
final class CustomerGroupAmountSetting extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?float $amount = null,
    ) {
    }
}
