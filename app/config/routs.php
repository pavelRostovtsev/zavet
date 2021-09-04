<?php

return [
	'' => [
	    'controller' => 'article',
        'action'     => 'index',
        'middleware' => '',
    ],

    'articles/show/{id:\d+}' => [
        'controller' => 'article',
        'action'     => 'show',
        'middleware' => '',
    ],

    'articles/create' => [
        'controller' => 'article',
        'action'     => 'create',
        'middleware' => '',
    ],

    'articles/store' => [
        'controller' => 'article',
        'action'     => 'store',
        'middleware' => '',
    ],

    'articles/edit/{id:\d+}' => [
        'controller' => 'article',
        'action'     => 'edit',
        'middleware' => '',
    ],

    'articles/update/{id:\d+}' => [
        'controller' => 'article',
        'action'     => 'update',
        'middleware' => '',
    ],

    'articles/destroy/{id:\d+}' => [
        'controller' => 'article',
        'action' => 'destroy',
        'middleware' => '',
    ],

    'admin/registration' => [
        'controller' => 'admin',
        'action' => 'registration',
    ],

    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],

    'admin/logOut' => [
        'controller' => 'admin',
        'action' => 'logOut',
    ],

];