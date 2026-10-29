<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `selected_customers` audience. */
final class BlogAudience extends Dto
{
    /** @param list<BlogAudienceMember|null>|null $customers
     *  @param list<BlogAudienceMember|null>|null $groups */
    public function __construct(
        #[ListOf(BlogAudienceMember::class)]
        public readonly ?array $customers = null,
        #[ListOf(BlogAudienceMember::class)]
        public readonly ?array $groups = null,
    ) {
    }
}
