<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs\BlogsDto;

use WebCommander\Client\Dto;

/** One comment, the same twelve fields in the listing and on its own path. `$postTitle` is the
 *  blog's current title; no write on this surface adds to `$replies`. */
final class BlogComment extends Dto
{
    /** @param list<mixed>|null $replies */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $status = null,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?string $postTitle = null,
        public readonly ?string $content = null,
        public readonly ?bool $spam = null,
        public readonly ?int $likes = null,
        public readonly ?int $totalReply = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly ?array $replies = null,
    ) {
    }
}
