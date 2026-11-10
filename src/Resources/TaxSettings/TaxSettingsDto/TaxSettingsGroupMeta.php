<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings\TaxSettingsDto;

use WebCommander\Client\Dto;

/** The `group_meta` block: the settings area and the two tax collections beside it. */
final class TaxSettingsGroupMeta extends Dto
{

    public function __construct(
        public readonly ?TaxSettingsAreaMeta $taxSettings = null,
        public readonly ?TaxSettingsAreaMeta $taxProfiles = null,
        public readonly ?TaxSettingsAreaMeta $taxRules = null,
    ) {
    }
}
