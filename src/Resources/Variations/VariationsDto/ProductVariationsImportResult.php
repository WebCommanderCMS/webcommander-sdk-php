<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;

/** The import's answer: `status`, a `message` counting the variants and `total_variants`. */
final class ProductVariationsImportResult extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?string $message = null,
        public readonly ?int $totalVariants = null,
    ) {
    }
}
