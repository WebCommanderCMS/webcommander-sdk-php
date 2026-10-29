<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `date_time.admin` block, the only audience block with `first_day_of_week`. */
final class AdminDateTime extends Dto
{
    public function __construct(
        public readonly ?string $dateFormat = null,
        public readonly ?string $firstDayOfWeek = null,
        public readonly ?string $timeFormat = null,
        public readonly ?string $timeZone = null,
    ) {
    }
}
