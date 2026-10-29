<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** One document-root file; `$configKey` is the id the delete takes, not the file name. */
final class DocumentRootFile extends Dto
{
    public const ENVELOPE_KEY = 'document_root_file';

    public function __construct(
        public readonly ?string $configKey = null,
        public readonly ?string $fileName = null,
        public readonly ?string $filePath = null,
    ) {
    }
}
