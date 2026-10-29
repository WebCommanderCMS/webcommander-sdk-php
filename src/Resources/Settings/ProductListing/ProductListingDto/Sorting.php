<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** The `sorting` section, the order a listing arrives in; `sort_by` is a nullable enum. */
final class Sorting extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $sortBy = null,
    ) {
    }
}
