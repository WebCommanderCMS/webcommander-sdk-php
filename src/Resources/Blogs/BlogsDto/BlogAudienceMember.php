<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** One customer, by `customer_id`, or one customer group a restricted blog is shown to. A customer also
 *  carries its `internal_id`, for reference. */
final class BlogAudienceMember extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $internalId = null,
        public readonly ?string $name = null,
    ) {
    }
}
