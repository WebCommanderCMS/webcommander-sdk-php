<?php

declare(strict_types=1);

namespace WebCommander\Resources\Orders\OrdersDto;

use WebCommander\Client\Dto;

/** One comment; `$created` is `M/D/YYYY` and a time two spaces apart, not ISO 8601. */
final class OrderComment extends Dto
{
    public const ENVELOPE_KEY = 'comment';

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $content = null,
        public readonly ?string $adminName = null,
        public readonly ?bool $visibleToCustomer = null,
        public readonly ?bool $admin = null,
        public readonly ?string $created = null,
    ) {
    }
}
