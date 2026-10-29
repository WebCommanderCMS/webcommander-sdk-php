<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderCustomFields\OrderCustomFieldsDto;

use WebCommander\Client\Dto;

/** The listing's one `group_meta` entry: `kind` `resource`, `writable` false. */
final class ResourceMeta extends Dto
{
    public function __construct(
        public readonly ?string $kind = null,
        public readonly ?bool $writable = null,
        public readonly ?string $href = null,
    ) {
    }
}
