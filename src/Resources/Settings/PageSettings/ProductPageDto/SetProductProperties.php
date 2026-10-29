<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `set_product_properties` block: which physical properties a product page lists. */
final class SetProductProperties extends Dto
{
    public function __construct(
        public readonly ?bool $displayHeight = null,
        public readonly ?bool $displayWidth = null,
        public readonly ?bool $displayLength = null,
        public readonly ?bool $displayWeight = null,
        public readonly ?bool $displayAddToGiftRegistry = null,
    ) {
    }
}
