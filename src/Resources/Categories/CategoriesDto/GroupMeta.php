<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The `group_meta` block the listing, a row read and every whole-row write send. */
final class GroupMeta extends Dto
{
    public function __construct(
        public readonly ?SectionMeta $general = null,
        public readonly ?SectionMeta $description = null,
        public readonly ?SectionMeta $imagesMedia = null,
        public readonly ?SectionMeta $availabilityVisibility = null,
        public readonly ?SectionMeta $taxShipping = null,
        public readonly ?SectionMeta $assignProducts = null,
    ) {
    }
}
