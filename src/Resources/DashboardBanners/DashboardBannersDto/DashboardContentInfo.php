<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The Dashboard's feed: only the active banners, in position order, the support card, whether the store is an online store and the label of the membership. */
final class DashboardContentInfo extends Dto
{
    /**
     * @param list<DashboardBanner|null>|null $banners
     */
    public function __construct(
        #[ListOf(DashboardBanner::class)]
        public readonly ?array $banners = null,
        public readonly ?BannerContact $contact = null,
        public readonly ?bool $onlineStore = null,
        public readonly ?string $memberLabel = null,
    ) {
    }
}
