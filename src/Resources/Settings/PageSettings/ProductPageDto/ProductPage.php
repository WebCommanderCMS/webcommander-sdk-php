<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's, which also arrives under `product_page` and fills that
 *  field only. `$fieldMetadata` is `mixed`: its entries differ by field type. */
final class ProductPage extends Dto
{
    public const ENVELOPE_KEY = 'product_page';

    public function __construct(
        public readonly ?Configuration $configuration = null,
        public readonly ?Variations $variations = null,
        public readonly ?ImageAndVideo $imageAndVideo = null,
        public readonly ?UpSell $upSell = null,
        public readonly ?RelatedProducts $relatedProducts = null,
        public readonly ?ReviewAndRatings $reviewAndRatings = null,
        public readonly ?QuickView $quickView = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
