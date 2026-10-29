<?php

declare(strict_types=1);

namespace WebCommander\Resources\Trash;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Trash\TrashDto\TrashBulkDeleteResult;
use WebCommander\Resources\Trash\TrashDto\TrashBulkRestoreResult;
use WebCommander\Resources\Trash\TrashDto\TrashItem;
use WebCommander\Resources\Trash\TrashDto\TrashPage;
use WebCommander\Resources\Trash\TrashDto\TrashTypeList;

/** Trash endpoints, under `/api/{api_version}/admin`. */
final class Trash
{
    /** List trashed rows, newest change first - `GET /admin/trash`. `type` (a `types` value, any
     *  case, or a comma list), `search` or `searchText`, `sort` `name`, `type`, `updated` or
     *  `removed_at` with `order` or `dir`, `limit` or `max` (above 100 is `400`), `offset`, `page`,
     *  `removed_from` and `removed_to`; any other name is `400`. An unfiltered page can outlast the
     *  default `timeoutSeconds`, so pass `type`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listTrash(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TrashUrls::TRASH, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TrashPage::class);
    }

    /** Ask whether the listing answers - `HEAD /admin/trash`; `200` with no body. It takes the
     *  listing's query names and runs the same query, so pass a `type` as on the `GET`.
     *  @param array<string,mixed>|null $queryParams */
    public static function headTrash(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TrashUrls::TRASH, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** List the types the trash holds - `GET /admin/trash/types`, snake_case names such as
     *  `category`, `customer` and `blog_post`. Any query name is `400`. */
    public static function listTrashTypes(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(TrashUrls::TRASH_TYPES, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TrashTypeList::class);
    }

    /** Ask whether the type list answers - `HEAD /admin/trash/types`; `200` with no body. */
    public static function headTrashTypes(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', TrashUrls::TRASH_TYPES, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Restore one trashed row - `POST /admin/trash/{trash_type}/{trash_item_id}/restore`; no body,
     *  `200` with the row under `item`. A live row is `409`, an id the type does not hold `404`. */
    public static function restoreTrashItem(WebCommanderClient $client, string $trashType, int|string $trashItemId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TrashUrls::TRASH_ITEM_RESTORE, pathParams: ['trash_type' => $trashType, 'trash_item_id' => $trashItemId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TrashItem::class);
    }

    /** Delete one trashed row for good - `DELETE /admin/trash/{trash_type}/{trash_item_id}`, `204`.
     *  A live row is `409`; once purged, every read and a second delete are `404`. */
    public static function deleteTrashItem(WebCommanderClient $client, string $trashType, int|string $trashItemId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(TrashUrls::TRASH_ITEM, pathParams: ['trash_type' => $trashType, 'trash_item_id' => $trashItemId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Restore up to 100 rows - `POST /admin/trash/bulk-restore` with `{"items": [{"type", "id"}]}`.
     *  `200` when every item is restored, `207` with the same body when any fails.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function bulkRestoreTrash(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TrashUrls::TRASH_BULK_RESTORE, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TrashBulkRestoreResult::class);
    }

    /** Delete up to 100 trashed rows for good - `POST /admin/trash/bulk-delete`, the bulk restore's
     *  body. `200` when every item is deleted, `207` with the same body when any fails.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function bulkDeleteTrash(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(TrashUrls::TRASH_BULK_DELETE, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: TrashBulkDeleteResult::class);
    }
}
