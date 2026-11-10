<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** The single-variant patch's answer: `status`, `message` and the `variation`. */
final class ProductVariantPatchResult extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?string $message = null,
        public readonly ?ProductVariantPatched $variation = null,
    ) {
    }
}
