<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class CustomerPortal extends Dto
{
    public const ENVELOPE_KEY = 'customer_portal';

    public function __construct(
        public readonly ?Portal $portal = null,
        public readonly ?Registration $registration = null,
        public readonly ?Login $login = null,
        public readonly ?Sso $sso = null,
        public readonly ?ProfilePage $profilePage = null,
        public readonly ?RegistrationFields $registrationFields = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
