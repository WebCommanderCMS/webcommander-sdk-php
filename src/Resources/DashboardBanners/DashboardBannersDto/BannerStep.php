<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;

/** One step of an `open_modal` banner's walkthrough. */
final class BannerStep extends Dto
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $description = null,
    ) {
    }
}
