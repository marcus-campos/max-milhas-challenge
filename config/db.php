<?php

/*
 |--------------------------------------------------------------------------
 | Default Database configs
 |--------------------------------------------------------------------------
 |
 | Here you can specify the database settings that you want to use.
 |
 */

return [
    'driver' => 'sqlite',

    'sqlite' => [
        'path' => databasePath('mmg.db')
    ],

    'mysql' => [
        'host' => 'localhost',
        'database' => 'galeria',
        'user' => 'root',
        'password' => 'root'
    ]
];
