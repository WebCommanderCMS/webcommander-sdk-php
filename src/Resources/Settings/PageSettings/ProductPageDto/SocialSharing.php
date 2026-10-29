<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `social_sharing` block: whether share buttons appear, which networks, and their title. */
final class SocialSharing extends Dto
{
    public function __construct(
        public readonly ?bool $enableShareOnSocialMedia = null,
        public readonly ?bool $facebook = null,
        public readonly ?bool $twitter = null,
        public readonly ?bool $pinterest = null,
        public readonly ?bool $messenger = null,
        public readonly ?bool $linkedin = null,
        public readonly ?bool $email = null,
        public readonly ?bool $snapchat = null,
        public readonly ?bool $telegram = null,
        public readonly ?bool $reddit = null,
        public readonly ?bool $instagram = null,
        public readonly ?bool $youtube = null,
        public readonly ?bool $tiktok = null,
        public readonly ?bool $threads = null,
        public readonly ?bool $whatsapp = null,
        public readonly ?bool $bluesky = null,
        public readonly ?bool $mastodon = null,
        public readonly ?bool $copyLink = null,
        public readonly ?bool $displayTitle = null,
        public readonly ?string $title = null,
    ) {
    }
}
