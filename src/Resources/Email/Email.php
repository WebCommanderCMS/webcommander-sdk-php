<?php

declare(strict_types=1);

namespace WebCommander\Resources\Email;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Email\EmailDto\EmailSendResult;

/** Email endpoints, under `/api/{api_version}/admin`. */
final class Email
{
    /** Send an email - `POST /admin/email/send`, answered `200` once every message is sent. A bare
     *  body: `recipients` and `subject`, with `htmlContent` or a template `identifier` and its
     *  `data`. `$pluginUuid` is sent as the header a template send needs and switches the call to
     *  plugin auth, so an admin token is `401`. Past 500 addresses a day per sender the store
     *  answers `429` until 00:00 UTC; a body over 1048576 bytes is `413`. A send the mail server
     *  fails is `502`, `status` `failed`, each address in `rejected`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function sendEmail(WebCommanderClient $client, array|string|Dto $payload, ?string $pluginUuid = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(EmailUrls::EMAIL_SEND, jsonBody: $payload, headers: $pluginUuid === null ? null : [EmailUrls::PLUGIN_UUID_HEADER => $pluginUuid], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: EmailSendResult::class);
    }
}
