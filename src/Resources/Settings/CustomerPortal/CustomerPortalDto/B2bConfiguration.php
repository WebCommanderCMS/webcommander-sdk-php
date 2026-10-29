<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** The `b2b_configuration` block: what a new registrant is created as. */
final class B2bConfiguration extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $createAsOrganisation = null,
        public readonly ?bool $createAsCustomer = null,
        public readonly ?bool $organisationSelected = null,
    ) {
    }
}
