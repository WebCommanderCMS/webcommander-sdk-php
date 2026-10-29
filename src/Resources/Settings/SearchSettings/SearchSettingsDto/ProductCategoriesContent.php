<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `product_categories` group, the only one with a fourth field. It repeats the three of
 *  `SearchableContentGroup` because a subclass cannot re-promote a parent's readonly properties. */
final class ProductCategoriesContent extends Dto
{
    /** @param list<ExcludedRecord|null>|null $excluded */
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $hideParentCategory = null,
        public readonly ?string $displayHeading = null,
        #[ListOf(ExcludedRecord::class)]
        public readonly ?array $excluded = null,
    ) {
    }
}
