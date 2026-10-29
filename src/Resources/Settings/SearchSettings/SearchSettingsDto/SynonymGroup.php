<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;

/** One group of `synonyms.groups`: at least two words a query treats as each other. */
final class SynonymGroup extends Dto
{
    /** @param list<string>|null $keywords */
    public function __construct(
        public readonly ?array $keywords = null,
    ) {
    }
}
