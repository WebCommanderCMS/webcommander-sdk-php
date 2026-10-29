<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The `availability_visibility` section as read; `password` is never echoed. */
final class CategoryAvailabilityVisibility extends Dto
{
    public function __construct(
        public readonly ?bool $available = null,
        public readonly ?bool $visible = null,
        public readonly ?string $availableFor = null,
        public readonly ?CategorySelectedCustomers $selectedCustomers = null,
        public readonly ?bool $availableOnDateRange = null,
        public readonly ?string $availableFromDate = null,
        public readonly ?string $availableToDate = null,
        public readonly ?bool $passwordProtected = null,
        public readonly ?bool $customSorting = null,
        public readonly ?string $defaultSorting = null,
        public readonly ?bool $disableTracking = null,
    ) {
    }
}
