<?php

declare(strict_types=1);

require_once __DIR__ . '/ClassLoader.php';

final class DependencyInjection
{
    public static function boot(): void
    {
        ClassLoader::register();
    }

    /** @return Connection */
    public static function getConnection(): Connection
    {
        ClassLoader::loadClass('Connection');
        return new Connection(
            host: '127.0.0.1',
            port: 3306,
            database: 'crud_usuarios',
            username: 'root',
            password: '',
            charset: 'utf8mb4'
        );
    }

    public static function getPdo(): PDO
    {
        // Agregamos un try-catch aquí por seguridad para que no muera el index en silencio
        try {
            return self::getConnection()->createPdo();
        } catch (Exception $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // --- MAPPERS DE USUARIO ---
    public static function getUserPersistenceMapper(): UserPersistenceMapper
    {
        ClassLoader::loadClass('UserPersistenceMapper');
        return new UserPersistenceMapper();
    }

    public static function getUserWebMapper(): UserWebMapper
    {
        ClassLoader::loadClass('UserWebMapper');
        return new UserWebMapper();
    }

    // --- REPOSITORIES ---
    public static function getUserRepository(): UserRepositoryMySQL
    {
        ClassLoader::loadClass('UserRepositoryMySQL');
        return new UserRepositoryMySQL(
            self::getPdo(), 
            self::getUserPersistenceMapper()
        );
    }

    // --- USE CASES (SERVICIOS) ---
    public static function getCreateUserUseCase(): CreateUserUseCase
    {
        ClassLoader::loadClass('CreateUserService');
        $repo = self::getUserRepository();
        return new CreateUserService($repo, $repo);
    }

    
    public static function getLoginUseCase(): LoginUseCase
    {
        ClassLoader::loadClass('LoginService');
        return new LoginService(self::getUserRepository());
    }

    public static function getUpdateUserUseCase(): UpdateUserUseCase
    {
        ClassLoader::loadClass('UpdateUserService');
        $repo = self::getUserRepository();
        return new UpdateUserService($repo, $repo, $repo);
    }

    public static function getDeleteUserUseCase(): DeleteUserUseCase
    {
        ClassLoader::loadClass('DeleteUserService');
        $repo = self::getUserRepository();
        return new DeleteUserService($repo, $repo);
    }

    public static function getGetUserByIdUseCase(): GetUserByIdUseCase
    {
        ClassLoader::loadClass('GetUserByIdService');
        return new GetUserByIdService(self::getUserRepository());
    }

    public static function getGetAllUsersUseCase(): GetAllUsersUseCase
    {
        ClassLoader::loadClass('GetAllUsersService');
        return new GetAllUsersService(self::getUserRepository());
    }

    // --- CONTROLLER ---
    public static function getUserController(): UserController
    {
        ClassLoader::loadClass('UserController');
        return new UserController(
            self::getCreateUserUseCase(),
            self::getUpdateUserUseCase(),
            self::getGetUserByIdUseCase(),
            self::getGetAllUsersUseCase(),
            self::getDeleteUserUseCase(),
            self::getUserWebMapper(),
        );
    }

    // --- MAPPERS DE GASTOS ---
    public static function getGastoPersistenceMapper(): GastoPersistenceMapper
    {
        ClassLoader::loadClass('GastoPersistenceMapper');
        return new GastoPersistenceMapper();
    }

    public static function getGastoWebMapper(): GastoWebMapper
    {
        ClassLoader::loadClass('GastoWebMapper');
        return new GastoWebMapper();
    }

    // --- REPOSITORIO DE GASTOS ---
    public static function getGastoRepository(): GastoRepositoryMySQL
    {
        ClassLoader::loadClass('GastoRepositoryMySQL');
        return new GastoRepositoryMySQL(
            self::getPdo(), 
            self::getGastoPersistenceMapper()
        );
    }

    // --- CASOS DE USO DE GASTOS ---
    public static function getCreateGastoUseCase(): CreateGastoUseCase
    {
        ClassLoader::loadClass('CreateGastoService');
        return new CreateGastoService(self::getGastoRepository());
    }

    public static function getUpdateGastoUseCase(): UpdateGastoUseCase
    {
        ClassLoader::loadClass('UpdateGastoService');
        $repo = self::getGastoRepository();
        return new UpdateGastoService($repo, $repo);
    }

    public static function getGetGastoByIdUseCase(): GetGastoByIdUseCase
    {
        ClassLoader::loadClass('GetGastoByIdService');
        return new GetGastoByIdService(self::getGastoRepository());
    }

    public static function getGetAllGastosUseCase(): GetAllGastosUseCase
    {
        ClassLoader::loadClass('GetAllGastosService');
        return new GetAllGastosService(self::getGastoRepository());
    }

    public static function getDeleteGastoUseCase(): DeleteGastoUseCase
    {
        ClassLoader::loadClass('DeleteGastoService');
        $repo = self::getGastoRepository();
        // Le pasamos el repo DOS veces porque el repo cumple ambas funciones (Delete y GetById)
        return new DeleteGastoService($repo, $repo);
    }

    // --- EL CONTROLADOR DE GASTOS ---
    public static function getGastoController(): GastoController
    {
        ClassLoader::loadClass('GastoController');
        return new GastoController(
            self::getCreateGastoUseCase(),
            self::getUpdateGastoUseCase(),
            self::getGetGastoByIdUseCase(),
            self::getGetAllGastosUseCase(),
            self::getDeleteGastoUseCase(),
            self::getGastoWebMapper()
        );
    }
}