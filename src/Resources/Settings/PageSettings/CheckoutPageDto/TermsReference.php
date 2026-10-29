<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `terms_and_condition.ref` block, carrying the one key that matches the block's `type`.
 *  `$page` is `mixed`: the metadata types it a string but describes a record. */
final class TermsReference extends Dto
{
    public function __construct(
        public readonly mixed $page = null,
        public readonly ?string $link = null,
        public readonly ?string $text = null,
    ) {
    }
}
