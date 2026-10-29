<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The create's, `PUT`'s and `PATCH`'s bare record; an update merges it at every level, and a `PUT`
 *  also needs the ten fields `updateProduct` lists. A changed read-only field is
 *  `400 read_only_field`, and an update stores `transaction_no` only on a product without one;
 *  `product_url`, `links` and `restrict_for_selected_customers` are read-only, and `updated_by` is
 *  answered `200` and ignored. */
final class ProductInput extends Dto
{
    /** @param list<int|null>|null $parents
     *  @param list<mixed>|null $relatedProducts
     *  @param list<mixed>|null $similarProducts
     *  @param list<mixed>|null $tags
     *  @param list<int|null>|null $categories category ids or `{"id": ...}` records; `[]` is answered `200` and changes nothing
     *  @param list<ProductLink|null>|null $upSellProducts */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $sku = null,
        public readonly ?string $transactionNo = null,
        public readonly ?string $heading = null,
        public readonly ?string $productType = null,
        public readonly ?string $customType = null,
        public readonly ?bool $isVirtual = null,
        public readonly ?string $invoiceNote = null,
        public readonly ?bool $available = null,
        public readonly ?bool $availableOnDateRange = null,
        public readonly ?string $availableFromDate = null,
        public readonly ?string $availableToDate = null,
        public readonly ?string $availableFor = null,
        public readonly ?ProductSelectedCustomersInput $selectedCustomers = null,
        public readonly ?bool $passwordProtected = null,
        public readonly ?string $password = null,
        public readonly ?ProductAvailableOnWeekdays $availableOnWeekdays = null,
        public readonly ?float $basePrice = null,
        public readonly ?float $costPrice = null,
        public readonly ?float $compareAtPrice = null,
        public readonly ?bool $isOnSale = null,
        public readonly ?float $salePrice = null,
        public readonly ?bool $isFeatured = null,
        public readonly ?string $featuredLabel = null,
        public readonly ?bool $isNew = null,
        public readonly ?ProductProperties $productProperties = null,
        public readonly ?string $scheduleType = null,
        public readonly ?string $customScheduleOption = null,
        public readonly ?ProductTaxSettings $taxSettings = null,
        public readonly ?ProductVariationPriceDisplay $variationPriceDisplay = null,
        public readonly ?bool $administrativeStatus = null,
        public readonly ?string $productSummary = null,
        public readonly ?string $productDescription = null,
        public readonly ?ProductPricingAndStock $productPricingAndStock = null,
        public readonly ?ProductImageAndVideo $imageAndVideo = null,
        public readonly ?ProductAdvanced $advanced = null,
        public readonly ?array $parents = null,
        public readonly ?array $relatedProducts = null,
        public readonly ?array $similarProducts = null,
        public readonly ?array $tags = null,
        public readonly ?bool $preorderEnabled = null,
        public readonly ?bool $virtual = null,
        public readonly ?string $summary = null,
        public readonly ?string $description = null,
        public readonly ?array $categories = null,
        #[ListOf(ProductLink::class)]
        public readonly ?array $upSellProducts = null,
        public readonly ?ProductMedia $media = null,
        public readonly ?ProductAvailableForPurchaseInput $availableForPurchase = null,
        public readonly ?ProductPricing $pricing = null,
        public readonly ?ProductInventory $inventory = null,
        public readonly ?ProductOrdering $ordering = null,
        public readonly ?ProductRestrictions $restrictions = null,
        public readonly ?ProductTax $tax = null,
        public readonly ?ProductShipping $shipping = null,
    ) {
    }
}
