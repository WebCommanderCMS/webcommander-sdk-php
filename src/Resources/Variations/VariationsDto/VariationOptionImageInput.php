<?php

declare(strict_types=1);

namespace WebCommander\Resources\Variations\VariationsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\WireName;

/** An image option's upload; written as `filename`, read back as `file_name`. */
final class VariationOptionImageInput extends Dto
{
    public function __construct(
        #[WireName('base64')]
        public readonly ?string $base64 = null,
        public readonly ?string $filename = null,
    ) {
    }
}
