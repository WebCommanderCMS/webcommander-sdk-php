<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `maintenance` block: whether the storefront is closed and what it says meanwhile. */
final class Maintenance extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $message = null,
    ) {
    }
}
