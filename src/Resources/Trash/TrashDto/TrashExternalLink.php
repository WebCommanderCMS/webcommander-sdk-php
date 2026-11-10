<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;

/** One link outside the store: the `system`, its `entity` and `external_id`, a `name` and the `reason`
 *  it blocks a permanent delete. */
final class TrashExternalLink extends Dto
{
    public function __construct(
        public readonly ?string $system = null,
        public readonly ?string $entity = null,
        public readonly ?string $name = null,
        public readonly ?string $externalId = null,
        public readonly ?string $reason = null,
    ) {
    }
}
