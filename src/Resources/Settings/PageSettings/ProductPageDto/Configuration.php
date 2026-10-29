<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

use WebCommander\Client\Dto;

/** The `configuration` section: what the product page itself shows, in four blocks. */
final class Configuration extends Dto
{
    public const ENVELOPE_KEY = 'configuration';

    public function __construct(
        public readonly ?ActionButtons $actionsButtons = null,
        public readonly ?ProductDetails $details = null,
        public readonly ?SocialSharing $socialSharing = null,
        public readonly ?SetProductProperties $setProductProperties = null,
    ) {
    }
}
