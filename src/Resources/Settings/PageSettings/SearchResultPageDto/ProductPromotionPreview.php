<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The facade's `product_promotion` marker; the rows have their own path and functions. */
final class ProductPromotionPreview extends Dto
{
    public function __construct(
        public readonly ?bool $readOnly = null,
    ) {
    }
}
