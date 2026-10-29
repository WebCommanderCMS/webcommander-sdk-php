<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SearchSettings;

final class SearchSettingsUrls
{
    public const SEARCH_SETTINGS = '/api/{api_version}/admin/settings/search_settings';
    public const SEARCH_SETTINGS_SECTION = '/api/{api_version}/admin/settings/search_settings/{section}';
    public const SEARCH_SETTINGS_REINDEX_STATUS = '/api/{api_version}/admin/settings/search_settings/reindex_status';

    /** The three values `{section}` takes, in the order the facade sends them.
     *  @var list<string> */
    public const SEARCH_SETTINGS_SECTIONS = [
        'searchable_content',
        'search_fields',
        'synonyms',
    ];

    /** The section whose write starts a search reindex. */
    public const SEARCH_SETTINGS_REINDEXING_SECTION = 'synonyms';
}
