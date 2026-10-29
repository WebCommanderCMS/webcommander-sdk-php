<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The read-only `reinitialise` action: one field naming the verb its `group_meta` `href` takes. */
final class Reinitialise extends Dto
{
    public const ENVELOPE_KEY = 'reinitialise';

    public function __construct(
        public readonly ?string $action = null,
    ) {
    }
}
