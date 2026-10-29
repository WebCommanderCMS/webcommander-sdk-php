<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration;

final class SeoConfigurationUrls
{
    public const SEO_CONFIGURATION = '/api/{api_version}/admin/settings/seo_configuration';
    public const SEO_CONFIGURATION_SECTION = '/api/{api_version}/admin/settings/seo_configuration/{section}';
    public const SEO_CONFIGURATION_DOCUMENT_ROOT = '/api/{api_version}/admin/settings/seo_configuration/document_root';
    public const SEO_CONFIGURATION_DOCUMENT_ROOT_FILE = '/api/{api_version}/admin/settings/seo_configuration/document_root/{config_key}';
    public const SEO_CONFIGURATION_REDIRECTS = '/api/{api_version}/admin/settings/seo_configuration/redirects';
    public const SEO_CONFIGURATION_REDIRECT = '/api/{api_version}/admin/settings/seo_configuration/redirects/{redirect_id}';

    /** The three values `{section}` takes; `document_root` and `redirects` are collections.
     *  @var list<string> */
    public const SEO_CONFIGURATION_SECTIONS = ['global_store_settings', 'custom_code', 'url_settings'];
}
