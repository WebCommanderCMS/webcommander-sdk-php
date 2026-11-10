<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardReports\DashboardReportsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The most viewed pages, or products when the query's `entity_name` is `product`; `entity` says which. */
final class ReportViews extends Dto
{
    /**
     * @param list<ReportViewItem|null>|null $items
     */
    public function __construct(
        public readonly ?string $entity = null,
        #[ListOf(ReportViewItem::class)]
        public readonly ?array $items = null,
    ) {
    }
}
