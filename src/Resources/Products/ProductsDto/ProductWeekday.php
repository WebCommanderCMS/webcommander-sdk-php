<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One day of the weekday schedule. */
final class ProductWeekday extends Dto
{
    public function __construct(
        public readonly ?string $day = null,
        public readonly ?int $startHour = null,
        public readonly ?int $startMinute = null,
        public readonly ?int $endHour = null,
        public readonly ?int $endMinute = null,
        public readonly ?bool $isFullDay = null,
        public readonly ?bool $enabled = null,
    ) {
    }
}
