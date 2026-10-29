<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** How many products each press of *load more* adds. Bounded `1`-`999999`. */
final class LoadMore extends Dto
{
    public function __construct(
        public readonly ?int $perLoad = null,
    ) {
    }
}
