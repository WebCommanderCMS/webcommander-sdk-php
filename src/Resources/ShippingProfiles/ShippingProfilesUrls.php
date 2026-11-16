<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingProfiles;

final class ShippingProfilesUrls
{
    public const SHIPPING_PROFILES = '/api/{api_version}/admin/shipping_profiles';
    public const SHIPPING_PROFILES_COUNT = '/api/{api_version}/admin/shipping_profiles/count';
    public const SHIPPING_PROFILES_WIZARD = '/api/{api_version}/admin/shipping_profiles/wizard';
    public const SHIPPING_PROFILE = '/api/{api_version}/admin/shipping_profiles/{shipping_profile_id}';

    /** Files a new record under this transaction number; a differing `transaction_no` beside the wrapper is `400 header_body_mismatch`, one inside is not compared. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
