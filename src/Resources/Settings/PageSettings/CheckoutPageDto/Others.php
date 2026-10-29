<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `others` section, the checkout page's chrome; `login_url` is required. */
final class Others extends Dto
{
    public const ENVELOPE_KEY = 'others';

    public function __construct(
        public readonly ?bool $showLogo = null,
        public readonly ?string $loginUrl = null,
        public readonly ?string $customHtml = null,
        public readonly ?OrderComment $comment = null,
        public readonly ?TermsAndCondition $termsAndCondition = null,
    ) {
    }
}
