<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** Which variation types a listing tile combines, from the store's own variation names. */
final class VariationCombination extends Dto
{
    /** @param list<string>|null $types */
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?array $types = null,
    ) {
    }
}
