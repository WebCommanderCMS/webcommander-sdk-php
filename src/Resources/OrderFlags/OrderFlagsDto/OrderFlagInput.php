<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderFlags\OrderFlagsDto;

use WebCommander\Client\Dto;

/** The body both writes take; `name` and a hex `color` are required. The update is a replace, so
 *  an unset `description` is cleared. */
final class OrderFlagInput extends Dto
{
    public const ENVELOPE_KEY = 'order_flag';

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $color = null,
        public readonly ?string $description = null,
    ) {
    }
}
