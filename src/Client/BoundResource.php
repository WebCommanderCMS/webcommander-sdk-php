<?php

declare(strict_types=1);

namespace WebCommander\Client;

use WebCommander\Errors\SdkAttributeError;

/** A resource class with a client pre-applied to every endpoint:
 *  `$client-><resource>-><fn>(args)` resolves to `ResourceClass::<fn>($client, args)`. */
final class BoundResource
{
    /** @param class-string $resourceClass */
    public function __construct(
        private readonly object $client,
        private readonly string $resourceClass,
    ) {
    }

    /** @param list<mixed> $arguments */
    public function __call(string $name, array $arguments): mixed
    {
        $available = $this->resourceMethodNames();
        if (!in_array($name, $available, true)) {
            $suggestion = $this->closest($name, $available);
            $short = substr(strrchr($this->resourceClass, '\\') ?: $this->resourceClass, 1) ?: $this->resourceClass;
            $hint = $suggestion !== null ? "; did you mean {$suggestion}?" : '';
            throw new SdkAttributeError("{$short} has no endpoint '{$name}'{$hint}");
        }
        /** @var callable $target */
        $target = [$this->resourceClass, $name];
        return $target($this->client, ...$arguments);
    }

    /** @return list<string> */
    public function resourceMethodNames(): array
    {
        $reflection = new \ReflectionClass($this->resourceClass);
        $names = [];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_STATIC) as $method) {
            if ($method->isPublic() && !str_starts_with($method->getName(), '_')) {
                $names[] = $method->getName();
            }
        }
        return $names;
    }

    /** @param list<string> $candidates */
    private function closest(string $name, array $candidates): ?string
    {
        $best = null;
        $bestDistance = PHP_INT_MAX;
        foreach ($candidates as $candidate) {
            $distance = levenshtein(strtolower($name), strtolower($candidate));
            if ($distance < $bestDistance) {
                $bestDistance = $distance;
                $best = $candidate;
            }
        }
        return $bestDistance <= max(2, (int) (strlen($name) / 3)) ? $best : null;
    }
}
