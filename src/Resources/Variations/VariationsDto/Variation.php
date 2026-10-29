<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One variation type: a listing row, a row read and every type write's answer. */
final class Variation extends Dto
{
    public const ENVELOPE_KEY = 'variation';

    /** @param list<VariationOption|null>|null $options */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $standard = null,
        public readonly ?bool $disposable = null,
        #[ListOf(VariationOption::class)]
        public readonly ?array $options = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
