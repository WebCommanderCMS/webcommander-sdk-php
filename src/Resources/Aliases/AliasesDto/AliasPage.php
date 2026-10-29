<?php

declare(strict_types=1);

namespace WebCommander\Resources\Aliases\AliasesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing. The resource serves no field schema: `field_metadata` adds no key. */
final class AliasPage extends Dto
{
    /** @param list<Alias|null>|null $aliases */
    public function __construct(
        #[ListOf(Alias::class)]
        public readonly ?array $aliases = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
