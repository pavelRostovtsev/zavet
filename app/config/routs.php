<?php

return [
	'' => [
	    'controller' => 'article',
        'action'     => 'index',
    ],

    'articles/show/{id:\d+}' => [
        'controller' => 'article',
        'action'     => 'show',
    ],

    'articles/create' => [
        'controller' => 'article',
        'action'     => 'create',
        'middleware' => 'article',
    ],

    'articles/store' => [
        'controller' => 'article',
        'action'     => 'store',
        'middleware' => 'article',
    ],

    'articles/edit/{id:\d+}' => [
        'controller' => 'article',
        'action'     => 'edit',
        'middleware' => 'article',
    ],

    'articles/update/{id:\d+}' => [
        'controller' => 'article',
        'action'     => 'update',
        'middleware' => 'admin',
    ],

    'articles/destroy/{id:\d+}' => [
        'controller' => 'article',
        'action'     => 'destroy',
        'middleware' => 'admin',
    ],

    'admin/registration' => [
        'controller' => 'admin',
        'action'     => 'registration',
        'middleware' => 'admin',
    ],

    'admin/login' => [
        'controller' => 'admin',
        'action'     => 'login',
        'middleware' => 'admin',
    ],

    'admin/logOut' => [
        'controller' => 'admin',
        'action'     => 'logOut',

    ],

];