<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash;

final class TrashUrls
{
    public const TRASH = '/api/{api_version}/admin/trash';
    public const TRASH_TYPES = '/api/{api_version}/admin/trash/types';
    public const TRASH_ITEM = '/api/{api_version}/admin/trash/{trash_type}/{trash_item_id}';
    public const TRASH_ITEM_RESTORE = '/api/{api_version}/admin/trash/{trash_type}/{trash_item_id}/restore';
    public const TRASH_BULK_RESTORE = '/api/{api_version}/admin/trash/bulk-restore';
    public const TRASH_BULK_DELETE = '/api/{api_version}/admin/trash/bulk-delete';
}
