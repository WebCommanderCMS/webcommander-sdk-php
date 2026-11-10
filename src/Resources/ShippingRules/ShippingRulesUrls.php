<?php

declare(strict_types=1);

namespace WebCommander\Resources\ShippingRules;

final class ShippingRulesUrls
{
    public const SHIPPING_RULES = '/api/{api_version}/admin/shipping_rules';
    public const SHIPPING_RULES_COUNT = '/api/{api_version}/admin/shipping_rules/count';
    public const SHIPPING_RULE = '/api/{api_version}/admin/shipping_rules/{shipping_rule_id}';

    /** Files a new record under this transaction number; it wins over a `transaction_no` in the body. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
