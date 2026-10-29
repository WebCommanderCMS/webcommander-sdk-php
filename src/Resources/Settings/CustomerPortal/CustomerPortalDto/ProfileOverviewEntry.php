<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;

/** One row of `overview`; `show_product_info` comes only on the last-viewed and last-bought rows. */
final class ProfileOverviewEntry extends Dto
{
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?bool $active = null,
        public readonly ?int $order = null,
        public readonly ?string $label = null,
        public readonly ?bool $showProductInfo = null,
    ) {
    }
}
