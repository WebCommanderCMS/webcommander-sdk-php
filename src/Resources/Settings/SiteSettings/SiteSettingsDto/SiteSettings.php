<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$fieldMetadata` is `mixed`: its entries differ by field type. */
final class SiteSettings extends Dto
{
    public const ENVELOPE_KEY = 'site_settings';

    public function __construct(
        public readonly ?Administration $administration = null,
        public readonly ?BrandKit $brandKit = null,
        public readonly ?DateTime $dateTime = null,
        public readonly ?DomainSettings $domainSettings = null,
        public readonly ?EmailSettings $emailSettings = null,
        public readonly ?Favicon $favicon = null,
        public readonly ?StoreDetails $storeDetails = null,
        public readonly ?StoreLogo $storeLogo = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
