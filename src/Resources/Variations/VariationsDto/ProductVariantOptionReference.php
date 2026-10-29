<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** One option a variant carries, in the bulk write's full answer. */
final class ProductVariantOptionReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $type = null,
        public readonly ?string $label = null,
    ) {
    }
}
