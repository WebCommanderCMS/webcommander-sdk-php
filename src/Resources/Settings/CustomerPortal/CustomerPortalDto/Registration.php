<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\CustomerPortal\CustomerPortalDto;

use WebCommander\Client\Dto;
use WebCommander\Client\ListOf;

/** The `registration` section: whether customers may register, what they become and what they accept. */
final class Registration extends Dto
{
    public const ENVELOPE_KEY = 'registration';

    /** @param list<CustomerGroup|null>|null $defaultGroups
     *  @param list<CustomerGroup|null>|null $approvalGroups */
    public function __construct(
        public readonly ?bool $enabled = null,
        public readonly ?string $closeRegistrationMessage = null,
        public readonly ?bool $assignDefaultGroup = null,
        #[ListOf(CustomerGroup::class)]
        public readonly ?array $defaultGroups = null,
        public readonly ?bool $requiresApproval = null,
        #[ListOf(CustomerGroup::class)]
        public readonly ?array $approvalGroups = null,
        public readonly ?RegistrationTerms $terms = null,
        public readonly ?FacebookLogin $facebook = null,
        public readonly ?GoogleLogin $google = null,
        public readonly ?B2bConfiguration $b2bConfiguration = null,
        public readonly ?AlternateLogin $alternateLogin = null,
    ) {
    }
}
