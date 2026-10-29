<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;

/** The password gate. A listing row masks the password as `***`; the row read and the writes
 *  answer it as saved, and switching it off keeps the stored password. */
final class PagePasswordProtection extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $password = null,
    ) {
    }
}
