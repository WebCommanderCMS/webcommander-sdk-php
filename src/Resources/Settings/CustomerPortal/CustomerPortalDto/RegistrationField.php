<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** One row of the registration form's field catalog; `placeholder` is absent on rows with no text box. */
final class RegistrationField extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $label = null,
        public readonly ?string $defaultLabel = null,
        public readonly ?bool $active = null,
        public readonly ?bool $required = null,
        public readonly ?bool $system = null,
        public readonly ?int $order = null,
        public readonly ?string $placeholder = null,
    ) {
    }
}
