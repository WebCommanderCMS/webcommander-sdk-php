<?php

declare(strict_types=1);

namespace WebCommander\Errors;

/** Authentication failed: the token endpoint rejected the credentials (raised whatever
 *  raiseOnError says), or a 401/403 survived one automatic refresh (only when it is on). */
final class SdkAuthError extends SdkError
{
}
