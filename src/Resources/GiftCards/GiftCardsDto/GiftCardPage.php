<?php

declare(strict_types=1);

namespace WebCommander\Resources\GiftCards\GiftCardsDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** One page of the listing, newest first. */
final class GiftCardPage extends Dto
{
    /** @param list<GiftCard|null>|null $giftCards */
    public function __construct(
        #[ListOf(GiftCard::class)]
        public readonly ?array $giftCards = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }
}
