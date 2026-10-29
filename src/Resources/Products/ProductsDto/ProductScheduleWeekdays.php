<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The seven days of the schedule, each always present. */
final class ProductScheduleWeekdays extends Dto
{
    public function __construct(
        public readonly ?ProductWeekdayWindow $monday = null,
        public readonly ?ProductWeekdayWindow $tuesday = null,
        public readonly ?ProductWeekdayWindow $wednesday = null,
        public readonly ?ProductWeekdayWindow $thursday = null,
        public readonly ?ProductWeekdayWindow $friday = null,
        public readonly ?ProductWeekdayWindow $saturday = null,
        public readonly ?ProductWeekdayWindow $sunday = null,
    ) {
    }
}
