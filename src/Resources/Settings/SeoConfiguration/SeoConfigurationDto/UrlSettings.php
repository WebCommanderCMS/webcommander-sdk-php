<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** The `url_settings` section: whether a rename rewrites the URL and leaves a redirect, plus the
 *  inlined rows. */
final class UrlSettings extends Dto
{
    public const ENVELOPE_KEY = 'url_settings';

    public function __construct(
        public readonly ?bool $regenerateUrlOnItemUpdate = null,
        public readonly ?bool $autoRedirectOnUrlChange = null,
        public readonly ?RedirectsPreview $redirects = null,
    ) {
    }
}
