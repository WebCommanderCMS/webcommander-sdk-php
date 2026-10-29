<?php

declare(strict_types=1);

namespace WebCommander\Resources\Pages\PagesDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page: a listing row, the row read and every write's answer, the same 23 keys. `$visibility`
 *  is `open`, `hidden` or `restricted`; `$visibleTo` is `all` or `selected` on a restricted page
 *  and null otherwise. `$store` is null on every page the store holds, so it stays `mixed`. */
final class Page extends Dto
{
    public const ENVELOPE_KEY = 'page';

    /** @param list<PageReference|null>|null $customers
     *  @param list<PageReference|null>|null $customerGroups */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $title = null,
        public readonly ?string $subtitle = null,
        public readonly ?string $url = null,
        public readonly ?string $fullUrl = null,
        public readonly ?PageReference $layout = null,
        public readonly ?string $visibility = null,
        public readonly ?string $visibleTo = null,
        #[ListOf(PageReference::class)]
        public readonly ?array $customers = null,
        #[ListOf(PageReference::class)]
        public readonly ?array $customerGroups = null,
        public readonly ?string $bodyClass = null,
        public readonly ?PagePasswordProtection $passwordProtection = null,
        public readonly ?PageMenuPlacement $menuPlacement = null,
        public readonly ?bool $active = null,
        public readonly ?bool $disableTracking = null,
        public readonly ?bool $landing = null,
        public readonly ?bool $inTrash = null,
        public readonly ?PagePublishing $publishing = null,
        public readonly mixed $store = null,
        public readonly ?PageReference $author = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }
}
