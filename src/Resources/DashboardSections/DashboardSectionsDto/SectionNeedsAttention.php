<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;

/** The bookings that need attention: how many, and the latest of them. `latest` was empty on the store measured, so the shape of a row is not known. */
final class SectionNeedsAttention extends Dto
{
    /**
     * @param list<mixed>|null $latest
     */
    public function __construct(
        public readonly ?int $count = null,
        public readonly ?array $latest = null,
    ) {
    }
}
