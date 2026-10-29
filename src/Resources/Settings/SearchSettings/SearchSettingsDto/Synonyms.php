<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

final class Synonyms extends Dto
{
    public const ENVELOPE_KEY = 'synonyms';

    /** @param list<SynonymGroup|null>|null $groups */
    public function __construct(
        #[ListOf(SynonymGroup::class)]
        public readonly ?array $groups = null,
    ) {
    }
}
