<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** The product's social card, and one per network. */
final class ProductSeoSocial extends Dto
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?string $imageUrl = null,
        public readonly ?ProductSeoSocialCard $facebook = null,
        public readonly ?ProductSeoSocialCard $twitter = null,
        public readonly ?ProductSeoSocialCard $linkedin = null,
    ) {
    }
}
