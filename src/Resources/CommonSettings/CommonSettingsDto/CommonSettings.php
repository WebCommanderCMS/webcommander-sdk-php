<?php

declare(strict_types=1);

namespace WebCommander\Resources\CommonSettings\CommonSettingsDto;

use WebCommander\Client\Dto;

/** What the read and both writes answer: `settings`, group name to a list of `{"config_key",
 *  "value"}` maps. The `notifications` group alone is a name to `bool` map, so the groups stay a
 *  plain array. */
final class CommonSettings extends Dto
{
    public function __construct(
        public readonly mixed $settings = null,
    ) {
    }
}
