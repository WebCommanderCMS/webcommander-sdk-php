<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** The comment body, with no envelope; `content` is required. */
final class OrderCommentInput extends Dto
{
    public function __construct(
        public readonly ?string $content = null,
        public readonly ?bool $saveAndSend = null,
        public readonly ?string $transactionNo = null,
    ) {
    }
}
