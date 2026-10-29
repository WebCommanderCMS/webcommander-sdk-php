<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The `fulfillment` section. */
final class OrderFulfillment extends Dto
{
    /** @param list<mixed>|null $customFields */
    public function __construct(
        public readonly ?string $fulfillmentMode = null,
        public readonly ?string $fulfillmentTerm = null,
        public readonly ?string $invoiceMode = null,
        public readonly ?string $paymentTerm = null,
        public readonly ?string $customerPoNumber = null,
        public readonly ?string $externalReferenceOrderId = null,
        public readonly ?string $externalReferenceStoreId = null,
        public readonly ?string $externalReferenceOrderNo = null,
        public readonly ?string $externalReferenceStatus = null,
        public readonly ?string $externalReferenceUrl = null,
        public readonly ?array $customFields = null,
    ) {
    }
}
