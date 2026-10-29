<?php

declare(strict_types=1);

namespace WebCommander\Client;

use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;
use ReflectionUnionType;

abstract class Dto
{
    /** The key the API wraps this record in; `fromMap()` unwraps it when present. */
    public const ENVELOPE_KEY = null;

    /** Wire names that sit beside the envelope rather than inside it. */
    public const TOP_LEVEL = [];

    /** @var array<class-string,array<string,ReflectionParameter>> resolved once per subclass */
    private static array $declared = [];

    /** @return array<string,string> wire name => property name, in declaration order */
    public static function fields(): array
    {
        return array_map(
            static fn (ReflectionParameter $parameter): string => $parameter->getName(),
            self::declaration(static::class)
        );
    }

    /** @param array<string,mixed> $map the decoded body, or one record out of it */
    public static function fromMap(array $map): static
    {
        $source = $map;
        $envelope = static::ENVELOPE_KEY;
        if ($envelope !== null && is_array($map[$envelope] ?? null)) {
            $beside = $map;
            unset($beside[$envelope]);
            // Beside wins on a collision: the repeated key is the nested record's own.
            $source = $beside + $map[$envelope];
        }

        $values = [];
        foreach (self::declaration(static::class) as $wireName => $parameter) {
            if (!array_key_exists($wireName, $source)) {
                continue;
            }
            $values[$parameter->getName()] = self::readValue(
                $source[$wireName],
                $parameter->getType(),
                self::elementType($parameter)
            );
        }
        return new static(...$values);
    }

    /** @return array<string,mixed> the body this DTO stands for, envelope included */
    public function toMap(): array
    {
        $record = [];
        $beside = [];
        foreach (self::declaration(static::class) as $wireName => $parameter) {
            $value = $this->{$parameter->getName()};
            if ($value === null) {
                continue;
            }
            if (in_array($wireName, static::TOP_LEVEL, true)) {
                $beside[$wireName] = self::writeValue($value);
                continue;
            }
            $record[$wireName] = self::writeValue($value);
        }

        $envelope = static::ENVELOPE_KEY;
        return ($envelope !== null ? [$envelope => $record] : $record) + $beside;
    }

    /** @param string|null $elementType the element type of a list field, from `#[ListOf]` */
    private static function readValue(mixed $value, ?ReflectionType $type, ?string $elementType): mixed
    {
        if ($value === null) {
            return null;
        }
        $names = self::typeNames($type);

        if ($names === [] || in_array('mixed', $names, true)) {
            return $value;
        }

        if (in_array('array', $names, true)) {
            // A JSON object decodes to a PHP array too, and it is not a list.
            if (!is_array($value) || !array_is_list($value)) {
                return null;
            }
            if ($elementType === null) {
                return $value;
            }
            return array_map(
                static fn (mixed $item): mixed => self::readNested($item, $elementType),
                $value
            );
        }

        foreach ($names as $name) {
            if (is_a($name, self::class, true)) {
                return self::readNested($value, $name);
            }
        }

        foreach ($names as $name) {
            $read = match ($name) {
                'int' => is_int($value) ? $value : null,
                // JSON has one number type and PHP decodes 0 as an int: the only widening.
                'float' => is_int($value) || is_float($value) ? (float) $value : null,
                'string' => is_string($value) ? $value : null,
                'bool' => is_bool($value) ? $value : null,
                default => null,
            };
            if ($read !== null) {
                return $read;
            }
        }
        return null;
    }

    private static function readNested(mixed $value, string $type): mixed
    {
        if (!is_array($value)) {
            return null;
        }
        return $type::fromMap($value);
    }

    private static function writeValue(mixed $value): mixed
    {
        if ($value instanceof self) {
            $record = $value->toMap();
            $envelope = $value::ENVELOPE_KEY;
            // Inside a parent record, a nested envelope would be an extra layer.
            if ($envelope !== null && is_array($record[$envelope] ?? null)) {
                return $record[$envelope];
            }
            return $record;
        }
        if (is_array($value)) {
            return array_map(static fn (mixed $item): mixed => self::writeValue($item), $value);
        }
        return $value;
    }

    /** @return list<string> the types the annotation admits, minus `null` */
    private static function typeNames(?ReflectionType $type): array
    {
        if ($type instanceof ReflectionNamedType) {
            return $type->getName() === 'null' ? [] : [$type->getName()];
        }
        if ($type instanceof ReflectionUnionType) {
            $names = [];
            foreach ($type->getTypes() as $member) {
                if ($member instanceof ReflectionNamedType && $member->getName() !== 'null') {
                    $names[] = $member->getName();
                }
            }
            return $names;
        }
        return [];
    }

    /** @return class-string<self>|null */
    private static function elementType(ReflectionParameter $parameter): ?string
    {
        $attributes = $parameter->getAttributes(ListOf::class);
        return $attributes === [] ? null : $attributes[0]->newInstance()->type;
    }

    /** @param class-string<self> $class
     *  @return array<string,ReflectionParameter> */
    private static function declaration(string $class): array
    {
        if (isset(self::$declared[$class])) {
            return self::$declared[$class];
        }
        $fields = [];
        $constructor = (new ReflectionClass($class))->getConstructor();
        foreach ($constructor?->getParameters() ?? [] as $parameter) {
            if ($parameter->isPromoted()) {
                $fields[self::declaredWireName($parameter)] = $parameter;
            }
        }
        return self::$declared[$class] = $fields;
    }

    /** The wire name: the casing rule, or the parameter's `#[WireName]` where the rule cannot place a
     *  digit run - `office365` ends a word with one, `private_key_v3` a segment. */
    private static function declaredWireName(ReflectionParameter $parameter): string
    {
        $attributes = $parameter->getAttributes(WireName::class);
        return $attributes === []
            ? self::wireName($parameter->getName())
            : $attributes[0]->newInstance()->name;
    }

    /** `addressLine1` is `address_line_1`: a digit run starts its own segment unless a lowercase
     *  letter follows it inside a word - `azureAdB2c` is `azure_ad_b2c`, not `azure_ad_b_2c`. */
    private static function wireName(string $property): string
    {
        return strtolower((string) preg_replace('/(?<!^)([A-Z]|\d+(?![a-z]))/', '_$1', $property));
    }
}
