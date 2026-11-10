<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The management list: every banner, active or not, in position order. */
final class DashboardBannerListing extends Dto
{
    /**
     * @param list<DashboardBanner|null>|null $banners
     */
    public function __construct(
        #[ListOf(DashboardBanner::class)]
        public readonly ?array $banners = null,
    ) {
    }
}
