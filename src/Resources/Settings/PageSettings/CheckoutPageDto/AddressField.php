<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** One entry of an address section's `fields`: a form field and how it is drawn; `label` is null
 *  while the field keeps its default. */
final class AddressField extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $label = null,
        public readonly ?bool $active = null,
        public readonly ?bool $required = null,
        public readonly ?int $order = null,
        public readonly ?string $group = null,
    ) {
    }
}
