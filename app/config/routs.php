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


    'admin/sign-in' => [
        'controller' => 'admin',
        'action' => 'signIn',
    ],
    'admin/authorization' => [
        'controller' => 'admin',
        'action' => 'authorization',
    ],
    'admin/logOut' => [
        'controller' => 'admin',
        'action' => 'logOut',
    ],

];