<?php

declare(strict_types=1);

namespace WebCommander\Resources\Settings\PageSettings\ProductPageDto;

/** The `related_products` section, a flat `ProductListing`. */
final class RelatedProducts extends ProductListing
{
    public const ENVELOPE_KEY = 'related_products';
}
