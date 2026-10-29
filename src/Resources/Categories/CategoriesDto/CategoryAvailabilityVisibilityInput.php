<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The writable `availability_visibility` fields: the read fields, plus the write-only
 *  `password`, with `selected_customers` taking ids. */
final class CategoryAvailabilityVisibilityInput extends Dto
{
    public function __construct(
        public readonly ?bool $available = null,
        public readonly ?bool $visible = null,
        public readonly ?string $availableFor = null,
        public readonly ?CategorySelectedCustomersInput $selectedCustomers = null,
        public readonly ?bool $availableOnDateRange = null,
        public readonly ?string $availableFromDate = null,
        public readonly ?string $availableToDate = null,
        public readonly ?bool $passwordProtected = null,
        public readonly ?string $password = null,
        public readonly ?bool $customSorting = null,
        public readonly ?string $defaultSorting = null,
        public readonly ?bool $disableTracking = null,
    ) {
    }
}
