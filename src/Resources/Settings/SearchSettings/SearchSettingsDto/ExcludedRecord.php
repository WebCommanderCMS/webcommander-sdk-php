<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;

/** One entry of an `excluded` list as a read sends it; a write takes these or bare ids. */
final class ExcludedRecord extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
