<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** The `category_information` section: what the category shows and how subcategories are listed. */
final class CategoryInformation extends Dto
{
    public const ENVELOPE_KEY = 'category_information';

    public function __construct(
        public readonly ?CategoryHeading $heading = null,
        public readonly ?bool $showDescription = null,
        public readonly ?bool $showBannerImage = null,
        public readonly ?bool $showImage = null,
        public readonly ?Subcategory $subcategory = null,
    ) {
    }
}
