<?php

declare(strict_types=1);

namespace WebCommander\Client;

use WebCommander\Errors\SdkAttributeError;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Resources\Aliases\Aliases;
use WebCommander\Resources\BlogCategories\BlogCategories;
use WebCommander\Resources\Blogs\Blogs;
use WebCommander\Resources\Carts\Carts;
use WebCommander\Resources\Categories\Categories;
use WebCommander\Resources\Cities\Cities;
use WebCommander\Resources\CommonSettings\CommonSettings;
use WebCommander\Resources\Countries\Countries;
use WebCommander\Resources\Currencies\Currencies;
use WebCommander\Resources\CustomerGroups\CustomerGroups;
use WebCommander\Resources\Customers\AdminCustomers;
use WebCommander\Resources\DiscountProfiles\DiscountProfiles;
use WebCommander\Resources\Email\Email;
use WebCommander\Resources\InventoryLocations\InventoryLocations;
use WebCommander\Resources\OrderCustomFields\OrderCustomFields;
use WebCommander\Resources\OrderFlags\OrderFlags;
use WebCommander\Resources\Orders\Orders;
use WebCommander\Resources\Pages\Pages;
use WebCommander\Resources\PaymentGateways\PaymentGateways;
use WebCommander\Resources\Products\Products;
use WebCommander\Resources\Settings\AnimationEffects\AnimationEffects;
use WebCommander\Resources\Settings\CustomerPortal\CustomerPortal;
use WebCommander\Resources\Settings\EcommerceSettings\EcommerceSettings;
use WebCommander\Resources\Settings\PageSettings\CategoryPage;
use WebCommander\Resources\Settings\PageSettings\CheckoutPage;
use WebCommander\Resources\Settings\PageSettings\ProductPage;
use WebCommander\Resources\Settings\PageSettings\SearchResultPage;
use WebCommander\Resources\Settings\PageSettings\ShoppingCart;
use WebCommander\Resources\Settings\PriceDisplaySettings\PriceDisplaySettings;
use WebCommander\Resources\Settings\ProductListing\ProductListing;
use WebCommander\Resources\Settings\SearchSettings\SearchSettings;
use WebCommander\Resources\Settings\SeoConfiguration\SeoConfiguration;
use WebCommander\Resources\Settings\ShippingSettings\ShippingSettings;
use WebCommander\Resources\Settings\SiteSettings\SiteSettings;
use WebCommander\Resources\ShippingClasses\ShippingClasses;
use WebCommander\Resources\ShippingMethods\ShippingMethods;
use WebCommander\Resources\TaxCodes\TaxCodes;
use WebCommander\Resources\TaxCountryTaxes\TaxCountryTaxes;
use WebCommander\Resources\TaxCustomProfiles\TaxCustomProfiles;
use WebCommander\Resources\TaxProfiles\TaxProfiles;
use WebCommander\Resources\TaxRules\TaxRules;
use WebCommander\Resources\TaxSettings\TaxSettings;
use WebCommander\Resources\TaxZones\TaxZones;
use WebCommander\Resources\Transactions\Transactions;
use WebCommander\Resources\Trash\Trash;
use WebCommander\Resources\Variations\Variations;

/** Registry of resource name to class - an explicit map, not a directory scan, so a typo raises. */
final class ResourceRegistry
{
    /** @var array<string,class-string> */
    private static array $modules = [
        'adminCustomers' => AdminCustomers::class,
        'aliases' => Aliases::class,
        'animationEffects' => AnimationEffects::class,
        'blogCategories' => BlogCategories::class,
        'blogs' => Blogs::class,
        'carts' => Carts::class,
        'categories' => Categories::class,
        'categoryPage' => CategoryPage::class,
        'checkoutPage' => CheckoutPage::class,
        'cities' => Cities::class,
        'commonSettings' => CommonSettings::class,
        'countries' => Countries::class,
        'currencies' => Currencies::class,
        'customerGroups' => CustomerGroups::class,
        'customerPortal' => CustomerPortal::class,
        'discountProfiles' => DiscountProfiles::class,
        'ecommerceSettings' => EcommerceSettings::class,
        'email' => Email::class,
        'inventoryLocations' => InventoryLocations::class,
        'orderCustomFields' => OrderCustomFields::class,
        'orderFlags' => OrderFlags::class,
        'orders' => Orders::class,
        'pages' => Pages::class,
        'paymentGateways' => PaymentGateways::class,
        'priceDisplaySettings' => PriceDisplaySettings::class,
        'productListing' => ProductListing::class,
        'productPage' => ProductPage::class,
        'products' => Products::class,
        'searchResultPage' => SearchResultPage::class,
        'searchSettings' => SearchSettings::class,
        'seoConfiguration' => SeoConfiguration::class,
        'shippingClasses' => ShippingClasses::class,
        'shippingMethods' => ShippingMethods::class,
        'shippingSettings' => ShippingSettings::class,
        'shoppingCart' => ShoppingCart::class,
        'siteSettings' => SiteSettings::class,
        'taxCodes' => TaxCodes::class,
        'taxCountryTaxes' => TaxCountryTaxes::class,
        'taxCustomProfiles' => TaxCustomProfiles::class,
        'taxProfiles' => TaxProfiles::class,
        'taxRules' => TaxRules::class,
        'taxSettings' => TaxSettings::class,
        'taxZones' => TaxZones::class,
        'transactions' => Transactions::class,
        'trash' => Trash::class,
        'variations' => Variations::class,
    ];

    /** @param class-string $fqcn */
    public static function registerResourceModule(string $resourceName, string $fqcn): void
    {
        if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $resourceName)) {
            throw new SdkUsageError(
                "cannot register resource '{$resourceName}': a resource name must be an identifier "
                . 'that does not start with an underscore - no lookup could ever reach it'
            );
        }
        if (method_exists(WebCommanderClient::class, $resourceName)
            || property_exists(WebCommanderClient::class, $resourceName)) {
            throw new SdkUsageError(
                "cannot register resource '{$resourceName}': WebCommanderClient already has an "
                . 'attribute of that name, and it would win every lookup - pick another name'
            );
        }
        $registered = self::$modules[$resourceName] ?? null;
        if ($registered !== null && $registered !== $fqcn) {
            throw new SdkUsageError(
                "cannot register resource '{$resourceName}' against {$fqcn}: it is already registered "
                . "against {$registered}, and clients built before the change would keep the old one"
            );
        }
        if (!class_exists($fqcn)) {
            throw new SdkUsageError(
                "cannot register resource '{$resourceName}': nothing loadable at {$fqcn} - check the class name"
            );
        }
        self::$modules[$resourceName] = $fqcn;
    }

    /** @return list<string> */
    public static function registeredResourceNames(): array
    {
        $names = array_keys(self::$modules);
        sort($names);
        return $names;
    }

    /** @return class-string */
    public static function resolveResourceModule(string $resourceName): string
    {
        $fqcn = self::$modules[$resourceName] ?? null;
        if ($fqcn === null) {
            $available = implode(', ', self::registeredResourceNames());
            throw new SdkAttributeError("no resource '{$resourceName}'; available: {$available}");
        }
        return $fqcn;
    }
}
