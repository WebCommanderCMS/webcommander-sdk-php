<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings\SearchSettingsDto;

use WebCommander\Client\Dto;

/** One row of `search_fields.fields`: a product field and its priority, 1 to 10. */
final class SearchFieldPriority extends Dto
{
    public function __construct(
        public readonly ?string $field = null,
        public readonly ?int $priority = null,
    ) {
    }
}
