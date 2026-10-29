<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** One option of a type; `$value` is null on an image option. */
final class VariationOption extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $label = null,
        public readonly ?string $value = null,
        public readonly ?int $order = null,
        public readonly ?bool $default = null,
        public readonly ?VariationOptionImage $image = null,
    ) {
    }
}
