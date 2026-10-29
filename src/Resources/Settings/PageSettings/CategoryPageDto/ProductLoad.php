<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `load` block: how the product listing pages, and where its control sits. */
final class ProductLoad extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $type = null,
        public readonly ?string $paginationPosition = null,
        public readonly ?int $perPage = null,
        public readonly ?bool $allowUserPerPage = null,
        public readonly ?int $perLoad = null,
    ) {
    }
}
