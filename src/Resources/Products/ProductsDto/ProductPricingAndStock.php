<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The pricing and stock block. `locations` matches the stock sub-path's rows, and
 *  `low_level_stock` follows the default location's `low_stock_level`. */
final class ProductPricingAndStock extends Dto
{
    /** @param list<ProductWarehouseStock|null>|null $warehouses
     *  @param list<mixed>|null $restrictPriceForExceptCustomers
     *  @param list<mixed>|null $restrictPurchaseForSelectedCustomers
     *  @param list<mixed>|null $suppliers
     *  @param list<ProductStockLocation|null>|null $locations */
    public function __construct(
        public readonly ?bool $trackInventory = null,
        public readonly ?int $availableStock = null,
        public readonly ?int $lowLevelStock = null,
        #[ListOf(ProductWarehouseStock::class)]
        public readonly ?array $warehouses = null,
        public readonly ?int $minimumOrderQuantity = null,
        public readonly ?int $maximumOrderQuantity = null,
        public readonly mixed $taxProfile = null,
        public readonly mixed $shippingProfile = null,
        public readonly ?bool $enableMultipleOrder = null,
        public readonly ?int $multipleOrderQuantity = null,
        public readonly ?bool $onSale = null,
        public readonly ?string $onSalePriceType = null,
        public readonly ?float $onSalePrice = null,
        public readonly ?bool $expectedToPay = null,
        public readonly ?float $expectedToPayPrice = null,
        public readonly ?bool $enableCallForPrice = null,
        public readonly ?string $restrictPriceFor = null,
        public readonly ?array $restrictPriceForExceptCustomers = null,
        public readonly ?string $restrictPurchaseFor = null,
        public readonly ?array $restrictPurchaseForSelectedCustomers = null,
        public readonly ?bool $hidePrice = null,
        public readonly ?bool $enableCombinedStockSellingLimit = null,
        public readonly ?int $combinedStockSellingLimit = null,
        public readonly ?bool $enableAdvancePricing = null,
        public readonly ?array $suppliers = null,
        public readonly ?bool $isMultiLocationEnabled = null,
        #[ListOf(ProductStockLocation::class)]
        public readonly ?array $locations = null,
    ) {
    }
}
