<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;

/** The optional second button; both fields are needed. */
final class BannerTryIt extends Dto
{
    public function __construct(
        public readonly ?string $label = null,
        public readonly ?string $url = null,
    ) {
    }
}
