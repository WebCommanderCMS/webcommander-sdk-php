<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** One redirect: the store's `id` and the pair of URLs. */
final class Redirect extends Dto
{
    public const ENVELOPE_KEY = 'redirect';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $sourceUrl = null,
        public readonly ?string $destinationUrl = null,
    ) {
    }
}
