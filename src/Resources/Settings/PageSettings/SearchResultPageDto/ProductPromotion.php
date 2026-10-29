<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** One promotion row; a single row arrives under `product_promotion`, which every write also
 *  requires. */
final class ProductPromotion extends Dto
{
    public const ENVELOPE_KEY = 'product_promotion';

    /** @param list<int|null>|null $productIds */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $rule = null,
        public readonly ?string $position = null,
        public readonly ?string $specificKeywords = null,
        public readonly ?bool $isActive = null,
        public readonly ?bool $isAlwaysAvailable = null,
        public readonly ?string $availableFromDate = null,
        public readonly ?string $availableToDate = null,
        public readonly ?array $productIds = null,
        public readonly ?string $created = null,
        public readonly ?string $updated = null,
    ) {
    }
}
