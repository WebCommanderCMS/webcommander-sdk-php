<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One day of the schedule; times are `HH:mm`. */
final class ProductWeekdayWindow extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $fullDay = null,
        public readonly ?string $startTime = null,
        public readonly ?string $endTime = null,
    ) {
    }
}
