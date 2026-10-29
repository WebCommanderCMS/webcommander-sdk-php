<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SiteSettings\SiteSettingsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** The `captcha` block; `private_key` and `private_key_v3` read back as `***`, and `minimum_score`
 *  is typed as the number the body sends, not the metadata's `string`. */
final class Captcha extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?float $minimumScore = null,
        public readonly ?string $privateKey = null,
        public readonly ?string $privateKeyTurnstile = null,
        #[WireName('private_key_v3')]
        public readonly ?string $privateKeyV3 = null,
        public readonly ?string $publicKey = null,
        public readonly ?string $publicKeyTurnstile = null,
        #[WireName('public_key_v3')]
        public readonly ?string $publicKeyV3 = null,
        public readonly ?string $type = null,
        public readonly ?bool $useOwn = null,
        public readonly ?string $version = null,
    ) {
    }
}
