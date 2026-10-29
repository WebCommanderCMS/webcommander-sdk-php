<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;

/** The body the create and the update take, bare. The update is a replace: an unset flag reads
 *  false, an unset date or limit is cleared, and an unset name, type or text is kept. */
final class DiscountProfileInput extends Dto
{
    /** @param list<int>|null $excludeProducts */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $type = null,
        public readonly ?string $discountDetailsType = null,
        public readonly ?AmountDetails $amountDetails = null,
        public readonly ?ShippingDetails $shippingDetails = null,
        public readonly ?ProductDetails $productDetails = null,
        public readonly ?bool $isActive = null,
        public readonly ?string $startDate = null,
        public readonly ?bool $isSpecifyEndDate = null,
        public readonly ?string $endDate = null,
        public readonly ?bool $isApplyCouponCode = null,
        public readonly ?string $defaultCouponCode = null,
        public readonly ?bool $isCouponCodeAutoGenerate = null,
        public readonly ?bool $isCreateUniqueCouponEachCustomer = null,
        public readonly ?bool $isImportedCoupon = null,
        public readonly ?bool $isMaximumUseTotal = null,
        public readonly ?int $maximumUseCount = null,
        public readonly ?bool $isMaximumUseCustomer = null,
        public readonly ?int $maximumUseCustomerCount = null,
        public readonly ?bool $isMaximumDiscountAllowed = null,
        public readonly ?float $maximumDiscountAllowedAmount = null,
        public readonly ?bool $isExcludeProductsOnSale = null,
        public readonly ?bool $isDiscountUsedWithOtherDiscount = null,
        public readonly ?bool $isDisplayDiscountInformationProdDetail = null,
        public readonly ?bool $isDisplayTextCoupon = null,
        public readonly ?string $displayTextCoupon = null,
        public readonly ?bool $isDisplayTextCart = null,
        public readonly ?string $displayTextCart = null,
        public readonly ?bool $isDisplayTextPartialDiscountCondition = null,
        public readonly ?string $displayTextPartialDiscountCondition = null,
        public readonly ?string $invoiceNote = null,
        public readonly ?array $excludeProducts = null,
    ) {
    }
}
