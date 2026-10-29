<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** One option in a type write; an `$id` names an option of this type to change. */
final class VariationOptionInput extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $label = null,
        public readonly ?string $value = null,
        public readonly ?int $order = null,
        public readonly ?bool $default = null,
        public readonly ?VariationOptionImageInput $image = null,
    ) {
    }
}
