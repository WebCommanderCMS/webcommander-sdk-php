<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** The `header` or `footer` block of `custom_code`; `code` is raw HTML or JavaScript served on
 *  every page. */
final class CustomCodeBlock extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $code = null,
    ) {
    }
}
