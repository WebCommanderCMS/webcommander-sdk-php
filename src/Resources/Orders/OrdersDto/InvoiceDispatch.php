<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** What sending an invoice answers: who it went to and when. */
final class InvoiceDispatch extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int $orderId = null,
        public readonly ?int $internalId = null,
        public readonly ?string $sentTo = null,
        public readonly ?string $template = null,
        public readonly mixed $invoiceDocument = null,
        public readonly ?string $sentAt = null,
    ) {
    }
}
