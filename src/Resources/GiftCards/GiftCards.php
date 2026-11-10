<?php

declare(strict_types=1);

namespace WebCommander\Resources\GiftCards;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\GiftCards\GiftCardsDto\GiftCardPage;

/** Gift card endpoints, under `/api/{api_version}/admin`. */
final class GiftCards
{
    /** List gift cards - `GET /admin/gift_cards`, newest first. `code` matches a whole code and `email` a whole address, in any case; `is_active` takes `true`, `false`, `1` or `0`, and `limit` caps at 20 with `offset` or `page` to move on. Any other name is `400` `unknown_parameter`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listGiftCards(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(GiftCardsUrls::GIFT_CARDS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: GiftCardPage::class);
    }
}
