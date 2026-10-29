<?php

declare(strict_types=1);

namespace WebCommander\Resources\Customers\AdminCustomersDto;

use Closure;
use WebCommander\Client\Dto;

final class Page extends Dto
{
    private const PAGINATION_KEY = 'pagination';

    /** @param list<mixed>|null $items */
    public function __construct(
        public readonly ?array $items = null,
        public readonly ?Pagination $pagination = null,
    ) {
    }

    /** @param class-string<Dto> $itemType
     *  @return Closure(array<string,mixed>): self a reader for a page of `$itemType` records */
    public static function of(string $itemType): Closure
    {
        return static fn (array $map): self => self::read($map, $itemType);
    }

    /** Reads a page whose records stay arrays; the inherited version would look for a key `items`.
     *  @param array<string,mixed> $map */
    public static function fromMap(array $map): static
    {
        return self::read($map, null);
    }

    /** @param array<string,mixed> $map
     *  @param class-string<Dto>|null $itemType null leaves the records as arrays */
    private static function read(array $map, ?string $itemType): self
    {
        $items = self::findRecords($map);
        if ($items !== null && $itemType !== null) {
            $items = array_map(
                static fn (mixed $record): ?Dto => is_array($record) ? $itemType::fromMap($record) : null,
                $items
            );
        }

        $block = $map[self::PAGINATION_KEY] ?? null;
        return new self(
            items: $items,
            pagination: is_array($block) ? Pagination::fromMap($block) : null,
        );
    }

    /** The paging key is skipped because `json_decode` renders `{}` and `[]` alike.
     *  @param array<string,mixed> $map
     *  @return list<mixed>|null */
    private static function findRecords(array $map): ?array
    {
        $lists = [];
        foreach ($map as $key => $value) {
            if ($key !== self::PAGINATION_KEY && is_array($value) && array_is_list($value)) {
                $lists[] = $value;
            }
        }
        return count($lists) === 1 ? $lists[0] : null;
    }
}
