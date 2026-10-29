<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The type writes' body, `{"variation": {...}}`; `$standard` cannot change after the create. */
final class VariationInput extends Dto
{
    public const ENVELOPE_KEY = 'variation';

    /** @param list<VariationOptionInput|null>|null $options */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $standard = null,
        #[ListOf(VariationOptionInput::class)]
        public readonly ?array $options = null,
    ) {
    }
}
