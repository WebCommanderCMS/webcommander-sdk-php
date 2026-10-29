<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** The cover image a write uploads; without `$base64` the stored image is left as it was. */
final class BlogImageInput extends Dto
{
    public function __construct(
        public readonly ?string $fileName = null,
        #[WireName('base64')]
        public readonly ?string $base64 = null,
        public readonly ?string $title = null,
        public readonly ?string $alternativeText = null,
    ) {
    }
}
