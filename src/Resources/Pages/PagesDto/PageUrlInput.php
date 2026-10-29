<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;

/** The URL write's bare body, `{"url": ...}`; a `page` wrapper is `400`. */
final class PageUrlInput extends Dto
{
    public function __construct(
        public readonly ?string $url = null,
    ) {
    }
}
