<?php
/**
 * Front controller
 * all user requests are configured to be send to index.php
 * via Apache rewrite mod (.htaccess file configuration).
 * Actual URI requested by user is fetched from $_SERVER['REQUEST_URI'] 
 */
require __DIR__ . '/vendor/autoload.php';

use News\Controllers\Client;
use News\Controllers\Admin;
use Mikewazovzky\Simple\Controllers\ErrorHandler;
use Mikewazovzky\Simple\Logger;
use Mikewazovzky\Simple\Mailer;
use Mikewazovzky\Simple\Exceptions\BasicException;
use Mikewazovzky\Simple\Exceptions\DatabaseException;
use Mikewazovzky\Simple\Exceptions\NodataException;
use Mikewazovzky\Simple\Exceptions\NotFoundException;

// use Mikewazovzky\Simple\Tools\UriParser;
// DEBUG: // $requestedUrl = $_SERVER['REQUEST_URI'];
// DEBUG: // $url = new UriParser($requestedUrl);
// DEBUG: // var_dump($url->parameter('app')); die();
$ctrl = $_GET['controller'] ?: 'Client';
$action = $_GET['action'] ?: 'Index';
$errorHandler = new ErrorHandler();
$admin = 'mike.wazovzky@gmail.com';
// DEBUG: // echo "controller = $ctrl, action = $action";
try {
	$logger = new Logger(__DIR__ . '/errorlog.txt');
	$mailer = new Mailer;
	
	switch ($ctrl) {
	case 'Client':
		$controller = new Client;
		break;
	case 'Admin':
		$controller = new Admin;
		break;
	default:
		throw new NotFoundException('Requested controller not found', 404);
	}
	
	$controller->action($action);

} catch (DatabaseException $e) {
	// send email to administrator via swiftmailer
	$mailer->send($admin, 'DB ERROR', $e->getMessage());
	$logger->critical($e->getMessage());
	$errorHandler->actionShow($e);	

} catch (NodataException $e) {
	$logger->warning($e->getMessage());
	$errorHandler->actionShow($e);	

} catch (BasicException $e) {
	$errorHandler->actionShow($e);	
} 