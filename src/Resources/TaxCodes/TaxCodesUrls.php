<?php

declare(strict_types=1);

namespace WebCommander\Resources\TaxCodes;

final class TaxCodesUrls
{
    public const TAX_CODES = '/api/{api_version}/admin/tax_codes';
    public const TAX_CODE = '/api/{api_version}/admin/tax_codes/{tax_code_id}';
}
