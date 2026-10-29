<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `administration` section: units, precision, region, error pages and the CAPTCHA block;
 *  `page_403` and `page_404` take an existing page's URL or nothing. */
final class Administration extends Dto
{
    public const ENVELOPE_KEY = 'administration';

    public function __construct(
        public readonly ?AutoSuggest $autoSuggest = null,
        public readonly ?Captcha $captcha = null,
        public readonly ?Region $defaultCountry = null,
        public readonly ?Region $defaultState = null,
        public readonly ?bool $ecommerceEnabled = null,
        public readonly ?int $maxPrecision = null,
        public readonly ?string $page403 = null,
        public readonly ?string $page404 = null,
        public readonly ?string $unitLength = null,
        public readonly ?string $unitWeight = null,
    ) {
    }
}
