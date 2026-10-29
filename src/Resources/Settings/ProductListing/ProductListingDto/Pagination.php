<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\ProductListing\ProductListingDto;

use WebCommander\Client\Dto;

/** Where the pager sits and how many products a page holds, `per_page` bounded `1`-`999999`. */
final class Pagination extends Dto
{
    public function __construct(
        public readonly ?string $position = null,
        public readonly ?int $perPage = null,
        public readonly ?bool $allowUserPerPage = null,
    ) {
    }
}
