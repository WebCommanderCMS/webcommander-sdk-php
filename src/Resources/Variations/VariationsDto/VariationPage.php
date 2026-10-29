<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, and the schema when `field_metadata` is asked for. */
final class VariationPage extends Dto
{
    /** @param list<Variation|null>|null $variations */
    public function __construct(
        #[ListOf(Variation::class)]
        public readonly ?array $variations = null,
        public readonly mixed $fieldMetadata = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
