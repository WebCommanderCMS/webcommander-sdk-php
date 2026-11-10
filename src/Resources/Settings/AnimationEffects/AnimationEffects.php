<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\AnimationEffects;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto\AnimationEffects as AnimationEffectsBody;
use WebCommander\Resources\Settings\AnimationEffects\AnimationEffectsDto\CustomLoaderSection;

/** Animation effects endpoints, under `/api/{api_version}/admin/settings/animation_effects`: a
 *  facade over five sections, with no `PUT`. */
final class AnimationEffects
{
    /** Retrieve the area - `GET /admin/settings/animation_effects`, all five sections and `group_meta`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getAnimationEffects(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AnimationEffectsUrls::ANIMATION_EFFECTS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AnimationEffectsBody::class);
    }

    /** Update the area - `PATCH /admin/settings/animation_effects`, wrapped in `animation_effects` and
     *  nothing else; partial at every level.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchAnimationEffects(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(AnimationEffectsUrls::ANIMATION_EFFECTS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AnimationEffectsBody::class);
    }

    /** Ask whether the area answers - `HEAD /admin/settings/animation_effects`; `200` with no body and
     *  an `ETag`. */
    public static function headAnimationEffects(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendApiRequest('HEAD', AnimationEffectsUrls::ANIMATION_EFFECTS, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Retrieve one section - `GET /admin/settings/animation_effects/{section}`, under the section's own
     *  key; `$section` is one of `AnimationEffectsUrls::ANIMATION_EFFECTS_SECTIONS`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getAnimationEffectsSection(WebCommanderClient $client, string $section, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AnimationEffectsUrls::ANIMATION_EFFECTS_SECTION, pathParams: ['section' => $section], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AnimationEffectsBody::class);
    }

    /** Update one section - `PATCH /admin/settings/animation_effects/{section}`, wrapped in the
     *  section's own key and nothing else; only the fields being changed need appear.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchAnimationEffectsSection(WebCommanderClient $client, string $section, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(AnimationEffectsUrls::ANIMATION_EFFECTS_SECTION, pathParams: ['section' => $section], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: AnimationEffectsBody::class);
    }

    /** Upload the custom preloader image - `POST /admin/settings/animation_effects/custom_loader`, `201`,
     *  and the loader reads `enabled: true`. The part is `file` (svg, png, jpg, jpeg or gif).
     *  @param mixed $files one part named exactly "file", as [filename, contents, contentType] */
    public static function uploadAnimationEffectsCustomLoader(WebCommanderClient $client, mixed $files, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        self::requireFiles($files);
        return $client->sendPostRequest(AnimationEffectsUrls::ANIMATION_EFFECTS_CUSTOM_LOADER, files: $files, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: CustomLoaderSection::class);
    }

    /** Remove the custom preloader image - `DELETE /admin/settings/animation_effects/custom_loader`,
     *  `204`, also when there is none. */
    public static function deleteAnimationEffectsCustomLoader(WebCommanderClient $client, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AnimationEffectsUrls::ANIMATION_EFFECTS_CUSTOM_LOADER, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    private static function requireFiles(mixed $files): void
    {
        if (!is_array($files) || $files === []) {
            throw new SdkUsageError("files: pass ['file' => [filename, contents, contentType]]");
        }
    }
}
