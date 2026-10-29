<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;

/** A `reply` block: whether replies go elsewhere than the sender address, and where. */
final class ReplyTo extends Dto
{
    public function __construct(
        public readonly ?bool $different = null,
        public readonly ?string $toEmail = null,
        public readonly ?string $toName = null,
    ) {
    }
}
