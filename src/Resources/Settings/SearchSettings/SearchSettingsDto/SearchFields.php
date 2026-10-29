<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `search_fields` section. */
final class SearchFields extends Dto
{
    public const ENVELOPE_KEY = 'search_fields';

    /** @param list<SearchFieldPriority|null>|null $fields */
    public function __construct(
        public readonly ?bool $matchKeywordsExactly = null,
        public readonly ?bool $matchFullSentences = null,
        #[ListOf(SearchFieldPriority::class)]
        public readonly ?array $fields = null,
    ) {
    }
}
