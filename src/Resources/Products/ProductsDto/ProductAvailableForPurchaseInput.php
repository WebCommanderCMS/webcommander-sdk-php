<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The availability block to write. While `enabled` is `false` the store answers `200` and
 *  keeps none of `who_can_view`, `schedule` or `password_protection`. */
final class ProductAvailableForPurchaseInput extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $active = null,
        public readonly ?string $whoCanView = null,
        public readonly ?ProductSelectedCustomersInput $selectedCustomers = null,
        public readonly ?ProductSchedule $schedule = null,
        public readonly ?ProductPasswordProtection $passwordProtection = null,
    ) {
    }
}
