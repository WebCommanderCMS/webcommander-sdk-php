<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `comment` block: whether an order may carry a customer comment, and whether staff are told. */
final class OrderComment extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $sendNotification = null,
    ) {
    }
}
