<?php

declare(strict_types=1);

namespace WebCommander\Resources\Email\EmailDto;

use WebCommander\Client\Dto;

/** One address the store could not send to, and why, such as `send_failed`. */
final class EmailRejection extends Dto
{
    public function __construct(
        public readonly ?string $email = null,
        public readonly ?string $reason = null,
    ) {
    }
}
