<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The `number_of_searches_per_result` block: whether results are paginated, and how many per page. */
final class NumberOfSearchesPerResult extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?int $itemsPerPage = null,
    ) {
    }
}
