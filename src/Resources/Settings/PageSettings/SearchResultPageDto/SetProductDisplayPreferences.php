<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The `set_product_display_preferences` block: how results load and where pagination sits. */
final class SetProductDisplayPreferences extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $displayMode = null,
        public readonly ?string $selectPaginationPosition = null,
        public readonly ?int $numberOfProductsPerPage = null,
        public readonly ?bool $allowUsersToSelectNumberOfProducts = null,
        public readonly ?int $numberOfProductsPerLoad = null,
    ) {
    }
}
