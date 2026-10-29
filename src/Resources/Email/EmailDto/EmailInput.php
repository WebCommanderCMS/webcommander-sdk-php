<?php

declare(strict_types=1);

namespace WebCommander\Resources\Email\EmailDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** The send body, bare and camelCase as the store takes it; `html_content` and other unknown keys
 *  are ignored. `recipients`, `cc` and `bcc` hold at most 100 addresses together. Send
 *  `htmlContent` or a plugin template's `identifier`, not both; `$data` is the template's
 *  variables, an object of any shape. */
final class EmailInput extends Dto
{
    /** @param list<string|null>|null $recipients
     *  @param list<string|null>|null $cc
     *  @param list<string|null>|null $bcc */
    public function __construct(
        public readonly ?array $recipients = null,
        public readonly ?array $cc = null,
        public readonly ?array $bcc = null,
        public readonly ?string $subject = null,
        #[WireName('htmlContent')]
        public readonly ?string $htmlContent = null,
        #[WireName('contentType')]
        public readonly ?string $contentType = null,
        public readonly ?string $identifier = null,
        public readonly mixed $data = null,
    ) {
    }
}
