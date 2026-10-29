<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `sort_options` block: which orders a shopper may switch to. */
final class SortOptions extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $alphabetic = null,
        public readonly ?bool $featured = null,
        public readonly ?bool $new = null,
        public readonly ?bool $topSelling = null,
        public readonly ?bool $price = null,
        public readonly ?bool $date = null,
    ) {
    }
}
