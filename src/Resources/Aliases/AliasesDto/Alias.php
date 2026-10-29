<?php

declare(strict_types=1);

namespace WebCommander\Resources\Aliases\AliasesDto;

use WebCommander\Client\Dto;

/** One alias. */
final class Alias extends Dto
{
    public const ENVELOPE_KEY = 'alias';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $alias = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
