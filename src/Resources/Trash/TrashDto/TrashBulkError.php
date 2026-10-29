<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash\TrashDto;

use WebCommander\Client\Dto;

/** One item a bulk call could not act on: an error `code` such as `not_found` or `not_in_trash`,
 *  and why in words. */
final class TrashBulkError extends Dto
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $message = null,
    ) {
    }
}
