<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The customer as the preview shows it: the billing address names win over the record's. */
final class PreviewCustomer extends Dto
{
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $email = null,
    ) {
    }
}
