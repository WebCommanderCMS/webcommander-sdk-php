<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** The facade's body, or one section's, which fills that field and leaves the rest null.
 *  `$fieldMetadata` is `mixed`: the facade keys it by section, a section by field. */
final class SeoConfiguration extends Dto
{
    public const ENVELOPE_KEY = 'seo_configuration';

    public function __construct(
        public readonly ?GlobalStoreSettings $globalStoreSettings = null,
        public readonly ?CustomCode $customCode = null,
        public readonly ?DocumentRootPreview $documentRoot = null,
        public readonly ?UrlSettings $urlSettings = null,
        public readonly ?GroupMeta $groupMeta = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
