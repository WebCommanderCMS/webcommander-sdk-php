<?php

declare(strict_types=1);

namespace WebCommander\Resources\OrderCustomFields\OrderCustomFieldsDto;

use WebCommander\Client\Dto;

/** One order custom field. A listing row carries the twelve fields up to `$maxLength`; the row path
 *  adds the nine after it, and `$fieldMetadata` when that is asked for. */
final class OrderCustomField extends Dto
{
    public const ENVELOPE_KEY = 'order_custom_field';

    /** @param list<string|null>|null $options */
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $fieldType = null,
        public readonly ?string $label = null,
        public readonly ?string $name = null,
        public readonly ?bool $isActive = null,
        public readonly ?int $orderNo = null,
        public readonly ?string $createdOn = null,
        public readonly ?string $lastUpdatedOn = null,
        public readonly ?bool $isRequired = null,
        public readonly ?string $inputFormat = null,
        public readonly ?bool $hasMaxLength = null,
        public readonly ?int $maxLength = null,
        public readonly ?string $hoverText = null,
        public readonly ?string $placeholder = null,
        public readonly ?string $defaultValue = null,
        public readonly ?string $htmlClass = null,
        public readonly ?array $options = null,
        public readonly ?bool $isAllowedForShipping = null,
        public readonly ?bool $isAllowedForDelivery = null,
        public readonly ?bool $isAllowedForStorePickup = null,
        public readonly ?bool $isAllowedForPreOrder = null,
        public readonly mixed $fieldMetadata = null,
    ) {
    }
}
