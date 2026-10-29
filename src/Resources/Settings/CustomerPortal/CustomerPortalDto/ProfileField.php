<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** One row of an address or account form on the profile page; `key` is read-only. */
final class ProfileField extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?bool $active = null,
        public readonly ?int $order = null,
    ) {
    }
}
