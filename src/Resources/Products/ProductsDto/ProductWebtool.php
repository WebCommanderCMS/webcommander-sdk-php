<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** `webtool_disable_tracking` again, read-only. */
final class ProductWebtool extends Dto
{
    public function __construct(
        public readonly ?bool $disableTracking = null,
    ) {
    }
}
