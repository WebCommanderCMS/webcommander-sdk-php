<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class CategoryPage extends Dto
{
    public const ENVELOPE_KEY = 'category_page';

    public function __construct(
        public readonly ?CategoryInformation $categoryInformation = null,
        public readonly ?ProductInformation $productInformation = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
