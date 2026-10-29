<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** A country or a state as the store answers it: `{"id", "name", "code"}`. */
final class Reference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $code = null,
    ) {
    }
}
