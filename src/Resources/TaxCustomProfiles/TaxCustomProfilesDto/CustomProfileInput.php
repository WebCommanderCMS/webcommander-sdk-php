<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCustomProfiles\TaxCustomProfilesDto;

use WebCommander\Client\Dto;

/** The body both writes take, `$name` the create's one requirement and kept by an update that
 *  omits it. `$transactionNo` goes beside the wrapper, where the create files it. */
final class CustomProfileInput extends Dto
{
    public const ENVELOPE_KEY = 'custom_profile';
    public const TOP_LEVEL = ['transaction_no'];

    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $taxCode = null,
        public readonly ?bool $isDefault = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
