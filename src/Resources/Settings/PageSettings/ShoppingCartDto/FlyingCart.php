<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ShoppingCartDto;

use WebCommander\Client\Dto;

/** The `flying_cart` section: the slide-out cart and what it offers. */
final class FlyingCart extends Dto
{
    public const ENVELOPE_KEY = 'flying_cart';

    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $enableClearCart = null,
        public readonly ?bool $saveCart = null,
    ) {
    }
}
