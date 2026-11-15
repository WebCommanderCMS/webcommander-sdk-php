<?php

declare(strict_types=1);

namespace WebCommander\Resources\Carts\AdminCartsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The create and replace body, bare. `$products` is required, and so is `$customerId` on a replace; `$sessionId` on a create names the session yourself, in the `PRV-` form. An unknown field is `400 unknown_field`. */
final class AdminCartInput extends Dto
{
    /** @param list<AdminCartProductInput|null>|null $products */
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?string $sessionId = null,
        #[ListOf(AdminCartProductInput::class)]
        public readonly ?array $products = null,
    ) {
    }
}
