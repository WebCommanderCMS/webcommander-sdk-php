<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The order refund body, `{"refund": {...}}`; `refund_date` is required, and `amount` may not
 *  pass what was paid less earlier refunds. */
final class OrderRefundInput extends Dto
{
    public const ENVELOPE_KEY = 'refund';

    /** @param list<RefundLineInput|null>|null $lineItems */
    public function __construct(
        public readonly ?string $amount = null,
        public readonly ?string $refundDate = null,
        public readonly ?string $reason = null,
        #[ListOf(RefundLineInput::class)]
        public readonly ?array $lineItems = null,
    ) {
    }
}
