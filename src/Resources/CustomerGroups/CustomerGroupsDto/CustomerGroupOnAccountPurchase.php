<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

final class CustomerGroupOnAccountPurchase extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?CustomerGroupAmountSetting $maxPurchase = null,
        public readonly ?CustomerGroupAmountSetting $creditLimit = null,
        public readonly ?CustomerGroupPaymentTerms $paymentTerms = null,
    ) {
    }
}
