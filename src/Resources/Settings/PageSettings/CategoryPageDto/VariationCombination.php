<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CategoryPageDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `variation_combination` block: whether combinations show, and which variation types; read
 *  `field_metadata` for the entries it allows before sending one. */
final class VariationCombination extends Dto
{
    /** @param list<VariationType|null>|null $types */
    public function __construct(
        public readonly ?bool $enabled = null,
        #[ListOf(VariationType::class)]
        public readonly ?array $types = null,
    ) {
    }
}
