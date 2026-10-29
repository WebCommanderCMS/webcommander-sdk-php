<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** The `custom_code` section: the header and footer blocks served on every storefront page. */
final class CustomCode extends Dto
{
    public const ENVELOPE_KEY = 'custom_code';

    public function __construct(
        public readonly ?CustomCodeBlock $header = null,
        public readonly ?CustomCodeBlock $footer = null,
    ) {
    }
}
