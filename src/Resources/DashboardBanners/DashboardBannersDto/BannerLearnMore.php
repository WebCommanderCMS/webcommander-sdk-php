<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardBanners\DashboardBannersDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** What the banner's learn-more button does. `action` is `open_link`, with an `https` `url`, or `open_modal`, with a `title`, a `subtitle` and at least one of `steps`. A patch replaces the whole block, so an `open_modal` block sent over an `open_link` one drops the `url`. */
final class BannerLearnMore extends Dto
{
    /**
     * @param list<BannerStep|null>|null $steps
     */
    public function __construct(
        public readonly ?string $action = null,
        public readonly ?string $label = null,
        public readonly ?string $url = null,
        public readonly ?string $title = null,
        public readonly ?string $subtitle = null,
        #[ListOf(BannerStep::class)]
        public readonly ?array $steps = null,
    ) {
    }
}
