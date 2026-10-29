<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One content type the search covers: whether it is searched, its heading and the rows held out. */
final class SearchableContentGroup extends Dto
{
    /** @param list<ExcludedRecord|null>|null $excluded */
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $displayHeading = null,
        #[ListOf(ExcludedRecord::class)]
        public readonly ?array $excluded = null,
    ) {
    }
}
