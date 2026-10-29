<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** The `product_inventory` section: what the storefront does with stock it lacks, and when a sale
 *  draws it down. */
final class ProductInventory extends Dto
{
    public const ENVELOPE_KEY = 'product_inventory';

    public function __construct(
        public readonly ?bool $showOutOfStockProducts = null,
        public readonly ?bool $lowStockNotification = null,
        public readonly ?bool $outOfStockNotification = null,
        public readonly ?bool $hideOnSaleTagForOutOfStockProduct = null,
        public readonly ?string $orderQuantityOverStock = null,
        public readonly ?string $updateStock = null,
    ) {
    }
}
