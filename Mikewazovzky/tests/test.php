<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Mailer;

$mailer = new Mailer;
$result = $mailer->send('alexander.nichiporenko@gmail.com', '111 SimpleMailer test message', 'Lorem ipsum dolorem');
var_dump($result);
