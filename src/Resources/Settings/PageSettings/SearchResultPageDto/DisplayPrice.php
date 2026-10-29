<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The `display_price` block: whether a result shows a price, and which. */
final class DisplayPrice extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $displayExpectToPayPrice = null,
        public readonly ?bool $showTaxWithTheExpectToPayPrice = null,
    ) {
    }
}
