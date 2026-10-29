<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `rating` block: whether the rating shows, and the review count beside it. */
final class Rating extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $showReviewCount = null,
    ) {
    }
}
