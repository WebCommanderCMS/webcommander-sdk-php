<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;

/** The write body, bare. A create needs `key` (`a-z`, `0-9` and `_`, starting with a letter, up to 64 characters, unique), `title` (1 to 80 characters), `description` (1 to 200) and `learn_more`; `tags` holds at most 3, `active` defaults to `true` and `position` to the end of the list. A patch sends only what changes and cannot send `key`. `icon` is stored as sent. `position` runs from 1 to one past the banner count, and the banners after it shift down. */
final class DashboardBannerInput extends Dto
{
    /**
     * @param list<string|null>|null $tags
     */
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?string $icon = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?array $tags = null,
        public readonly ?BannerLearnMore $learnMore = null,
        public readonly ?BannerTryIt $tryIt = null,
        public readonly ?int $position = null,
        public readonly ?bool $active = null,
    ) {
    }
}
