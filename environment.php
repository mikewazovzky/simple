<?php
return [ 

	// Database settings
	'db' => [
		'host' => 'localhost',
		'database' => 'news', 
		'user' => 'root', 
		'password' => ''
	],
	
	// User Email Acccount settings
	'mail' => [
		'host' => 'smtp.yandex.ru',
		// 'port' => 465,
		// 'encryption' => 'ssl',		
		'port' => 587,
		'encryption' => 'tls',
		'login' => 'mike.wazovzky',
		'password' => 'BigDogsBite',		
		'address' => 'mike.wazovzky@yandex.ru',
		'name' => 'Mike Wazovzky'
	]	
];