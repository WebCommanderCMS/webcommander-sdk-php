<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `columns_per_row` block: product columns per row for each mode, each with its own `max`. */
final class ColumnsPerRow extends Dto
{
    public function __construct(
        public readonly ?int $grid = null,
        public readonly ?int $list = null,
    ) {
    }
}
