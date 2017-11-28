<?php

use MWazovzky\Simple\Logger;
use MWazovzky\Simple\Mailer;
use MWazovzky\Simple\Router;
use MWazovzky\Simple\Request;
use MWazovzky\Simple\Controllers\ErrorHandler;
use MWazovzky\Simple\Exceptions\NodataException;
use MWazovzky\Simple\Exceptions\DatabaseException;

require __DIR__.'/vendor/autoload.php';

$request = new Request();
$router = new Router();

$errorHandler = new ErrorHandler;
$logger = new Logger(__DIR__ . '/errorlog.txt');
$mailer = new Mailer;
$admin = config('mail.admin');

try {
    $router->loadRoutes(include(__DIR__ . '/routes.php'));
    $router->process($request);
} catch (DatabaseException $e) {
    $errorHandler->show($e);
} catch (NodataException $e) {
    $errorHandler->show($e);
} catch (Exception $e) {
    $mailer->send($admin, 'APP ERROR!', $e->getMessage());
    $logger->critical($e->getMessage());
    $errorHandler->show($e);
}
