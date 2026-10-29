<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;

/** One entry of `variation_combination.types`, a variation type the store defines; take ids from
 *  `field_metadata`'s `allowed_values`. */
final class VariationType extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
