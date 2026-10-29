<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `redirects` rows inlined in `url_settings`, without `pagination`. */
final class RedirectsPreview extends Dto
{
    /** @param list<Redirect|null>|null $items */
    public function __construct(
        #[ListOf(Redirect::class)]
        public readonly ?array $items = null,
    ) {
    }
}
