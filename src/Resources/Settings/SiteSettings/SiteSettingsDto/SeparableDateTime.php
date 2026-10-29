<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** The `date_time.email` and `date_time.user` blocks: the admin block's three formats and a
 *  `separate` flag. */
final class SeparableDateTime extends Dto
{
    public function __construct(
        public readonly ?string $dateFormat = null,
        public readonly ?bool $separate = null,
        public readonly ?string $timeFormat = null,
        public readonly ?string $timeZone = null,
    ) {
    }
}
