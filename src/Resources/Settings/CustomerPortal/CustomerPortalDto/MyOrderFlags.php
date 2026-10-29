<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `my_orders.flags` block; `display_track_in_column` depends on `show_track_my_orders`. */
final class MyOrderFlags extends Dto
{
    public function __construct(
        public readonly ?bool $enableDuePayment = null,
        public readonly ?bool $showTrackMyOrders = null,
        public readonly ?bool $displayTrackInColumn = null,
        public readonly ?bool $showOrderChannel = null,
        public readonly ?bool $showPayNow = null,
        public readonly ?bool $allowOrderShare = null,
    ) {
    }
}
