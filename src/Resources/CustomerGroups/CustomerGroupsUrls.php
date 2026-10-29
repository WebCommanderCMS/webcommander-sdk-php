<?php

declare(strict_types=1);

namespace WebCommander\Resources\CustomerGroups;

final class CustomerGroupsUrls
{
    public const CUSTOMER_GROUPS = '/api/{api_version}/admin/customer_groups';
    public const CUSTOMER_GROUPS_COUNT = '/api/{api_version}/admin/customer_groups/count';
    public const CUSTOMER_GROUPS_ASSIGN = '/api/{api_version}/admin/customer_groups/assign';
    public const CUSTOMER_GROUP = '/api/{api_version}/admin/customer_groups/{customer_group_id}';
    public const CUSTOMER_GROUP_CUSTOMERS = '/api/{api_version}/admin/customer_groups/{customer_group_id}/customers';
    public const CUSTOMER_GROUP_CUSTOMER = '/api/{api_version}/admin/customer_groups/{customer_group_id}/customers/{customer_id}';
}
