# WebCommander PHP SDK

A PHP client for the WebCommander v4 REST API, with OAuth2 token handling, retries, typed
errors and typed response views.

## Requirements

- PHP 8.2 or newer
- Composer 2
- The `ctype`, `curl`, `filter`, `json` and `mbstring` extensions. `curl` is needed even if
  you inject your own PSR-18 client, because the default HTTP factory builds a Guzzle curl
  handler.

Runtime dependencies are `guzzlehttp/guzzle` and the PSR-18, PSR-17, PSR-7 and PSR-3
interfaces.

## Installation

Install the package from Packagist:

```bash
composer require webcommander/webcommander
```

The namespace is `WebCommander`.

## Quick start

The SDK never reads credentials from the environment. Read them yourself and pass them to an
`AuthConfig`:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use WebCommander\Client\WebCommanderClient;
use WebCommander\Config\AuthConfig;
use WebCommander\Config\SdkConfig;

$auth = new AuthConfig(
    baseUrl: getenv('WC_BASE_URL'),
    clientId: getenv('WC_CLIENT_ID'),
    clientSecret: getenv('WC_CLIENT_SECRET'),
    redirectUri: getenv('WC_REDIRECT_URI'),
    authString: getenv('WC_AUTH_STRING'),
    clientName: 'default',
    grantType: 'client_credentials',
);

$total = WebCommanderClient::withClient(new SdkConfig($auth), function (WebCommanderClient $client) {
    $response = $client->adminCustomers->getCustomers(['limit' => 5]);

    if (!$response->succeeded()) {
        throw new RuntimeException(implode('; ', $response->getErrorMessages()));
    }

    foreach ($response->map['customers'] as $customer) {
        echo $customer['customer_id'], ' ', $customer['email'], PHP_EOL;
    }

    return $response->map['pagination']['total'] ?? null;
});
```

`withClient()` closes the client when the callback returns or throws. If you build a client
with `new WebCommanderClient($config)`, call `$client->closeClient()` when you are done.

## Configuration

`AuthConfig` holds credentials and `SdkConfig` holds behaviour. Every `SdkConfig` setting has a
default, so pass only what you change. Both are immutable; `withOverrides()` returns a new,
validated copy.

```php
$config = new SdkConfig($auth, maxRetries: 3, raiseOnError: true, timeoutSeconds: 60.0);
$debug = $config->withOverrides(['printApiInfo' => true]);
```

To build clients by name anywhere in your code, register your instances once at bootstrap:

```php
use WebCommander\Client\ClientRegistry;

ClientRegistry::registerInstances([$auth, $stagingAuth]);

$client = ClientRegistry::buildClient();             // the first registered instance
$client = ClientRegistry::buildClient('staging');    // by clientName
$client = ClientRegistry::buildClient(overrides: ['maxRetries' => 3]);
```

Validation runs at construction and reports every problem at once.

## Usage

### Bound and explicit calls

Every endpoint is a public static method on a resource class. You can call it through the
client (bound) or on the class with the client as the first argument (explicit). Both run the
same function.

```php
use WebCommander\Resources\Customers\AdminCustomers;

$client->adminCustomers->getCustomer(1192);      // bound
AdminCustomers::getCustomer($client, 1192);      // explicit
```

Use the explicit form when you want editor completion: the bound form resolves methods through
`__call`, which editors cannot see.

For a path the SDK does not wrap, use the generic senders: `sendGetRequest`, `sendPostRequest`,
`sendPutRequest`, `sendPatchRequest`, `sendDeleteRequest` and `sendApiRequest`.

### Payload forms

A JSON body can be a PHP array, a raw JSON string or a DTO. All three send the same request.

```php
use WebCommander\Resources\Customers\AdminCustomersDto\CustomerInput;

$client->adminCustomers->createCustomer(['customer' => ['first_name' => 'Jane', 'email' => 'jane@example.com']]);
$client->adminCustomers->createCustomer('{"customer": {"first_name": "Jane", "email": "jane@example.com"}}');
$client->adminCustomers->createCustomer(new CustomerInput(firstName: 'Jane', email: 'jane@example.com'));
```

Body keys are snake_case, as the API spells them. A JSON string is sent byte for byte.

### Response forms

One response gives you the body in every form:

```php
$response = $client->adminCustomers->getCustomers(['limit' => 20]);

