<?php

namespace MWazovzky\Simple;

class Request
{
    /**
     * Request method
     *
     * @var string $method
     */
    public $method;

    /**
     * Request path
     *
     * @var string $path
     */
    public $path;

    /**
     * Request query
     *
     * @var array $query
     */
    public $query = [];

    /**
     * Create Request and initialize instance.
     */
    public function __construct()
    {
        $this->method = $_SERVER[REQUEST_METHOD];

        $uri = parse_url($_SERVER[REQUEST_URI]);
        $this->path = $uri['path'];

        $this->query = $this->getParams();
    }

    /**
     * Read request parameters.
     *
     * @return array [$key => $value]
     */
    protected function getParams()
    {
        if (strpos($_SERVER["CONTENT_TYPE"], 'application/json') !== false) {
            return json_decode(file_get_contents('php://input'), true);
        }

        return ($this->method == 'GET') ? $_GET : $_POST;
    }
}
