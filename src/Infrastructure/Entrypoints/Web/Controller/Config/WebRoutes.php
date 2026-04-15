<?php

declare(strict_types=1);

final class WebRoutes
{
    /**
     * @return array<string, array<string, string>>
     */
    public static function routes(): array
    {
        return array(

        // --- RUTAS DE INICIO Y AUTH ---
            'home' => array(
                'method' => 'GET',
                'action' => 'home',
            ),
            'users.create' => array(
                'method' => 'GET',
                'action' => 'create',
            ),
            'users.store' => array(
                'method' => 'POST',
                'action' => 'store',
            ),
            'users.index' => array(
                'method' => 'GET',
                'action' => 'index',
            ),
            'users.show' => array(
                'method' => 'GET',
                'action' => 'show',
            ),
            'users.edit' => array(
                'method' => 'GET',
                'action' => 'edit',
            ),
            'users.update' => array(
                'method' => 'POST',
                'action' => 'update',
            ),
            'users.delete' => array(
                'method' => 'POST',
                'action' => 'delete',
            ),
            'auth.login' => array(
                'method' => 'GET',
                'action' => 'login',
            ),
            'auth.authenticate' => array(
                'method' => 'POST',
                'action' => 'authenticate',
            ),
            'auth.logout' => array(
                'method' => 'GET',
                'action' => 'logout',
            ),
            'auth.forgot' => array(
                'method' => 'GET',
                'action' => 'forgot',
            ),
            'auth.forgot.send' => array(
                'method' => 'POST',
                'action' => 'forgot.send',
            ),
        // --- AQUÍ EMPIEZAN GASTOS ---
            'gastos.index' => array(
                'method' => 'GET',
                'action' => 'gastos.index',
            ),
            'gastos.create' => array(
                'method' => 'GET',
                'action' => 'gastos.create',
            ),
            'gastos.store' => array(
                'method' => 'POST',
                'action' => 'gastos.store',
            ),
            'gastos.edit' => array(
                'method' => 'GET',
                'action' => 'gastos.edit',
            ),
            'gastos.update' => array(
                'method' => 'POST',
                'action' => 'gastos.update',
            ),
            'gastos.delete' => array(
                'method' => 'POST',
                'action' => 'gastos.delete',
            ),

            
        );
    }
}