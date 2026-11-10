<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews;

final class OrderPreviewsUrls
{
    public const ORDER_PREVIEWS = '/api/{api_version}/admin/orders/preview';
    public const ORDER_PREVIEW = '/api/{api_version}/admin/orders/preview/{preview_session_id}';
    public const ORDER_PREVIEW_CONFIRM = '/api/{api_version}/admin/orders/preview/{preview_session_id}/confirm';
    public const ORDER_PREVIEW_COUPON = '/api/{api_version}/admin/orders/preview/{preview_session_id}/coupon';
    public const ORDER_PREVIEW_GIFT_CARD = '/api/{api_version}/admin/orders/preview/{preview_session_id}/gift-card';
}
