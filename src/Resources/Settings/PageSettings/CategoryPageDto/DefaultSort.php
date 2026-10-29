<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `default_sort` block: whether a default order applies, and which. */
final class DefaultSort extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $by = null,
    ) {
    }
}
