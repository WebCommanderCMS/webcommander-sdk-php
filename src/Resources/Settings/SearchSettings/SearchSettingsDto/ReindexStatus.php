<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;

/** The bare `reindex_status` record. */
final class ReindexStatus extends Dto
{
    public function __construct(
        public readonly ?string $state = null,
        public readonly mixed $startedAt = null,
        public readonly mixed $finishedAt = null,
        public readonly mixed $error = null,
    ) {
    }
}
