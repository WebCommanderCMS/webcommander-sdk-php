<?php

declare(strict_types=1);

namespace WebCommander\Resources\Categories;

final class CategoriesUrls
{
    public const CATEGORIES = '/api/{api_version}/admin/categories';
    public const CATEGORIES_COUNT = '/api/{api_version}/admin/categories/count';
    public const CATEGORIES_CHECK_NAME = '/api/{api_version}/admin/categories/check-name';
    public const CATEGORY = '/api/{api_version}/admin/categories/{category_id}';
    public const CATEGORY_SECTION = '/api/{api_version}/admin/categories/{category_id}/{section}';

    /** The six values `{section}` takes, each also a key of the row and of `group_meta`.
     *  @var list<string> */
    public const CATEGORY_SECTIONS = [
        'general',
        'description',
        'images_media',
        'availability_visibility',
        'tax_shipping',
        'assign_products',
    ];

    /** Files a new category under this transaction number; it beats `category.transaction_no`. */
    public const TRANSACTION_NO_HEADER = 'X-Transaction-No';
}
