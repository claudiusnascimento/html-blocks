<?php

return [

    'routes' => [
        'prefix' => 'admin',
        'middlewares' => ['web', 'auth']
    ],

    'wysisyg_class' => 'html-editor'
];
