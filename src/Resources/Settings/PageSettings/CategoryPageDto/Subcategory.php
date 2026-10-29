<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `subcategory` block: whether subcategories are listed, and how that list pages. */
final class Subcategory extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $display = null,
        public readonly ?string $loadType = null,
        public readonly ?string $paginationPosition = null,
        public readonly ?int $perPage = null,
        public readonly ?bool $allowUserPerPage = null,
        public readonly ?int $perLoad = null,
        public readonly ?bool $displayProducts = null,
        public readonly ?bool $showSummary = null,
    ) {
    }
}
