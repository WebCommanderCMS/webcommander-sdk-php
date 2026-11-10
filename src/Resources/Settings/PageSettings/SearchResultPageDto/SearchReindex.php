<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The reindex's answer: `status` `accepted`, `clean` and a `message`. */
final class SearchReindex extends Dto
{
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?bool $clean = null,
        public readonly ?string $message = null,
    ) {
    }
}
