<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The read-only `registration_fields` section, the registration form's field catalog. */
final class RegistrationFields extends Dto
{
    public const ENVELOPE_KEY = 'registration_fields';

    /** @param list<RegistrationField|null>|null $fields */
    public function __construct(
        #[ListOf(RegistrationField::class)]
        public readonly ?array $fields = null,
    ) {
    }
}
