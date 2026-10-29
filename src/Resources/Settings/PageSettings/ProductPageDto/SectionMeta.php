<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** One `group_meta` entry; the plugin-backed one also carries `plugin` and `available`. */
final class SectionMeta extends Dto
{
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?bool $writable = null,
        public readonly ?string $plugin = null,
        public readonly ?bool $available = null,
        public readonly ?string $uiLabel = null,
        public readonly ?string $href = null,
    ) {
    }
}
