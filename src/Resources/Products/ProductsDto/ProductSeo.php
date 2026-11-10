<?php

declare(strict_types=1);

namespace WebCommander\Resources\Products\ProductsDto;

use WebCommander\Client\Dto;

/** A product's SEO sub-resource, under `seo`. */
final class ProductSeo extends Dto
{
    public const ENVELOPE_KEY = 'seo';

    public function __construct(
        public readonly ?string $urlHandle = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?ProductSeoAdvancedSettings $advancedSettings = null,
        public readonly ?ProductSeoAnalytics $analytics = null,
        public readonly ?ProductSeoCustomCode $customCode = null,
        public readonly ?ProductSeoSocial $social = null,
        public readonly ?ProductSeoAiVisibility $aiVisibility = null,
    ) {
    }
}
