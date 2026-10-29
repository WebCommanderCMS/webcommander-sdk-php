<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `layout` block: how variations are laid out and which price shows; read `field_metadata`
 *  for the `variation_combinations` it allows before sending one. */
final class VariationLayout extends Dto
{
    /** @param list<VariationType|null>|null $variationCombinations */
    public function __construct(
        public readonly ?bool $selectVariationView = null,
        public readonly ?string $selectVariationViewType = null,
        public readonly ?bool $displayVariationCombinations = null,
        #[ListOf(VariationType::class)]
        public readonly ?array $variationCombinations = null,
        public readonly ?bool $variationPriceDisplayMode = null,
        public readonly ?string $variationPriceDisplayType = null,
    ) {
    }
}
