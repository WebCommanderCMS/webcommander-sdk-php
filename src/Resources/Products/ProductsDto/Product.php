<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One product: the row read's body and every write's answer. `field_metadata` sits beside
 *  `product` when the read asks for it. From `productUrl` on, the fields are the block-shaped copy
 *  of the ones above; a write to either changes both. */
final class Product extends Dto
{
    public const ENVELOPE_KEY = 'product';

    /** @param list<ProductParent|null>|null $parents
     *  @param list<ProductLink|null>|null $relatedProducts
     *  @param list<ProductLink|null>|null $similarProducts
     *  @param list<ProductCategory|null>|null $categories
     *  @param list<ProductLink|null>|null $upSellProducts
     *  @param list<ProductSeoConfig|null>|null $seoConfigs
     *  @param list<ProductTag|null>|null $tags
     *  @param list<ProductCustomProperty|null>|null $customProperties
     *  @param list<ProductReview|null>|null $reviews */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?string $status = null,
        public readonly ?ProductUrls $urls = null,
        public readonly ?string $heading = null,
        #[ListOf(ProductParent::class)]
        public readonly ?array $parents = null,
        public readonly ?ProductNamedReference $createdBy = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $productType = null,
        public readonly ?string $customType = null,
        public readonly ?bool $isVirtual = null,
        public readonly ?string $invoiceNote = null,
        public readonly ?bool $available = null,
        public readonly ?ProductNamedReference $productPage = null,
        public readonly mixed $productLayout = null,
        public readonly ?string $customClass = null,
        public readonly ?bool $availableOnDateRange = null,
        public readonly ?string $availableFromDate = null,
        public readonly ?string $availableToDate = null,
        public readonly ?string $availableFor = null,
        public readonly ?ProductSelectedCustomers $selectedCustomers = null,
        public readonly ?ProductSelectedCustomers $restrictForSelectedCustomers = null,
        public readonly ?bool $passwordProtected = null,
        public readonly ?string $password = null,
        public readonly ?ProductAvailableOnWeekdays $availableOnWeekdays = null,
        public readonly ?float $basePrice = null,
        public readonly ?float $costPrice = null,
        public readonly ?float $compareAtPrice = null,
        public readonly ?bool $isOnSale = null,
        public readonly ?float $salePrice = null,
        public readonly ?bool $soldOut = null,
        public readonly ?float $length = null,
        public readonly ?float $width = null,
        public readonly ?float $height = null,
        public readonly ?float $weight = null,
        public readonly ?string $soldOutLabel = null,
        public readonly ?bool $isFeatured = null,
        public readonly ?string $featuredLabel = null,
        public readonly ?bool $isNew = null,
        public readonly ?bool $featured = null,
        public readonly ?bool $new = null,
        public readonly ?string $model = null,
        public readonly ?ProductProperties $productProperties = null,
        public readonly ?int $version = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly ?ProductNamedReference $lastUpdatedBy = null,
        public readonly ?string $scheduleType = null,
        public readonly ?string $customScheduleOption = null,
        public readonly ?ProductTaxSettings $taxSettings = null,
        public readonly ?ProductVariationPriceDisplay $variationPriceDisplay = null,
        public readonly ?bool $administrativeStatus = null,
        public readonly ?bool $isDraft = null,
        public readonly ?string $productSummary = null,
        public readonly ?string $productDescription = null,
        public readonly ?ProductPricingAndStock $productPricingAndStock = null,
        public readonly ?ProductImageAndVideo $imageAndVideo = null,
        public readonly ?ProductAdvanced $advanced = null,
        #[ListOf(ProductLink::class)]
        public readonly ?array $relatedProducts = null,
        #[ListOf(ProductLink::class)]
        public readonly ?array $similarProducts = null,
        public readonly ?ProductBundle $bundle = null,
        #[ListOf(ProductSeoConfig::class)]
        public readonly ?array $seoConfigs = null,
        #[ListOf(ProductTag::class)]
        public readonly ?array $tags = null,
        #[ListOf(ProductCustomProperty::class)]
        public readonly ?array $customProperties = null,
        #[ListOf(ProductReview::class)]
        public readonly ?array $reviews = null,
        public readonly ?ProductVariation $productVariation = null,
        public readonly ?bool $preorderEnabled = null,
        public readonly ?bool $hasVariations = null,
        public readonly ?string $productUrl = null,
        public readonly ?ProductNamedReference $updatedBy = null,
        public readonly ?bool $virtual = null,
        public readonly ?string $summary = null,
        public readonly ?string $description = null,
        #[ListOf(ProductCategory::class)]
        public readonly ?array $categories = null,
        #[ListOf(ProductLink::class)]
        public readonly ?array $upSellProducts = null,
        public readonly ?ProductMedia $media = null,
        public readonly ?ProductAvailableForPurchase $availableForPurchase = null,
        public readonly ?ProductPricing $pricing = null,
        public readonly ?ProductInventory $inventory = null,
        public readonly ?ProductOrdering $ordering = null,
        public readonly ?ProductRestrictions $restrictions = null,
        public readonly ?ProductTax $tax = null,
        public readonly ?ProductShipping $shipping = null,
        public readonly ?ProductLinks $links = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
