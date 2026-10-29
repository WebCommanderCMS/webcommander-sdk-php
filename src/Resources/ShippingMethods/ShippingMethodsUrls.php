<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingMethods;

final class ShippingMethodsUrls
{
    public const SHIPPING_METHODS = '/api/{api_version}/admin/shipping_methods';
    public const SHIPPING_METHODS_COUNT = '/api/{api_version}/admin/shipping_methods/count';
    public const SHIPPING_METHOD = '/api/{api_version}/admin/shipping_methods/{shipping_method_id}';
    public const SHIPPING_METHOD_DEFAULT = '/api/{api_version}/admin/shipping_methods/{shipping_method_id}/default';
}
