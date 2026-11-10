<?php

declare(strict_types=1);

namespace WebCommander\Resources\GiftCards\GiftCardsDto;

use WebCommander\Client\Dto;

/** One gift card. `$code` is what an order preview's `gift-card` call takes; a card can be applied only while `$isActive` and `$isPaid`, with a `$balance` above zero, before its `$availableTo` date and with `$email` equal to the previewed customer's email. */
final class GiftCard extends Dto
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?float $balance = null,
        public readonly ?float $initialAmount = null,
        public readonly ?string $email = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $message = null,
        public readonly ?bool $isActive = null,
        public readonly ?bool $isPaid = null,
        public readonly ?string $availableTo = null,
        public readonly ?string $externalReference = null,
        public readonly ?string $productName = null,
        public readonly ?string $createdOn = null,
    ) {
    }
}
