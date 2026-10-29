<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** The `product_restriction` section, one switch. */
final class ProductRestriction extends Dto
{
    public const ENVELOPE_KEY = 'product_restriction';

    public function __construct(
        public readonly ?bool $enableProductRestrictionBasedOnParentCategory = null,
    ) {
    }
}
