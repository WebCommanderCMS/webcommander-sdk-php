<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingClasses;

final class ShippingClassesUrls
{
    public const SHIPPING_CLASSES = '/api/{api_version}/admin/shipping_classes';
    public const SHIPPING_CLASSES_COUNT = '/api/{api_version}/admin/shipping_classes/count';
    public const SHIPPING_CLASS = '/api/{api_version}/admin/shipping_classes/{shipping_class_id}';
    public const SHIPPING_CLASS_DEFAULT = '/api/{api_version}/admin/shipping_classes/{shipping_class_id}/default';
}
