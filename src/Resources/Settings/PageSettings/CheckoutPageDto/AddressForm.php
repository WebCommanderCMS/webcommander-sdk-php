<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** An address section's record: the facade sends `active_fields`, the section endpoint `fields`.
 *  Not `final`: both address sections inherit it. */
class AddressForm extends Dto
{
    /** @param list<string>|null $activeFields
     *  @param list<AddressField|null>|null $fields */
    public function __construct(
        public readonly ?array $activeFields = null,
        #[ListOf(AddressField::class)]
        public readonly ?array $fields = null,
    ) {
    }
}
