<?php

declare(strict_types=1);

namespace WebCommander\Resources\DiscountProfiles;

final class DiscountProfilesUrls
{
    public const DISCOUNT_PROFILES = '/api/{api_version}/admin/discount_profiles';
    public const DISCOUNT_PROFILE = '/api/{api_version}/admin/discount_profiles/{discount_profile_id}';
    public const DISCOUNT_PROFILE_CREATE_COUPONS = '/api/{api_version}/admin/discount_profiles/{discount_profile_id}/create-coupons';
    public const DISCOUNT_COUPONS_ASSIGN_CUSTOMER = '/api/{api_version}/admin/discount_coupons/assign-customer';
}
