<?php

namespace Botify\Utils\Plugins;

use Amp\Promise;
use Botify\TelegramAPI;
use Botify\Types\Update;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionUnionType;
use function Amp\call;
use function Amp\coroutine;

class Plugin
{
    private static array $plugins = [];
    private string $directory;
    private $reflector;

    public function __construct($directory, public TelegramAPI $api, public Update $update)
    {
        $this->setDirectory($directory);
        $this->loadPlugins();
        $this->reflector = new class($this->update) {

            public function __construct(private Update $update)
            {
            }

            public function bindCallback(callable $callback, array $arguments = [])
            {
                $reflection = is_array($callback)
                    ? new ReflectionMethod(... $callback)
                    : new ReflectionFunction($callback);
                $parameters = $reflection->getParameters();

                foreach ($parameters as $index => $parameter) {
                    $types = $parameter->getType() instanceof ReflectionUnionType
                        ? $parameter->getType()->getTypes()
                        : [$parameter->getType()];

                    if ($value = array_sole($types, function ($type) {
                        $name = $type->getName();

                        $isEqual = function () use ($name) {
                            foreach ($this->update::JSON_PROPERTY_MAP as $index => $item) {
                                if (str_ends_with($name, $item) && isset($this->update[$index])) {
                                    return $this->update[$index];
                                }
                            }

                            return false;
                        };

                        if ($name === get_class($this->update)) {
                            return $this->update;
                        } elseif ($name === TelegramAPI::class) {
                            return $this->update->getAPI();
                        } elseif ($value = $isEqual()) {
                            return $value;
                        }
                    })) {
                        $arguments[$index] = $value;
                    } else {
                        unset($parameters[$index]);
                    }
                }

                if ($reflection->getNumberOfParameters() === count($parameters)) {
                    return coroutine($callback)(... $arguments);
                }
            }
        };
    }

    /**
     * Remove cache and reload plugins
     *
     * @return void
     */
    public function reloadPlugins()
    {
        static::$plugins = [];
        $this->loadPlugins();
    }

    /**
     * @return void
     */
    private function loadPlugins($dir = '')
    {
        $contents = glob($dir ?: $this->directory . '/*');

        foreach ($contents as $content) {
            if (is_dir($content)) {
                $this->loadPlugins($content);
            } else {
                if (true !== $plugin = require_once $content) {
                    $name = pathinfo(strtolower(basename($content)), PATHINFO_FILENAME);
                    if (is_callable($plugin) || is_object($plugin)) {
                        if ($matches = preg_grep("/^{$name}#?/", array_keys(static::$plugins))) {
                            [$name, $counter] = explode('#', concat(end($matches), '#'));
                            $counter++;
                            $name = implode('#', [$name, $counter]);
                        }

                        if ($plugin instanceof Pluggable) {
                            static::$plugins[$name] = $plugin;
                        }
                    }
                }
            }
        }
    }

    /**
     * @return Pluggable
     */
    public static function apply(): Pluggable
    {
        $args = func_get_args();
        $filters = [];

        if (func_num_args() === 1) {
            $fn = reset($args);
        } else {
            [$filters, $fn] = $args;
        }

        return new class($filters, $fn) extends Pluggable {
        };
    }

    /**
     * @param string $directory
     * @param TelegramAPI $api
     * @param Update $update
     * @return Plugin
     */
    public static function factory(string $directory, TelegramAPI $api, Update $update): Plugin
    {
        return new static($directory, $api, $update);
    }

    /**
     * @param string $directory
     */
    public function setDirectory(string $directory): void
    {
        $this->directory = $directory;
    }

    public function wait(): Promise
    {
        return gather(array_filter(array_map(function (Pluggable $plugin) {
            return call(function () use ($plugin) {
                $plugin->setUpdate($this->update);

                if (method_exists($plugin, 'boot')) {
                    yield $this->reflector->bindCallback([$plugin, 'boot']);
                }

                foreach ($plugin->getFilters() as $filter) {
                    if (!boolval(yield $this->reflector->bindCallback($filter))) {
                        return;
                    }
                }

                yield $this->reflector->bindCallback($plugin->getCallback());

                $plugin->reset();
            });
        }, static::$plugins)));
    }
}