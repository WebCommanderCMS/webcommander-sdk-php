<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One variant. `weight`, `height`, `length` and `width` arrive as a number or as text, so
 *  they are `mixed`. */
final class ProductCombinationDetails extends Dto
{
    /** @param list<mixed>|null $metaTags
     *  @param list<ProductCombinationImage|null>|null $images
     *  @param list<ProductVideo|null>|null $videos
     *  @param list<mixed>|null $specs */
    public function __construct(
        public readonly ?int $variationId = null,
        public readonly ?bool $available = null,
        public readonly ?string $productName = null,
        public readonly ?string $sku = null,
        public readonly ?string $customSku = null,
        public readonly ?ProductUrls $urls = null,
        public readonly ?array $metaTags = null,
        public readonly ?bool $isInventoryEnabled = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $lowStockLevel = null,
        public readonly ?string $spec = null,
        public readonly ?bool $isMultipleOrderQuantity = null,
        public readonly ?bool $isOnSale = null,
        public readonly ?bool $isExpectToPay = null,
        public readonly ?bool $isCallForPriceEnabled = null,
        public readonly ?bool $isNew = null,
        public readonly ?bool $isFeatured = null,
        public readonly ?string $onSaleAmountType = null,
        public readonly ?string $title = null,
        public readonly ?string $heading = null,
        public readonly ?string $summary = null,
        public readonly ?string $description = null,
        public readonly ?string $model = null,
        public readonly ?string $productCondition = null,
        public readonly ?string $featuredLabel = null,
        public readonly ?float $basePrice = null,
        public readonly ?float $costPrice = null,
        public readonly ?float $compareAtPrice = null,
        public readonly ?float $salePrice = null,
        public readonly ?float $expectToPayPrice = null,
        public readonly mixed $weight = null,
        public readonly mixed $height = null,
        public readonly mixed $length = null,
        public readonly mixed $width = null,
        public readonly ?float $displayPrice = null,
        public readonly ?float $previousPrice = null,
        public readonly ?ProductCombinationPriceAndStock $priceAndStock = null,
        #[ListOf(ProductCombinationImage::class)]
        public readonly ?array $images = null,
        #[ListOf(ProductVideo::class)]
        public readonly ?array $videos = null,
        public readonly ?array $specs = null,
        public readonly ?int $supportedMaxOrderQuantity = null,
        public readonly ?bool $isBase = null,
        public readonly ?string $barcode = null,
        public readonly ?string $countryOfOrigin = null,
        public readonly ?string $hsCode = null,
        public readonly ?float $tax = null,
        public readonly ?string $taxMessage = null,
    ) {
    }
}
