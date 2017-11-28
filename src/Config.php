<?php

namespace MWazovzky\Simple;

class Config
{
    use Singleton;

    /**
     * Configuration parameters.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Default path to project config folder /config
     *
     * @var string $pathname
     */
    protected $pathname = __DIR__ . '/../../../../config/';

    /**
     * Create Config instance
     */
    protected function __construct()
    {
        foreach ($this->list() as $file) {
            $this->loadData(basename($file, '.php'), $file);
        }
    }

    /**
     * Read config parameters from the file
     *
     * @param string $key - parameter group key (name)
     * @param string|null $file
     * @return type
     */
    public function loadData($key, $file = null, $path = null)
    {
        $pathname = $path ?: $this->pathname;
        $file = $file ?: "{$key}.php";

        $this->data[$key] = include $pathname . '/' . $file;
    }

    /**
     * Get requested parameter
     *
     * @param type name
     * @return type
     */
    public function get($key, $element = null)
    {
        return $element ? $this->data[$key][$element] : $this->data[$key];
    }

    /**
     * Get the list of existing configuration files
     *
     * @return array of strings
     */
    protected function list()
    {
        $path = $this->pathname;

        if (!file_exists($path)) {
            return [];
        }

        $files = scandir($path);
        $files = array_filter($files, function ($file) use ($path) {
            $filepath = $path . $file;
            return !is_dir($filepath);
        });

        return $files;
    }
}
