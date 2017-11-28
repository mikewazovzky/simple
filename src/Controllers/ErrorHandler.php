<?php

namespace MWazovzky\Simple\Controllers;

use Exception;

class ErrorHandler extends Controller
{
    /**
     * Display error data to the user
     */
    public function show(Exception $e)
    {
        $this->view->class = get_class($e);
        $this->view->message = $e->getMessage();
        $this->view->code = $e->getCode();
        $this->view->file = $e->getFile();
        $this->view->line = $e->getLine();
        $this->view->trace = $e->getTraceAsString();
        $this->view->display('error.php', '/../templates');
    }
}
