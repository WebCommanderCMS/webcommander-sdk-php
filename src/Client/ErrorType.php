<?php

declare(strict_types=1);

namespace WebCommander\Client;

/** Classification of a failed call by HTTP status, plus the `isSuccess` flag. */
enum ErrorType: string
{
    case None = 'none';
    case Redirect = 'redirect';
    case Validation = 'validation';
    case Authentication = 'authentication';
    case Authorization = 'authorization';
    case NotFound = 'not_found';
    case MethodNotAllowed = 'method_not_allowed';
    case Conflict = 'conflict';
    case RateLimit = 'rate_limit';
    case Server = 'server';
    case Network = 'network';
    case Timeout = 'timeout';
    case Unknown = 'unknown';

    /** 3xx is its own arm: redirects are not followed.
     *  @param bool $bodyDeniesSuccess a 2xx that denies itself; ignored outside 2xx */
    public static function classify(int $statusCode, bool $bodyDeniesSuccess = false): self
    {
        return match (true) {
            $statusCode >= 200 && $statusCode < 300 => $bodyDeniesSuccess ? self::Unknown : self::None,
            $statusCode >= 300 && $statusCode < 400 => self::Redirect,
            $statusCode === 400, $statusCode === 422 => self::Validation,
            $statusCode === 401 => self::Authentication,
            $statusCode === 403 => self::Authorization,
            $statusCode === 404 => self::NotFound,
            $statusCode === 405 => self::MethodNotAllowed,
            $statusCode === 409 => self::Conflict,
            $statusCode === 429 => self::RateLimit,
            $statusCode >= 500 && $statusCode < 600 => self::Server,
            default => self::Unknown,
        };
    }
}
