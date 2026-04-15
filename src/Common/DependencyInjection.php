<?php

class DependencyInjection
{
    private static $instances = [];

    public static function get($class)
    {
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = self::create($class);
        }
        return self::$instances[$class];
    }

    private static function create($class)
    {
        if ($class === 'PDODatabase') {
            return new PDODatabase(
                'mysql:host=localhost;dbname=crud_usuarios;charset=utf8mb4',
                'root',
                ''
            );
        }

        // Aquí se irán agregando los Repositorios y Servicios más adelante
        
        throw new Exception("No se puede crear la instancia de la clase: " . $class);
    }
}