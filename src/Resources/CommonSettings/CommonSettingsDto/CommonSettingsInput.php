<?php

declare(strict_types=1);

namespace WebCommander\Resources\CommonSettings\CommonSettingsDto;

use WebCommander\Client\Dto;

/** The list form both writes take: `settings` maps a group name to a list of `Setting` entries,
 *  `{"config_key", "value"}` each. A group may instead be `{config_key: value}` or `{name:
 *  {"config_key", "value"}}`; send those as an array or a JSON string. */
final class CommonSettingsInput extends Dto
{
    /** @param array<string,list<Setting>>|null $settings keyed by group name, so not a `#[ListOf]` field */
    public function __construct(
        public readonly mixed $settings = null,
    ) {
    }
}
