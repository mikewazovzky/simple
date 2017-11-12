<?php

namespace Mikewazovzky\Simple;

class Environment
{
    use Singleton;

    /**
     * Env configuration parameters.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Default env parameters file located at the project root.
     *
     * @var string
     */
    protected $filename = __DIR__ . '/../../../../.env';

    /**
     * Create Environment  instance
     *
     * @param type name
     * @return type
     */
    protected function __construct()
    {
        $this->loadData();
    }

    /**
     * Load env data from the file
     *
     * @param string|null $file
     * @return boolean - true if success
     */
    public function loadData($file = null)
    {
        $filename = $file ?: $this->filename;

        if (!file_exists($filename)) {
            return false;
        }

        $lines = file($filename, FILE_SKIP_EMPTY_LINES);
        $lines = array_filter($lines, function ($line) {
            return mb_strlen(trim($line)) !== 0 && $line[0] !== '#';
        });

        foreach ($lines as $line) {
            list($key, $value) = explode('=', trim($line));
            $this->data[$key] = $value;
        }

        return true;
    }

    /**
     * Get env configuration parameter
     *
     * @param string $key - parameter key
     * @param string $default - default parameter value
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }
}
