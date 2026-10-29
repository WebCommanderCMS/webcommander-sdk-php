<?php

declare(strict_types=1);

namespace WebCommander\Client;

use Attribute;

/** Wire name the casing rule cannot derive. */
#[Attribute(Attribute::TARGET_PARAMETER)]
final class WireName
{
    public function __construct(public readonly string $name)
    {
    }
}
