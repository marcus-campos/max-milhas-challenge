<?php

return [
    //Gallery
    ['method' => 'get', 'route' => '/', 'use' => 'GalleryController@index'],

    //Manager Routes
    ['method' => 'get', 'route' => '/manager', 'use' => 'ManagerController@index'],
    ['method' => 'post', 'route' => '/manager/add', 'use' => 'ManagerController@add'],
    ['method' => 'get', 'route' => '/manager/destroy/{id}', 'use' => 'ManagerController@destroy'],

    //About
    ['method' => 'get', 'route' => '/about', 'use' => 'AboutController@index'],
];