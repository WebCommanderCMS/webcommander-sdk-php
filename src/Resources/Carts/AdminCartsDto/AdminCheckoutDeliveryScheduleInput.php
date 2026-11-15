<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;

/** The delivery schedule to choose: its `$id` and the `$date` wanted, both required. */
final class AdminCheckoutDeliveryScheduleInput extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $date = null,
    ) {
    }
}
