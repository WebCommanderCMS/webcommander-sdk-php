<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups\CustomerGroupsDto;

use WebCommander\Client\Dto;

/** `$priceDisplayMethod` is `lowest` or `highest`. */
final class CustomerGroupProductDisplay extends Dto
{
    public function __construct(
        public readonly ?bool $overwriteDefault = null,
        public readonly ?string $variationDisplayType = null,
        public readonly ?bool $displayParentImage = null,
        public readonly ?bool $activateColourVariationImage = null,
        public readonly ?bool $showSelectedVariationValue = null,
        public readonly ?bool $strikeThroughOutOfStock = null,
        public readonly ?bool $singleClickVariationLoading = null,
        public readonly ?string $priceDisplayMethod = null,
    ) {
    }
}
