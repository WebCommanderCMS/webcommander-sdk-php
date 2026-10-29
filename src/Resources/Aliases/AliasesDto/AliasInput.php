<?php

declare(strict_types=1);

namespace WebCommander\Resources\Aliases\AliasesDto;

use WebCommander\Client\Dto;

/** The create body, `{"alias": "<hostname>"}`. The field is bare: the same hostname wrapped in an
 *  `alias` record is `400 invalid_hostname`, so this type declares no `ENVELOPE_KEY`. */
final class AliasInput extends Dto
{
    public function __construct(
        public readonly ?string $alias = null,
    ) {
    }
}
