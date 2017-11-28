<?php

return [
    'GET' => [
        '/'  => ['controller' => 'NewsController', 'action' => 'index'],
        '/news/index'  => ['controller' => 'NewsController', 'action' => 'index'],
        '/news/show'  => ['controller' => 'NewsController', 'action' => 'show'],
        '/admin/index'  => ['controller' => 'AdminController', 'action' => 'index'],
        '/admin/edit'  => ['controller' => 'AdminController', 'action' => 'edit'],
        '/admin/delete'  => ['controller' => 'AdminController', 'action' => 'delete'],
    ],

    'POST' => [
        '/admin/save'  => ['controller' => 'AdminController', 'action' => 'save'],
    ]
];
