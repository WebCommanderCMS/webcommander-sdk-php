<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** The audience a write names: customer `internal_id` values and customer group ids. */
final class BlogAudienceInput extends Dto
{
    /** @param list<int|null>|null $customers
     *  @param list<int|null>|null $groups */
    public function __construct(
        public readonly ?array $customers = null,
        public readonly ?array $groups = null,
    ) {
    }
}
