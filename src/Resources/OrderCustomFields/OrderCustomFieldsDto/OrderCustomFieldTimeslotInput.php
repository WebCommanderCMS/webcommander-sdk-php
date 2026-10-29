<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderCustomFields\OrderCustomFieldsDto;

use WebCommander\Client\Dto;

/** The `validate_timeslot` body, bare. `$selectedDate` is required, as `dd/MM/yyyy`; an
 *  `$orderLimit` above 0 makes both hours required and `$fieldName` read, as text. */
final class OrderCustomFieldTimeslotInput extends Dto
{
    public function __construct(
        public readonly ?string $selectedDate = null,
        public readonly ?string $fieldName = null,
        public readonly ?int $weekdayId = null,
        public readonly ?int $startHour = null,
        public readonly ?int $endHour = null,
        public readonly ?int $orderLimit = null,
    ) {
    }
}
