<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The facade's `group_meta` block, one `SectionMeta` per section. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $portal = null,
        public readonly ?SectionMeta $registration = null,
        public readonly ?SectionMeta $login = null,
        public readonly ?SectionMeta $sso = null,
        public readonly ?SectionMeta $profilePage = null,
        public readonly ?SectionMeta $registrationFields = null,
    ) {
    }
}
