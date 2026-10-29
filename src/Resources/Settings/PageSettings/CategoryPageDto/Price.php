<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `price` block: whether a card shows a price, and which. */
final class Price extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $expectToPay = null,
        public readonly ?bool $expectToPayWithTax = null,
        public readonly ?bool $strikeThroughPrevious = null,
    ) {
    }
}
