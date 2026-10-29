<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** When the product is on sale. `type` is `schedule_type` (`date_range` or
 *  `custom_schedule`), `preset` is `custom_schedule_option` (`all_days`, `weekdays`,
 *  `business_hour`, `weekends` or `custom`). */
final class ProductSchedule extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $type = null,
        public readonly ?string $startDate = null,
        public readonly ?string $endDate = null,
        public readonly ?string $preset = null,
        public readonly ?ProductScheduleWeekdays $weekdays = null,
    ) {
    }
}
