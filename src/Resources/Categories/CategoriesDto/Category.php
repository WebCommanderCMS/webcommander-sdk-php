<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** One category: a listing row, a row read, a whole-row write's answer, or a section's answer,
 *  which carries that one section alone under `category`. */
final class Category extends Dto
{
    public const ENVELOPE_KEY = 'category';

    public function __construct(
        public readonly ?CategoryGeneral $general = null,
        public readonly ?CategoryDescription $description = null,
        public readonly ?CategoryImagesMedia $imagesMedia = null,
        public readonly ?CategoryAvailabilityVisibility $availabilityVisibility = null,
        public readonly ?CategoryTaxShipping $taxShipping = null,
        public readonly ?CategoryAssignProducts $assignProducts = null,
        public readonly ?int $id = null,
        /** The number the category was filed under, null when none. */
        public readonly ?string $transactionNo = null,
        public readonly ?bool $disposable = null,
        public readonly ?bool $inTrash = null,
        public readonly ?bool $parentInTrash = null,
        public readonly ?string $createdBy = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedBy = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
