<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderFlags\OrderFlagsDto;

use WebCommander\Client\Dto;

/** One order flag, the same five fields on the listing row and the row path; `$type` is always
 *  `order` and not writable. */
final class OrderFlag extends Dto
{
    public const ENVELOPE_KEY = 'order_flag';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $color = null,
        public readonly ?string $description = null,
        public readonly ?string $type = null,
    ) {
    }
}
