<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** `$terms` is written `NET_30`, `NET_60` or `NET_90` and reads back in lower case. */
final class CustomerGroupPaymentTerms extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $terms = null,
    ) {
    }
}
