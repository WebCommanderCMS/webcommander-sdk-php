<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `date_time` section: formats and zones for the admin area, emails and the storefront. */
final class DateTime extends Dto
{
    public const ENVELOPE_KEY = 'date_time';

    public function __construct(
        public readonly ?AdminDateTime $admin = null,
        public readonly ?SeparableDateTime $email = null,
        public readonly ?bool $hideTimeZone = null,
        public readonly ?SeparableDateTime $user = null,
    ) {
    }
}