$response->statusCode;                     // 200
$response->map['customers'][0]['email'];   // the decoded body
$response->json;                           // the body text as the server sent it
$response->dto->items[0]->email;           // the typed view
$response->data;                           // the form chosen by responseFormat, "map" by default
```

### Pagination

`Pagination::iterRecords()` follows `pagination.next_page` and yields one record at a time:

```php
use WebCommander\Client\Pagination;

foreach (Pagination::iterRecords($client, '/api/{api_version}/admin/customers', 'customers', ['limit' => 20]) as $customer) {
    echo $customer['customer_id'], PHP_EOL;
}
```

## Error handling

By default a failed call does not throw. It returns an `ApiResponse` whose `succeeded()` is
`false`:

```php
$response = $client->adminCustomers->getCustomer(999999);

if (!$response->succeeded()) {
    echo $response->statusCode, ' ', $response->errorType->value, PHP_EOL;  // 404 not_found
    print_r($response->getErrorMessages());
}
```

Set `raiseOnError: true` on the config or on one call to throw `SdkError` instead:

```php
use WebCommander\Errors\SdkError;

try {
    $client->adminCustomers->getCustomer(999999, raiseOnError: true);
} catch (SdkError $error) {
    echo $error->statusCode, ' ', $error->errorType->value, PHP_EOL;
    echo $error->explain(), PHP_EOL;
}
```

Every exception the SDK throws is an `SdkError` or a subclass. A connection failure or timeout
always throws.

## Resources

The client exposes 46 resources with 349 operations. The [API reference](https://newlify.mintlify.app)
lists the method, path and behaviour of each one.

| Resource | Client accessor | Operations |
|---|---|---:|
| Customers | `$client->adminCustomers` | 15 |
| Aliases | `$client->aliases` | 4 |
| Animation effects settings | `$client->animationEffects` | 5 |
| Blog categories | `$client->blogCategories` | 5 |
| Blogs | `$client->blogs` | 12 |
| Carts | `$client->carts` | 7 |
| Categories | `$client->categories` | 10 |
| Category page settings | `$client->categoryPage` | 5 |
| Checkout page settings | `$client->checkoutPage` | 5 |
| Cities | `$client->cities` | 2 |
| Common settings | `$client->commonSettings` | 6 |
| Countries | `$client->countries` | 8 |
| Currencies | `$client->currencies` | 11 |
| Customer groups | `$client->customerGroups` | 9 |
| Customer portal settings | `$client->customerPortal` | 5 |
| Discount profiles | `$client->discountProfiles` | 7 |
| Ecommerce settings | `$client->ecommerceSettings` | 5 |
| Email | `$client->email` | 1 |
| Inventory locations | `$client->inventoryLocations` | 11 |
| Order custom fields | `$client->orderCustomFields` | 4 |
| Order flags | `$client->orderFlags` | 7 |
| Orders | `$client->orders` | 25 |
| Pages | `$client->pages` | 15 |
| Payment gateways | `$client->paymentGateways` | 8 |
| Price display settings | `$client->priceDisplaySettings` | 5 |
| Product listing settings | `$client->productListing` | 3 |
| Product page settings | `$client->productPage` | 5 |
| Products | `$client->products` | 10 |
| Search result page settings | `$client->searchResultPage` | 13 |
| Search settings | `$client->searchSettings` | 9 |
| SEO configuration | `$client->seoConfiguration` | 18 |
| Shipping classes | `$client->shippingClasses` | 9 |
| Shipping methods | `$client->shippingMethods` | 9 |
| Shipping settings | `$client->shippingSettings` | 3 |
| Shopping cart settings | `$client->shoppingCart` | 5 |
| Site settings | `$client->siteSettings` | 5 |
| Tax codes | `$client->taxCodes` | 7 |
| Tax country taxes | `$client->taxCountryTaxes` | 5 |
| Tax custom profiles | `$client->taxCustomProfiles` | 5 |
| Tax profiles | `$client->taxProfiles` | 7 |
| Tax rules | `$client->taxRules` | 7 |
| Tax settings | `$client->taxSettings` | 2 |
| Tax zones | `$client->taxZones` | 7 |
| Transactions | `$client->transactions` | 6 |
| Trash | `$client->trash` | 8 |
| Variations | `$client->variations` | 12 |

`$client->listResourceNames()` returns the accessor names at runtime.

## Documentation

- API reference: <https://newlify.mintlify.app>

## License

MIT. See [LICENSE](LICENSE).
