<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderPreviews\OrderPreviewsDto;

use WebCommander\Client\Dto;

/** The gift card on the preview: `$appliedAmount` is the lesser of its balance and the grand total. `$remainingBalance` came back null. */
final class PreviewGiftCard extends Dto
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $status = null,
        public readonly ?float $appliedAmount = null,
        public readonly ?float $remainingBalance = null,
    ) {
    }
}
