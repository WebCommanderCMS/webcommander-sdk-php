<?php

declare(strict_types=1);

namespace WebCommander\Resources\CommonSettings\CommonSettingsDto;

use WebCommander\Client\Dto;

/** One entry of a settings group, for a write's lists; a read's entries have the same keys. Reads
 *  answer `value` as text, `***` for a masked one; a number written is stored as text. */
final class Setting extends Dto
{
    public function __construct(
        public readonly ?string $configKey = null,
        public readonly ?string $value = null,
    ) {
    }
}
