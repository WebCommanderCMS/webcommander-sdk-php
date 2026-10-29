<?php

declare(strict_types=1);

namespace WebCommander\Client;

use WebCommander\Config\SdkConfig;
use WebCommander\Errors\SdkError;
use WebCommander\Errors\SdkUsageError;

/** A collection of clients, one per instance, built on first use; each gets its own config, token
 *  provider and store. */
final class ClientRegistry
{
    private const DEFAULT_CLIENT_NAME = 'default';

    /** @var list<mixed> */
    private array $credentials;
    /** @var array<string,int> */
    private array $names;
    /** @var list<string> */
    private array $labels;
    /** @var array<int,WebCommanderClient> */
    private array $clients = [];
    /** @var list<mixed> */
    private static array $registeredInstances = [];

    /** @param array<int|string,mixed> $credentials */
    public function __construct(array $credentials)
    {
        $blocks = self::readInstanceBlocks($credentials, 'ClientRegistry');
        $this->credentials = $blocks;
        $this->names = self::indexDeclaredNames($blocks);
        $this->labels = [];
        foreach ($blocks as $index => $block) {
            $this->labels[] = SdkConfig::readClientName($block) ?? "<index {$index}>";
        }
    }

    public function resolveIndex(int|string|null $name = null): int
    {
        if ($name === null) {
            return 0;
        }
        if (is_int($name)) {
            $count = count($this->credentials);
            if ($name >= -$count && $name < $count) {
                return ($name % $count + $count) % $count;
            }
            throw new SdkUsageError("no instance at index {$name}; {$count} registered (0-" . ($count - 1) . ')');
        }
        if (array_key_exists($name, $this->names)) {
            return $this->names[$name];
        }
        throw new SdkUsageError("unknown instance '{$name}'; registered: " . implode(', ', $this->labels));
    }

    public function getClient(int|string|null $name = null): WebCommanderClient
    {
        $index = $this->resolveIndex($name);
        if (!isset($this->clients[$index])) {
            $config = SdkConfig::fromCredentials($this->credentials, $index);
            $this->clients[$index] = new WebCommanderClient($config);
        }
        return $this->clients[$index];
    }

    public function closeAllClients(): void
    {
        $built = array_keys($this->clients);
        sort($built);

        $failures = [];
        $first = null;
        try {
            foreach ($built as $index) {
                try {
                    $this->clients[$index]->closeClient();
                } catch (\Throwable $failure) {
                    $failures[] = $this->labels[$index] . ': ' . $failure->getMessage();
                    $first ??= $failure;
                }
            }
        } finally {
            foreach ($built as $index) {
                unset($this->clients[$index]);
            }
        }

        if ($first !== null) {
            throw new SdkError(
                count($failures) . ' of ' . count($built) . ' clients failed to close ('
                . implode('; ', $failures) . '); all were attempted and dropped',
                previous: $first
            );
        }
    }

    /** @param array<int|string,mixed> $credentials */
    public static function registerInstances(array $credentials): void
    {
        $blocks = self::readInstanceBlocks($credentials, 'registerInstances');
        self::indexDeclaredNames($blocks);
        self::$registeredInstances = $blocks;
    }

    /** @return list<mixed> */
    public static function getRegisteredInstances(): array
    {
        if (self::$registeredInstances === []) {
            throw new SdkUsageError(
                'no instances registered - call ClientRegistry::registerInstances([...]) first, '
                . 'or pass credentials to buildClient()'
            );
        }
        return self::$registeredInstances;
    }

    /** @param array<int|string,mixed>|null $credentials
     *  @param array<string,mixed> $overrides */
    public static function buildClient(int|string|null $instance = null, ?array $credentials = null, array $overrides = []): WebCommanderClient
    {
        $blocks = $credentials ?? self::getRegisteredInstances();
        return new WebCommanderClient(SdkConfig::fromCredentials($blocks, $instance, $overrides));
    }

    /** @param callable(WebCommanderClient): mixed $callback
     *  @param array<string,mixed> $overrides */
    public static function withClient(callable $callback, int|string|null $instance = null, array $overrides = []): mixed
    {
        return WebCommanderClient::withClient(
            SdkConfig::fromCredentials(self::getRegisteredInstances(), $instance, $overrides),
            $callback,
        );
    }

    /** @param array<int|string,mixed> $credentials
     *  @return list<mixed> */
    private static function readInstanceBlocks(array $credentials, string $entryPoint): array
    {
        if (!array_is_list($credentials)) {
            throw new SdkUsageError(
                "{$entryPoint} takes a list of instances, not a single block; wrap it in a list: "
                . "{$entryPoint}([block])"
            );
        }
        if ($credentials === []) {
            throw new SdkUsageError("{$entryPoint} needs at least one credentials block");
        }
        return $credentials;
    }

    /** @param list<mixed> $blocks
     *  @return array<string,int> */
    private static function indexDeclaredNames(array $blocks): array
    {
        $declared = [];
        $unnamed = null;
        foreach ($blocks as $index => $block) {
            $name = SdkConfig::readClientName($block);
            if ($name === null) {
                $unnamed ??= $index;
                continue;
            }
            if (array_key_exists($name, $declared)) {
                throw new SdkUsageError("two instances share clientName '{$name}' (positions {$declared[$name]} and {$index}); names must be unique");
            }
            $declared[$name] = $index;
        }
        if ($unnamed !== null && array_key_exists(self::DEFAULT_CLIENT_NAME, $declared)) {
            throw new SdkUsageError(
                "an entry omits clientName, which every entry requires, and another entry is "
                . "named 'default'; give every entry a unique clientName"
            );
        }
        return $declared;
    }
}
