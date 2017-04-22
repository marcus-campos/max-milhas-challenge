# Configurar banco de dados


No arquivo `db.php` encontado em `.../config/db.php` você poderá determinar qual é o tipo driver e as configurações que deseja utilizar para realizar a conexão.


## Exemplo

```
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

```