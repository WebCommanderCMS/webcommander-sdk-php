<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The bulk write's answer; `$failed` stays empty, as a refused id refuses the whole write. */
final class ProductVariationsBulkResult extends Dto
{
    /** @param list<ProductVariantUpdate|null>|null $updated
     *  @param list<mixed>|null $failed */
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?string $message = null,
        #[ListOf(ProductVariantUpdate::class)]
        public readonly ?array $updated = null,
        public readonly ?array $failed = null,
    ) {
    }
}
