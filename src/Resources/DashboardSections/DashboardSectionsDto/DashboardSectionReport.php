<?php

declare(strict_types=1);

namespace WebCommander\Resources\DashboardSections\DashboardSectionsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One tab of the Dashboard. `section` echoes the path value, and only the fields of that tab are present. `ecommerce`: `order_updates`, `best_selling_products`. `content`: `content_updates`, `top_pages`. `bookings`: `needs_attention`, `upcoming`. `courses`: `new_enrolments`, `unpaid_orders`, `popular_courses`. `blog`: `comments_to_moderate`, `drafts_to_publish`, `most_viewed_posts`. `upcoming` and `popular_courses` were empty on the store measured, so the shape of a row is not known. */
final class DashboardSectionReport extends Dto
{
    /**
     * @param list<SectionBestSeller|null>|null $bestSellingProducts
     * @param list<SectionContentUpdate|null>|null $contentUpdates
     * @param list<SectionTopPage|null>|null $topPages
     * @param list<mixed>|null $upcoming
     * @param list<mixed>|null $popularCourses
     * @param list<SectionViewedPost|null>|null $mostViewedPosts
     */
    public function __construct(
        public readonly ?string $section = null,
        public readonly ?SectionPeriod $period = null,
        public readonly ?SectionOrderUpdates $orderUpdates = null,
        #[ListOf(SectionBestSeller::class)]
        public readonly ?array $bestSellingProducts = null,
        #[ListOf(SectionContentUpdate::class)]
        public readonly ?array $contentUpdates = null,
        #[ListOf(SectionTopPage::class)]
        public readonly ?array $topPages = null,
        public readonly ?SectionNeedsAttention $needsAttention = null,
        public readonly ?array $upcoming = null,
        public readonly ?int $newEnrolments = null,
        public readonly ?int $unpaidOrders = null,
        public readonly ?array $popularCourses = null,
        public readonly ?int $commentsToModerate = null,
        public readonly ?SectionDrafts $draftsToPublish = null,
        #[ListOf(SectionViewedPost::class)]
        public readonly ?array $mostViewedPosts = null,
    ) {
    }
}
