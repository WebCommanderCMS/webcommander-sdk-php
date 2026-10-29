<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The read-only `capabilities` block: what the review plugin makes available. */
final class ReviewCapabilities extends Dto
{
    public function __construct(
        public readonly ?bool $available = null,
    ) {
    }
}
