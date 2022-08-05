<?php

namespace Botify\Utils\Plugins;

use Amp\Promise;
use Botify\Types\Update;
use Botify\Utils\Bag;
use Botify\Utils\Plugins\Exceptions\ContinuePropagation;
use Botify\Utils\Plugins\Exceptions\StopPropagation;
use Closure;
use function Amp\call;
use function Botify\array_some;
use function Botify\concat;
use function Botify\config;
use function Botify\gather;

class Plugin
{
    private static array $plugins = [];
    public ?Bag $bag;
    public $reflector;
    public ?Update $update;

    public function __construct($directory)
    {
        $this->loadPlugins($directory);
    }

    /**
     * @return void
     */
    private function loadPlugins(string $dir)
    {
        if (!empty($dir)) {
            $contents = glob($dir . '/*');

            foreach ($contents as $content) {
                if (is_dir($content)) {
                    $this->loadPlugins($content);
                } else {
                    if (true !== $plugin = require_once $content) {
                        $name = pathinfo(strtolower(basename($content)), PATHINFO_FILENAME);
                        if ($plugin instanceof Pluggable) {
                            $priority = $plugin->getPriority();

                            if ($matches = preg_grep("/^$name#?/", array_keys(static::$plugins[$priority] ?? []))) {
                                [$name, $counter] = explode('#', concat(end($matches), '#'));
                                $counter++;
                                $name = implode('#', [$name, $counter]);
                            }

                            static::$plugins[$priority][$name] = $plugin;
                        }
                    }
                }
            }

            ksort(static::$plugins);
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
     * @return Plugin
     */
    public static function factory(string $directory): Plugin
    {
        return new static($directory);
    }

    /**
     * Remove cache and reload plugins
     *
     * @return void
     */
    public function reloadPlugins()
    {
        static::$plugins = [];
        $this->loadPlugins(config('telegram.plugins_dir', ''));
    }

    public function wait(): Promise
    {
        return call(function () {
            foreach (static::$plugins as $priority => $plugins) {
                try {
                    $responses = yield gather(array_filter(array_map(function (Pluggable $plugin) {
                        return call(function () use ($plugin) {
                            $plugin->setUpdate($this->update);
                            $plugin->setAPI($this->update->getAPI());
                            $plugin->setBag($this->bag);

                            if (method_exists($plugin, 'boot')) {
                                yield $this->reflector->bindCallback([$plugin, 'boot']);
                            }

                            foreach ($plugin->getFilters() as $filter) {
                                if ($filter instanceof Closure) {
                                    $filter = $filter->bindTo($plugin);
                                }

                                if (!boolval(yield $this->reflector->bindCallback($filter))) {
                                    return false;
                                }
                            }

                            $response = yield $this->reflector->bindCallback($plugin->getCallback());

                            $plugin->close();

                            return $response;
                        });
                    }, $plugins)));
                } catch (StopPropagation $e) {
                    break;
                } catch (ContinuePropagation $e) {
                    continue;
                }

                if (array_some($responses, fn($response) => !is_null($response))) {
                    break;
                }
            }
        });
    }

    public function withBag(Bag $bag): Plugin
    {
        $plugin = clone $this;
        $plugin->bag = $bag;
        return $plugin;
    }

    public function withReflector($reflector): Plugin
    {
        $plugin = clone $this;
        $plugin->reflector = $reflector;
        return $plugin;
    }

    public function withUpdate(Update $update): Plugin
    {
        $plugin = clone $this;
        $plugin->update = $update;
        return $plugin;
    }
}