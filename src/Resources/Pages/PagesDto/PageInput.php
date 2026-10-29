<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;

/** The writable fields, wrapped in `page`, for the create, the `PUT` replace and the `PATCH`.
 *  `$customers` take public `customer_id` values, groups their ids, either bare or as
 *  `{"id": ...}`. A null field is not sent: to clear one, pass an array. */
final class PageInput extends Dto
{
    public const ENVELOPE_KEY = 'page';

    /** @param list<int|PageReference>|null $customers
     *  @param list<int|PageReference>|null $customerGroups */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $title = null,
        public readonly ?string $subtitle = null,
        public readonly ?string $url = null,
        public readonly ?PageReference $layout = null,
        public readonly ?string $visibility = null,
        public readonly ?string $visibleTo = null,
        public readonly ?array $customers = null,
        public readonly ?array $customerGroups = null,
        public readonly ?string $bodyClass = null,
        public readonly ?PagePasswordProtection $passwordProtection = null,
        public readonly ?PageMenuPlacement $menuPlacement = null,
        public readonly ?bool $active = null,
        public readonly ?bool $disableTracking = null,
    ) {
    }
}
