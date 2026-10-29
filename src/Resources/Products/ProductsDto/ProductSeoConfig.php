<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** One SEO setting on the product. */
final class ProductSeoConfig extends Dto
{
    /** @param list<mixed>|null $metaTags */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $value = null,
        public readonly ?string $type = null,
        public readonly ?string $configKey = null,
        public readonly ?array $metaTags = null,
    ) {
    }
}
