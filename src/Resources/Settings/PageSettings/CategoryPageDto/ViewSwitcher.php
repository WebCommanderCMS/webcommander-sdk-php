<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `view_switcher` block: whether a shopper may change the display mode, and which modes. */
final class ViewSwitcher extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $grid = null,
        public readonly ?bool $list = null,
        public readonly ?bool $tabular = null,
    ) {
    }
}
