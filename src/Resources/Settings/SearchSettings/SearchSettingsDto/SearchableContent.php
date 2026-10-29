<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;

/** The `searchable_content` section: the search box's text and the content types it reaches. */
final class SearchableContent extends Dto
{
    public const ENVELOPE_KEY = 'searchable_content';

    public function __construct(
        public readonly ?string $placeholderText = null,
        public readonly ?SearchableContentGroup $product = null,
        public readonly ?ProductCategoriesContent $productCategories = null,
        public readonly ?SearchableContentGroup $blog = null,
        public readonly ?SearchableContentGroup $otherPages = null,
    ) {
    }
}
