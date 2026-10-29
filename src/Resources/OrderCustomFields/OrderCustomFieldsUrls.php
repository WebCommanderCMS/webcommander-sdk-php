<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderCustomFields;

final class OrderCustomFieldsUrls
{
    public const ORDER_CUSTOM_FIELDS = '/api/{api_version}/admin/order_custom_fields';
    public const ORDER_CUSTOM_FIELDS_COUNT = '/api/{api_version}/admin/order_custom_fields/count';
    public const ORDER_CUSTOM_FIELD = '/api/{api_version}/admin/order_custom_fields/{order_custom_field_id}';
    public const ORDER_CUSTOM_FIELD_VALIDATE_TIMESLOT = '/api/{api_version}/admin/order_custom_fields/{order_custom_field_id}/validate_timeslot';
}
