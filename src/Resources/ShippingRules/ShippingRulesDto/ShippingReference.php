<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRules\ShippingRulesDto;

use WebCommander\Client\Dto;

/** An `{id, name}` pair: the rule's class, rate, zones and profiles. A write names a class, a rate or a zone by its id, bare or as `{"id": ...}`; `$name` is read-only. */
final class ShippingReference extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
    ) {
    }
}
