<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `labels_and_display` block: how a variation is labelled and drawn. */
final class LabelsAndDisplay extends Dto
{
    public function __construct(
        public readonly ?bool $disableVariationLabelForPrice = null,
        public readonly ?bool $displayProductImageAsVariationIcons = null,
        public readonly ?bool $displaySelectedVariationValue = null,
        public readonly ?bool $enableColourTypeVariationImageDisplay = null,
        public readonly ?bool $useStrikeThroughForOutOfStockVariations = null,
        public readonly ?bool $enableSingleClickVariationLoading = null,
    ) {
    }
}
