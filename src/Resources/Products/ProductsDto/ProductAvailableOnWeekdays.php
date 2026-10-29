<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The weekday schedule: a switch and the seven days. */
final class ProductAvailableOnWeekdays extends Dto
{
    /** @param list<ProductWeekday|null>|null $weekdays */
    public function __construct(
        public readonly ?bool $enabled = null,
        #[ListOf(ProductWeekday::class)]
        public readonly ?array $weekdays = null,
    ) {
    }
}
