<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\SearchResultPageDto;

use WebCommander\Client\Dto;

/** The read-only `seo` section; this page's SEO is configured on the resource its `href` names. */
final class Seo extends Dto
{
    public const ENVELOPE_KEY = 'seo';

    public function __construct(
        public readonly ?bool $readOnly = null,
        public readonly ?string $pageKind = null,
    ) {
    }
}
