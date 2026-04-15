<?php

class ClassLoader
{
    protected static $dirs = [];

    public static function register()
    {
        spl_autoload_register([static::class, 'load']);
    }

    public static function addDir($dir)
    {
        static::$dirs[] = $dir;
    }

    public static function load($class)
    {
        foreach (static::$dirs as $dir) {
            $file = $dir . '/' . $class . '.php';
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
        }
        return false;
    }
}