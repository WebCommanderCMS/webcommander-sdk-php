<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles;

final class TaxCustomProfilesUrls
{
    public const TAX_CUSTOM_PROFILES = '/api/{api_version}/admin/tax/custom-profiles';
    public const TAX_CUSTOM_PROFILE = '/api/{api_version}/admin/tax/custom-profiles/{custom_profile_id}';

    /** Files a new profile under this transaction number; a differing `transaction_no` beside the wrapper is `400 header_body_mismatch`, one inside is not compared. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
