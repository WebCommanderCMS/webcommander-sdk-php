<?php

declare(strict_types=1);

namespace WebCommander\Resources\InventoryLocations;

final class InventoryLocationsUrls
{
    public const INVENTORY_LOCATIONS = '/api/{api_version}/admin/inventory_locations';
    public const INVENTORY_LOCATION = '/api/{api_version}/admin/inventory_locations/{inventory_location_id}';
    public const INVENTORY_LOCATION_STOCK = '/api/{api_version}/admin/inventory_locations/{inventory_location_id}/stock';
    public const INVENTORY_LOCATION_DEFAULT = '/api/{api_version}/admin/inventory_locations/{inventory_location_id}/default';
    public const INVENTORY_LOCATION_STATUS = '/api/{api_version}/admin/inventory_locations/{inventory_location_id}/status';
}
