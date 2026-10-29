<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** Availability in one block: `enabled` is `available`, `active` is
 *  `administrative_status`, `who_can_view` is `available_for`.
 *  `restrict_for_selected_customers` is read-only. */
final class ProductAvailableForPurchase extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $active = null,
        public readonly ?string $whoCanView = null,
        public readonly ?ProductSelectedCustomers $selectedCustomers = null,
        public readonly ?ProductSelectedCustomers $restrictForSelectedCustomers = null,
        public readonly ?ProductSchedule $schedule = null,
        public readonly ?ProductPasswordProtection $passwordProtection = null,
    ) {
    }
}
