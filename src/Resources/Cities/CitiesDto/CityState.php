<?php

declare(strict_types=1);

namespace WebCommander\Resources\Cities\CitiesDto;

use WebCommander\Client\Dto;

/** The state a city row carries. `$id` is the one a country's `states` listing answers;
 *  `$default` follows the `administration` section's `default_state`. */
final class CityState extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?bool $active = null,
        public readonly ?bool $default = null,
    ) {
    }
}
