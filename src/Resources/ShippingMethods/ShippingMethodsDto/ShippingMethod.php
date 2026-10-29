<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingMethods\ShippingMethodsDto;

use WebCommander\Client\Dto;

/** One shipping method: a listing row, or a row path's `shipping_method` record, the same three
 *  fields either way. `$fieldMetadata` is `mixed` because its entries differ in width. */
final class ShippingMethod extends Dto
{
    public const ENVELOPE_KEY = 'shipping_method';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?bool $isDefault = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
