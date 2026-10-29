<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** One row of a named list on the profile page - a tab, a section or an entitlement. */
final class ProfileEntry extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?bool $active = null,
        public readonly ?int $order = null,
        public readonly ?string $label = null,
    ) {
    }
}
