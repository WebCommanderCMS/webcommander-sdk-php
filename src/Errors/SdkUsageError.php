<?php

declare(strict_types=1);

namespace WebCommander\Errors;

/** A caller mistake, never anything the server decided. Raised before any network I/O except
 *  where the mistake shows only in a response, such as a `recordKey` a page does not carry. */
class SdkUsageError extends SdkError
{
}
