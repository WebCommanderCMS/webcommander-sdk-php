<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `domain_settings` section: address, aliases, site lock, maintenance and certificate;
 *  `aliases` is read-only here. */
final class DomainSettings extends Dto
{
    public const ENVELOPE_KEY = 'domain_settings';

    /** @param list<string>|null $aliases */
    public function __construct(
        public readonly ?array $aliases = null,
        public readonly ?bool $httpsEnabled = null,
        public readonly ?Maintenance $maintenance = null,
        public readonly ?SecurityCode $securityCode = null,
        public readonly ?Ssl $ssl = null,
        public readonly ?string $websiteAddress = null,
    ) {
    }
}
