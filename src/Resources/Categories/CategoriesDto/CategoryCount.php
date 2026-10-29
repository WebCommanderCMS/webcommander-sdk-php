<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The count sub-path's `{"categories": {"count": N}}`. */
final class CategoryCount extends Dto
{
    public const ENVELOPE_KEY = 'categories';

    public function __construct(
        public readonly ?int $count = null,
    ) {
    }
}
