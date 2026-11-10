<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxSettings\TaxSettingsDto;

use WebCommander\Client\Dto;

/** A custom tax profile as a read names it: its id and name, or `null`. */
final class TaxProfileReference extends Dto
{

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
