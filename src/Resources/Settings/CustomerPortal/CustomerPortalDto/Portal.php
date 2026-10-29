<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `portal` section, the one switch that turns the customer portal on. */
final class Portal extends Dto
{
    public const ENVELOPE_KEY = 'portal';

    public function __construct(
        public readonly ?bool $enabled = null,
    ) {
    }
}
