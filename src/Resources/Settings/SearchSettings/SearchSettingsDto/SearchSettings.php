<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves the
 *  rest null. `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class SearchSettings extends Dto
{
    public const ENVELOPE_KEY = 'search_settings';

    public function __construct(
        public readonly ?SearchableContent $searchableContent = null,
        public readonly ?SearchFields $searchFields = null,
        public readonly ?Synonyms $synonyms = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
