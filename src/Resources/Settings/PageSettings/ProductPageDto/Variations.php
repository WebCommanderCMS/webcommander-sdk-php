<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `variations` section: how a product's variations are labelled and laid out. */
final class Variations extends Dto
{
    public const ENVELOPE_KEY = 'variations';

    public function __construct(
        public readonly ?LabelsAndDisplay $labelsAndDisplay = null,
        public readonly ?VariationLayout $layout = null,
    ) {
    }
}
