<?php

declare(strict_types=1);

namespace WebCommander\Resources\CommonSettings\CommonSettingsDto;

use WebCommander\Client\Dto;

/** The registration form: `fields` lists the active fields' keys in their order, and
 *  `fieldsConfigs` configures every field, inactive ones included. */
final class CustomerFields extends Dto
{
    /** @param list<string|null>|null $fields */
    public function __construct(
        public readonly ?array $fields = null,
        public readonly ?CustomerFieldConfigs $fieldsConfigs = null,
    ) {
    }
}
