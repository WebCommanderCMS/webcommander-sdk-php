<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's, which also arrives under `search_result_page` and fills
 *  that field only. `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class SearchResultPage extends Dto
{
    public const ENVELOPE_KEY = 'search_result_page';

    public function __construct(
        public readonly ?ProductInformation $productInformation = null,
        public readonly ?Seo $seo = null,
        public readonly ?ProductPromotionPreview $productPromotion = null,
        public readonly ?Reinitialise $reinitialise = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
