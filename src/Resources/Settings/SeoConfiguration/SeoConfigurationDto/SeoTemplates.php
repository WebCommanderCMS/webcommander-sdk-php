<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\SeoConfiguration\SeoConfigurationDto;

use WebCommander\Client\Dto;

/** One content type's templates in `global_store_settings`; the allowed tokens differ per block,
 *  so read `field_metadata` rather than reusing another block's. */
final class SeoTemplates extends Dto
{
    /** @param list<string|null>|null $titleTemplate
     *  @param list<string|null>|null $descriptionTemplate */
    public function __construct(
        public readonly ?bool $disableIndexing = null,
        public readonly ?array $titleTemplate = null,
        public readonly ?array $descriptionTemplate = null,
    ) {
    }
}
