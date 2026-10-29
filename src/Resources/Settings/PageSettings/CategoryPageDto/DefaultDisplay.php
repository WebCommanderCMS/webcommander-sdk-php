<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `default_display` block: the mode a listing opens in and how wide its rows are. */
final class DefaultDisplay extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $mode = null,
        public readonly ?ColumnsPerRow $columnsPerRow = null,
        public readonly ?bool $showVariationOptionsLabelInTabular = null,
    ) {
    }
}
