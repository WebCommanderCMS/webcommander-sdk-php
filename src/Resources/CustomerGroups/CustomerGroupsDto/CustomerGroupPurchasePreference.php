<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

final class CustomerGroupPurchasePreference extends Dto
{
    public function __construct(
        public readonly ?CustomerGroupAmountSetting $minimumPurchase = null,
        public readonly ?CustomerGroupOnAccountPurchase $onAccountPurchase = null,
    ) {
    }
}
