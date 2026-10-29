<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories\CategoriesDto;

use WebCommander\Client\Dto;

/** The body every write takes, `{"category": {<section>: {...}}}`: a create, a `PUT`, a `PATCH`
 *  and a section `PATCH` alike, the last reading only its own section. `transaction_no` is read
 *  inside the `category` wrapper only; beside it, it is ignored and nothing is filed. */
final class CategoryInput extends Dto
{
    public const ENVELOPE_KEY = 'category';

    public function __construct(
        public readonly ?CategoryGeneralInput $general = null,
        public readonly ?CategoryDescription $description = null,
        public readonly ?CategoryImagesMediaInput $imagesMedia = null,
        public readonly ?CategoryAvailabilityVisibilityInput $availabilityVisibility = null,
        public readonly ?CategoryTaxShipping $taxShipping = null,
        public readonly ?CategoryAssignProductsInput $assignProducts = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
