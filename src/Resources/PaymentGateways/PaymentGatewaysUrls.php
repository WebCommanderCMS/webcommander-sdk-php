<?php

declare(strict_types=1);

namespace WebCommander\Resources\PaymentGateways;

final class PaymentGatewaysUrls
{
    public const PAYMENT_GATEWAYS = '/api/{api_version}/admin/payment_gateways';
    public const PAYMENT_GATEWAYS_COUNT = '/api/{api_version}/admin/payment_gateways/count';
    public const PAYMENT_GATEWAY = '/api/{api_version}/admin/payment_gateways/{payment_gateway_id}';
}
