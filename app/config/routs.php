<?php

return [
	'' => [
	    'controller' => 'user',
        'action'     => 'index',
    ],
    'admin' => [
        'controller' => 'admin',
        'action'     => 'index'
    ],
    'show/{page:\d+}' => [
        'controller' => 'user',
        'action' => 'index',
    ],

];