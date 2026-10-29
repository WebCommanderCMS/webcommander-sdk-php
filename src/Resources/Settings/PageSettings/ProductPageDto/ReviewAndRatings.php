<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `review_and_ratings` section: where reviews appear and which version renders them. */
final class ReviewAndRatings extends Dto
{
    public const ENVELOPE_KEY = 'review_and_ratings';

    public function __construct(
        public readonly ?ReviewCapabilities $capabilities = null,
        public readonly ?bool $enableReviewInTab = null,
        public readonly ?bool $enableNewVersion = null,
    ) {
    }
}
