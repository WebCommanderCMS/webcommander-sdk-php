<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettingsDto;

use WebCommander\Client\Dto;

/** The `continue_shopping` section; `$continueShoppingSpecifiedTarget` is a page slug, and one
 *  naming no page is `400`. */
final class ContinueShopping extends Dto
{
    public const ENVELOPE_KEY = 'continue_shopping';

    public function __construct(
        public readonly ?bool $enableContinueShopping = null,
        public readonly ?string $continueShoppingTarget = null,
        public readonly ?string $continueShoppingSpecifiedTarget = null,
    ) {
    }
}
