<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCodes\TaxCodesDto;

use WebCommander\Client\Dto;

/** One tax code, the same eight keys on the listing row and the row path. `$default` is read-only
 *  and not exclusive: it marks a code the store built. */
final class TaxCode extends Dto
{
    public const ENVELOPE_KEY = 'tax_code';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $label = null,
        public readonly ?string $description = null,
        public readonly ?float $rate = null,
        public readonly ?string $resolverType = null,
        public readonly ?int $priority = null,
        public readonly ?bool $default = null,
    ) {
    }
}
