<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The fields a product listing on this page carries. Not `final`: `RelatedProducts` and `UpSell`
 *  inherit it. */
class ProductListing extends Dto
{
    public function __construct(
        public readonly ?int $numberOfProducts = null,
        public readonly ?bool $allowViewersToChangeDisplayMode = null,
        public readonly ?bool $gridView = null,
        public readonly ?bool $listView = null,
        public readonly ?bool $tabularView = null,
        public readonly ?string $selectDisplayType = null,
        public readonly ?int $maximumNumberOfColumnsPerRow = null,
        public readonly ?int $maximumNumberOfColumnsPerRowList = null,
        public readonly ?bool $shortDescription = null,
        public readonly ?bool $displayOnHover = null,
        public readonly ?bool $displayAddToCartButton = null,
        public readonly ?bool $displayAddToCompareButton = null,
        public readonly ?bool $displayAddToWishlistButton = null,
        public readonly ?bool $price = null,
        public readonly ?bool $showExpectToPayPrice = null,
        public readonly ?bool $displayRating = null,
        public readonly ?bool $displayReviewCount = null,
    ) {
    }
}
