<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `document_root` rows the facade inlines, without `pagination`. */
final class DocumentRootPreview extends Dto
{
    /** @param list<DocumentRootFile|null>|null $items */
    public function __construct(
        #[ListOf(DocumentRootFile::class)]
        public readonly ?array $items = null,
    ) {
    }
}
