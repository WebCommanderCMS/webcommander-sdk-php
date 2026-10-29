<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `heading` block: whether the category name shows, and at which heading level. */
final class CategoryHeading extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $style = null,
    ) {
    }
}
