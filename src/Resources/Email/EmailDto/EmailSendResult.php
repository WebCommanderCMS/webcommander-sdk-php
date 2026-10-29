<?php

declare(strict_types=1);

namespace WebCommander\Resources\Email\EmailDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The send's verdict: each list holds the addresses trimmed, a repeat in any case once. */
final class EmailSendResult extends Dto
{
    /** @param list<string|null>|null $accepted
     *  @param list<EmailRejection|null>|null $rejected
     *  @param list<string|null>|null $cc
     *  @param list<string|null>|null $bcc */
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?array $accepted = null,
        #[ListOf(EmailRejection::class)]
        public readonly ?array $rejected = null,
        public readonly ?array $cc = null,
        public readonly ?array $bcc = null,
    ) {
    }
}
