<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The `set_product_sorting` block: whether a default sort applies, and which. */
final class SetProductSorting extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $defaultSort = null,
    ) {
    }
}
