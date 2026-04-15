<?php

class WebRouters
{
    // Este arreglo define todas las rutas de nuestra aplicación web
    public static function getRoutes()
    {
        return [
            '/' => ['controller' => 'UserController', 'action' => 'index'],
            '/users' => ['controller' => 'UserController', 'action' => 'index'],
            '/users/create' => ['controller' => 'UserController', 'action' => 'create'],
            '/users/store' => ['controller' => 'UserController', 'action' => 'store'],
            '/users/edit' => ['controller' => 'UserController', 'action' => 'edit'],
            '/users/update' => ['controller' => 'UserController', 'action' => 'update'],
            '/users/delete' => ['controller' => 'UserController', 'action' => 'delete'],
            '/login' => ['controller' => 'AuthController', 'action' => 'login'],
            '/logout' => ['controller' => 'AuthController', 'action' => 'logout'],
        ];
    }
}