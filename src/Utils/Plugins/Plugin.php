<?php

namespace Botify\Utils\Plugins;

use Amp\Promise;
use Botify\Types\Update;
use Botify\Utils\DataBag;
use Closure;
use function Amp\call;

class Plugin
{
    private static array $plugins = [];
    private string $directory;

    public function __construct($directory, public Update $update, public $reflector, public DataBag $bag)
    {
        $this->setDirectory($directory);
        $this->loadPlugins();
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
     * @param Update $update
     * @param $reflector
     * @param DataBag $bag
     * @return Plugin
     */
    public static function factory(string $directory, Update $update, $reflector, DataBag $bag): Plugin
    {
        return new static($directory, $update, $reflector, $bag);
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
                $plugin->setBag($this->bag);

                if (method_exists($plugin, 'boot')) {
                    yield $this->reflector->bindCallback([$plugin, 'boot']);
                }

                foreach ($plugin->getFilters() as $filter) {
                    if ($filter instanceof Closure) {
                        $filter = $filter->bindTo($plugin);
                    }

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