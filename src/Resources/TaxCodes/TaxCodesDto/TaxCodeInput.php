<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCodes\TaxCodesDto;

use WebCommander\Client\Dto;

/** The body both writes take. An update resets an unset `$priority` and `$resolverType` to `0` and
 *  `flat`; `default` is not writable, so it is not declared. */
final class TaxCodeInput extends Dto
{
    public const ENVELOPE_KEY = 'tax_code';

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $label = null,
        public readonly ?string $description = null,
        public readonly ?float $rate = null,
        public readonly ?string $resolverType = null,
        public readonly ?int $priority = null,
    ) {
    }
}
