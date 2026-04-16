<?php
declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        // --- DOMINIO: EXCEPCIONES DE GASTOS ---
        'GastoNotFoundException' => 'Domain/Exceptions/GastoNotFoundException.php',
        'InvalidGastoAmountException' => 'Domain/Exceptions/InvalidGastoAmountException.php',
        'InvalidGastoDescriptionException' => 'Domain/Exceptions/InvalidGastoDescriptionException.php',
        'InvalidGastoFechaException' => 'Domain/Exceptions/InvalidGastoFechaException.php',
        'InvalidGastoIdException' => 'Domain/Exceptions/InvalidGastoIdException.php',
        'InvalidGastoLugarException' => 'Domain/Exceptions/InvalidGastoLugarException.php',
        'InvalidServicioTipoException' => 'Domain/Exceptions/InvalidServicioTipoException.php',

        // --- DOMINIO: EXCEPCIONES DE USUARIOS ---
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',


        // --- DOMINIO: VALUE OBJECTS DE GASTOS ---
        'GastoAmount' => 'Domain/ValueObjects/GastoAmount.php',
        'GastoDescription' => 'Domain/ValueObjects/GastoDescription.php',
        'GastoFecha' => 'Domain/ValueObjects/GastoFecha.php',
        'GastoId' => 'Domain/ValueObjects/GastoId.php',
        'GastoLugar' => 'Domain/ValueObjects/GastoLugar.php',

        // --- DOMINIO: VALUE OBJECTS DE USUARIOS ---
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',

        // --- DOMINIO: MODELOS ---
        'GastoModel' => 'Domain/Models/GastoModel.php',
        'UserModel' => 'Domain/Models/UserModel.php',

        // --- DOMINIO: ENUMS ---
        'GastoServicioTipoEnum' => 'Domain/Enums/GastoServicioTipoEnum.php',
        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        // --- DOMINIO: EVENTOS ---
        'EventDomain' => 'Domain/Events/EventDomain.php',
        'GastoCreatedEvent' => 'Domain/Events/GastoCreatedEvent.php',
        'GastoDeletedEvent' => 'Domain/Events/GastoDeletedEvent.php',
        'GastoUpdatedEvent' => 'Domain/Events/GastoUpdatedEvent.php',
        'UserCreatedDomainEvent' => 'Domain/Events/UserCreatedDomainEvent.php',
        'UserDeletedDomainEvent' => 'Domain/Events/UserDeletedDomainEvent.php',
        'UserUpdatedDomainEvent' => 'Domain/Events/UserUpdatedDomainEvent.php',


        // --- APLICACIÓN: PUERTOS DE ENTRADA (GASTOS) ---
        'CreateGastoUseCase' => 'Application/Ports/In/CreateGastoUseCase.php',
        'DeleteGastoUseCase' => 'Application/Ports/In/DeleteGastoUseCase.php',
        'GetAllGastosUseCase' => 'Application/Ports/In/GetAllGastosUseCase.php',
        'GetGastoByIdUseCase' => 'Application/Ports/In/GetGastoByIdUseCase.php',
        'UpdateGastoUseCase' => 'Application/Ports/In/UpdateGastoUseCase.php',

        // --- APLICACIÓN: PUERTOS DE ENTRADA (USUARIOS) ---
        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',

        // --- APLICACIÓN: PUERTOS DE SALIDA (GASTOS) ---
        'DeleteGastoPort' => 'Application/Ports/Out/DeleteGastoPort.php',
        'GetAllGastosPort' => 'Application/Ports/Out/GetAllGastosPort.php',
        'GetGastoByIdPort' => 'Application/Ports/Out/GetGastoByIdPort.php',
        'SaveGastoPort' => 'Application/Ports/Out/SaveGastoPort.php',
        'UpdateGastoPort' => 'Application/Ports/Out/UpdateGastoPort.php',

        // --- APLICACIÓN: PUERTOS DE SALIDA (USUARIOS) ---
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',



       // --- APLICACIÓN: DTOs - COMMANDS (GASTOS) ---
        'CreateGastoCommand' => 'Application/Services/Dto/Commands/CreateGastoCommand.php',
        'DeleteGastoCommand' => 'Application/Services/Dto/Commands/DeleteGastoCommand.php',
        'UpdateGastoCommand' => 'Application/Services/Dto/Commands/UpdateGastoCommand.php',

        // --- APLICACIÓN: DTOs - COMMANDS (USUARIOS) ---
        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',

        // --- APLICACIÓN: DTOs - QUERIES (GASTOS) ---
        'GetAllGastosQuery' => 'Application/Services/Dto/Queries/GetAllGastosQuery.php',
        'GetGastoByIdQuery' => 'Application/Services/Dto/Queries/GetGastoByIdQuery.php',

        // --- APLICACIÓN: DTOs - QUERIES (USUARIOS) ---
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',

        // --- APLICACIÓN: MAPPERS (Traducción entre capas) ---
        'GastoApplicationMapper' => 'Application/Services/Mappers/GastoApplicationMapper.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',

        // --- APLICACIÓN: SERVICIOS DE GASTOS ---
        'CreateGastoService' => 'Application/Services/CreateGastoService.php',
        'DeleteGastoService' => 'Application/Services/DeleteGastoService.php',
        'GetAllGastosService' => 'Application/Services/GetAllGastosService.php',
        'GetGastoByIdService' => 'Application/Services/GetGastoByIdService.php',
        'UpdateGastoService' => 'Application/Services/UpdateGastoService.php',

        // --- APLICACIÓN: SERVICIOS DE USUARIOS ---
        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',

        // --- COMMON: UTILIDADES DEL SISTEMA ---
        'DependencyInjection' => 'Common/DependencyInjection.php',

        // --- INFRAESTRUCTURA: CONFIGURACIÓN DB (MySQL) ---
        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'PDODatabase' => 'Infrastructure/Adapters/Persistence/MySQL/Config/PDODatabase.php',

        // --- INFRAESTRUCTURA: PERSISTENCIA DTO (MySQL) ---
        'GastoPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/GastoPersistenceDto.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',

        // --- INFRAESTRUCTURA: ENTIDADES DE BASE DE DATOS (MySQL) ---
        'GastoEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/GastoEntity.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',

        // --- INFRAESTRUCTURA: MAPPERS DE PERSISTENCIA (MySQL) ---
        'GastoPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/GastoPersistenceMapper.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',

        // --- INFRAESTRUCTURA: REPOSITORIOS (MySQL) ---
        'GastoRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/GastoRepositoryMySQL.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',

        // --- INFRAESTRUCTURA: RUTAS (Web) ---
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controller/Config/WebRoutes.php',

        // --- INFRAESTRUCTURA: WEB DTOs (Requests y Responses) ---
        'CreateGastoWebRequest' => 'Infrastructure/Entrypoints/Web/Controller/Dto/CreateGastoWebRequest.php',
        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controller/Dto/CreateUserWebRequest.php',
        'GastoResponse' => 'Infrastructure/Entrypoints/Web/Controller/Dto/GastoResponse.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controller/Dto/LoginWebRequest.php',
        'UpdateGastoWebRequest' => 'Infrastructure/Entrypoints/Web/Controller/Dto/UpdateGastoWebRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controller/Dto/UpdateUserWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controller/Dto/UserResponse.php',

        // --- INFRAESTRUCTURA: WEB MAPPERS ---
        'GastoWebMapper' => 'Infrastructure/Entrypoints/Web/Controller/Mapper/GastoWebMapper.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controller/Mapper/UserWebMapper.php',

        

        // --- INFRAESTRUCTURA: CONTROLADORES ---
        'GastoController' => 'Infrastructure/Entrypoints/Web/Controller/GastoController.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controller/UserController.php',

        // --- PRESENTACIÓN: UTILIDADES DE VISTA Y MENSAJES ---
        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        // Buscamos desde la raíz de la carpeta 'src'
        $baseDir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR; 
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}