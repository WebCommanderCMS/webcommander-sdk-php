<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\CheckoutPageDto;

use WebCommander\Client\Dto;

/** The `allow_sign_up` block: may an account be created at checkout, and is one demanded. */
final class SignUp extends Dto
{
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?bool $required = null,
    ) {
    }
}
