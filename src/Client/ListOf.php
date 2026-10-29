<?php

declare(strict_types=1);

namespace WebCommander\Client;

use Attribute;

/** The element type of a list field; an element that is not a record reads null in place, not dropped. */
#[Attribute(Attribute::TARGET_PARAMETER)]
final class ListOf
{
    /** @param class-string<Dto> $type */
    public function __construct(public readonly string $type)
    {
    }
}
