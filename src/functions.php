<?php

use Mikewazovzky\Simple\View;
use Mikewazovzky\Simple\Config;
use Mikewazovzky\Simple\Environment;

/**
 * Redirect to specified url.
 *
 * @param string $url
 * @param string $status - redirect HTTP statis code
 * @return void
 */
function redirect($url, $status = 302)
{
    header('Location: ' . $url, true, $status);
    exit();
}

/**
 * Var dump and die
 *
 * @var mixed $var
 * @return void
 */
function dd($var = null)
{
    if ($var) {
        var_dump($var);
    }

    die();
}

/**
 * Get session data for specified key
 *
 * @param string $key
 * @return mixed
 */
function session($key)
{
    return $_SESSION[$key] ?? null;
}

/**
 * Display template
 *
 * @param string $template
 * @return void
 */
function view($template)
{
    $view = new View;
    $view->display($template);
}

/**
 * Get env configuration parameter
 *
 * @param string $key - parametyer $key
 * @param mixed $default - parameter default value
 * @return mixed
 */
function env($key, $default = null)
{
    return Environment::instance()->get($key, $default);
}

/**
 * Get configuration parameter
 *
 * @param string $param - dot separated parameter group and key: 'group.key'
 * @return mixed
 */
function config($param)
{
    list($group, $key) = explode('.', $param);

    return Config::instance()->get($group, $key);
}
