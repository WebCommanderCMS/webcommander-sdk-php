<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;

/** One reason the page cannot be deleted, such as `landing_page`. */
final class PageDeleteBlocker extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $message = null,
    ) {
    }
}
