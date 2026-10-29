<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `store_details` section; `company_name` and `email` are required, and `abn` must be eleven
 *  digits. */
final class StoreDetails extends Dto
{
    public const ENVELOPE_KEY = 'store_details';

    public function __construct(
        public readonly ?string $abn = null,
        public readonly ?StoreAddress $address = null,
        public readonly ?string $companyName = null,
        public readonly ?StoreContact $contact = null,
        public readonly ?string $email = null,
    ) {
    }
}
