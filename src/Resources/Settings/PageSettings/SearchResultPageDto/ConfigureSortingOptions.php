<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The `configure_sorting_options` block: the sort orders a shopper may switch to; once enabled,
 *  at least one is required. */
final class ConfigureSortingOptions extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $alphabetical = null,
        public readonly ?bool $featured = null,
        public readonly ?bool $new = null,
        public readonly ?bool $topSelling = null,
        public readonly ?bool $price = null,
        public readonly ?bool $createdDate = null,
    ) {
    }
}
