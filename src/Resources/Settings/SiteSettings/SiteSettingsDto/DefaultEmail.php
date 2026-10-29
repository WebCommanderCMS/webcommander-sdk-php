<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `default` block, the platform's own sending domains. */
final class DefaultEmail extends Dto
{
    /** @param list<DefaultDomain|null>|null $domains */
    public function __construct(
        #[ListOf(DefaultDomain::class)]
        public readonly ?array $domains = null,
    ) {
    }
}
