<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Errors\SdkUsageError;
use WebCommander\Resources\Customers\AdminCustomersDto\Customer;
use WebCommander\Resources\Customers\AdminCustomersDto\Page;
use WebCommander\Resources\Customers\AdminCustomersDto\StoreCreditAdjustment;

/** Admin customer endpoints, under `/api/{api_version}/admin`. */
final class AdminCustomers
{
    /** List customers - `GET /admin/customers`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCustomers(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCustomersUrls::ADMIN_CUSTOMERS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::of(Customer::class));
    }

    /** Retrieve one customer - `GET /admin/customers/{customer_id}`; the slot takes `customer_id`,
     *  not the overlapping `internal_id`. */
    public static function getCustomer(WebCommanderClient $client, int|string $customerId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCustomersUrls::ADMIN_CUSTOMER, pathParams: ['customer_id' => $customerId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Customer::class);
    }

    /** Count customers - `GET /admin/customers/count`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCustomerCount(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCustomersUrls::ADMIN_CUSTOMERS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Check an email - `GET /admin/customers/check-email`. */
    public static function getCustomerEmailExists(WebCommanderClient $client, string $email, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        self::requireEmail($email);
        return $client->sendGetRequest(AdminCustomersUrls::ADMIN_CUSTOMERS_CHECK_EMAIL, queryParams: ['email' => $email], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Export customers as XLSX - `GET /admin/customers/export`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCustomerExport(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCustomersUrls::ADMIN_CUSTOMERS_EXPORT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Create a customer - `POST /admin/customers`. `$transactionNo` is sent as `X-Transaction-No` and
     *  files the customer under that number.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createCustomer(WebCommanderClient $client, array|string|Dto $payload, ?string $transactionNo = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCustomersUrls::ADMIN_CUSTOMERS, jsonBody: $payload, headers: $transactionNo === null ? null : [AdminCustomersUrls::TRANSACTION_NO_HEADER => $transactionNo], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Customer::class);
    }

    /** Update a customer - `PUT /admin/customers/{customer_id}`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateCustomer(WebCommanderClient $client, int|string $customerId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(AdminCustomersUrls::ADMIN_CUSTOMER, pathParams: ['customer_id' => $customerId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Customer::class);
    }

    /** Trash a customer - `DELETE /admin/customers/{customer_id}`. */
    public static function deleteCustomer(WebCommanderClient $client, int|string $customerId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(AdminCustomersUrls::ADMIN_CUSTOMER, pathParams: ['customer_id' => $customerId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Add an address - `POST /admin/customers/{customer_id}/addresses`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createCustomerAddresses(WebCommanderClient $client, int|string $customerId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCustomersUrls::ADMIN_CUSTOMER_ADDRESSES, pathParams: ['customer_id' => $customerId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Customer::class);
    }

    /** Reset a password - `POST /admin/customers/{customer_id}/reset-password`; `->map['status']`
     *  is the verdict.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function resetCustomerPassword(WebCommanderClient $client, int|string $customerId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCustomersUrls::ADMIN_CUSTOMER_RESET_PASSWORD, pathParams: ['customer_id' => $customerId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Change a password - `POST /admin/customers/{customer_id}/change-password`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function changeCustomerPassword(WebCommanderClient $client, int|string $customerId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCustomersUrls::ADMIN_CUSTOMER_CHANGE_PASSWORD, pathParams: ['customer_id' => $customerId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Queue password resets - `POST /admin/customers/bulk-reset-password`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function bulkResetCustomerPasswords(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCustomersUrls::ADMIN_CUSTOMERS_BULK_RESET_PASSWORD, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Import customers - `POST /admin/customers/import`.
     *  @param mixed $files one part named "file" as [filename, contents, contentType] */
    public static function importCustomers(WebCommanderClient $client, mixed $files, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        self::requireFiles($files);
        return $client->sendPostRequest(AdminCustomersUrls::ADMIN_CUSTOMERS_IMPORT, files: $files, raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** List store credit adjustments - `GET /admin/customers/{customer_id}/store-credit/adjustments`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getCustomerStoreCreditAdjustments(WebCommanderClient $client, int|string $customerId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(AdminCustomersUrls::ADMIN_CUSTOMER_STORE_CREDIT_ADJUSTMENTS, pathParams: ['customer_id' => $customerId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Page::of(StoreCreditAdjustment::class));
    }

    /** Add a store credit adjustment - `POST /admin/customers/{customer_id}/store-credit/adjustments`;
     *  the body has no envelope.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createCustomerStoreCreditAdjustment(WebCommanderClient $client, int|string $customerId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(AdminCustomersUrls::ADMIN_CUSTOMER_STORE_CREDIT_ADJUSTMENTS, pathParams: ['customer_id' => $customerId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: StoreCreditAdjustment::class);
    }

    private static function requireEmail(string $email): void
    {
        if (trim($email) === '') {
            throw new SdkUsageError(
                'email is required and identifies the lookup, so a blank one is refused here rather '
                . 'than sent as a different question'
            );
        }
    }

    private static function requireFiles(mixed $files): void
    {
        if (!is_array($files) || $files === []) {
            throw new SdkUsageError("files: pass ['file' => [filename, contents, contentType]]");
        }
    }
}
