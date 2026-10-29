<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxZones\TaxZonesDto;

use WebCommander\Client\Dto;

/** A state as a tax zone nests it; a zone write sends this record, not a bare id. */
final class TaxState extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $code = null,
    ) {
    }
}
