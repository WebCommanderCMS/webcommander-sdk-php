<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles\DiscountProfilesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One discount profile: a listing row, a row path's body and every write's answer. It carries the
 *  one details block its `discount_details_type` names; the other two read null. */
final class DiscountProfile extends Dto
{
    public const ENVELOPE_KEY = 'discount_profile';

    /** @param list<int>|null $excludeProducts
     *  @param list<CustomerCoupon|null>|null $customerCoupons
     *  @param list<int>|null $usage */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $uuid = null,
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
        #[ListOf(CustomerCoupon::class)]
        public readonly ?array $customerCoupons = null,
        public readonly ?array $usage = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
