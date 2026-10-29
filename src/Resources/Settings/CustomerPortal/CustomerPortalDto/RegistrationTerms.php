<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `terms` block; enabling it while `reference` is null is `400`. */
final class RegistrationTerms extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $text = null,
        public readonly ?string $anchorText = null,
        public readonly ?string $type = null,
        public readonly ?string $reference = null,
    ) {
    }
}
