<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingClasses\ShippingClassesDto;

use WebCommander\Client\Dto;

/** The count sub-path's `{"shipping_classes": {"count": N}}`. */
final class ShippingClassCount extends Dto
{
    public const ENVELOPE_KEY = 'shipping_classes';

    public function __construct(
        public readonly ?int $count = null,
    ) {
    }
}
