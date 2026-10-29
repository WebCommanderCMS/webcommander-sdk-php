<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ShoppingCartDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's `{"<section>": {...}}`, which fills that field and leaves
 *  the rest null. `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class ShoppingCart extends Dto
{
    public const ENVELOPE_KEY = 'shopping_cart';

    public function __construct(
        public readonly ?CartPage $cartPage = null,
        public readonly ?FlyingCart $flyingCart = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
