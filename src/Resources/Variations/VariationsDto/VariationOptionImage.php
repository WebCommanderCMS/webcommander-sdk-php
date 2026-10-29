<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** An image option's stored picture; null on text and color options. */
final class VariationOptionImage extends Dto
{
    public function __construct(
        public readonly ?string $url = null,
        public readonly ?string $fileName = null,
    ) {
    }
}
