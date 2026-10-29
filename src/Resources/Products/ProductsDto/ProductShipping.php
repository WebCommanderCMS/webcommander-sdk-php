<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The shipping profile; `enabled` is read-only and true while a profile is set. A create
 *  drops `profile`; an update takes it as an id or `{"id": ...}`. */
final class ProductShipping extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?ProductNamedReference $profile = null,
    ) {
    }
}
