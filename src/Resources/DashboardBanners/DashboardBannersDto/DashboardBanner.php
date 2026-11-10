<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;

/** One banner. `key` is the `banner_key` of the other calls. `position` counts from 1 over every banner, hidden ones included, and `active` false hides it from the Dashboard feed only. */
final class DashboardBanner extends Dto
{
    /**
     * @param list<string|null>|null $tags
     */
    public function __construct(
        public readonly ?string $key = null,
        public readonly ?int $position = null,
        public readonly ?bool $active = null,
        public readonly ?string $icon = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?array $tags = null,
        public readonly ?BannerLearnMore $learnMore = null,
        public readonly ?BannerTryIt $tryIt = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
