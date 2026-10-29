<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `terms_and_condition` block: whether terms must be accepted, the link wording and where the
 *  terms live; each `TermsReference` field applies only under its own `type`. */
final class TermsAndCondition extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $text = null,
        public readonly ?string $linkLabel = null,
        public readonly ?string $type = null,
        public readonly ?TermsReference $ref = null,
    ) {
    }
}
