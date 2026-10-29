<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingClasses\ShippingClassesDto;

use WebCommander\Client\Dto;

/** One shipping class: a listing row, or a row path's `shipping_class` record, the same four fields
 *  either way. `$fieldMetadata` is `mixed` because its entries differ in width. */
final class ShippingClass extends Dto
{
    public const ENVELOPE_KEY = 'shipping_class';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?bool $isDefault = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
