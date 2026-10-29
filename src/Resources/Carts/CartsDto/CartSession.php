<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\CartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** The session write's answer. */
final class CartSession extends Dto
{
    public function __construct(
        #[WireName('sessionId')]
        public readonly ?string $sessionId = null,
    ) {
    }
}
