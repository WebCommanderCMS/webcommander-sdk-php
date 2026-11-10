<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;

/** The support card of the Dashboard. */
final class BannerContact extends Dto
{
    public function __construct(
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $liveChat = null,
        public readonly ?string $helpCenterUrl = null,
    ) {
    }
}
