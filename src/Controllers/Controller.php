<?php

namespace MWazovzky\Simple\Controllers;

use MWazovzky\Simple\View;

class Controller
{
    public $view;

    public function __construct()
    {
        $this->view = new View;
    }

    /**
     * Call controller method.
     *
     * @param string $methodName
     * @param array $query
     * @return mixed
     */
    public function action($methodName, $query = null)
    {
        return $this->$methodName($query);
    }

    /**
     * Redirect to controller method.
     *
     * @param string $methodName
     * @param array $query
     * @return mixed
     */
    public function redirect($action, $query = [])
    {
        return $this->action($action, $query);
    }
}
