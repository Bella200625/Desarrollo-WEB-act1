<?php 
declare(strict_types=1); 

require_once __DIR__ . '/../Ports/In/LoginUseCase.php'; 
require_once __DIR__ . '/../Ports/Out/GetUserByEmailPort.php'; 
require_once __DIR__ . '/Dto/Commands/LoginCommand.php'; 

require_once __DIR__ . '/../../Domain/Models/UserModel.php'; 
require_once __DIR__ . '/../../Domain/ValueObjects/UserEmail.php'; 
require_once __DIR__ . '/../../Domain/Enums/UserStatusEnum.php'; 
require_once __DIR__ . '/../../Domain/Exceptions/InvalidUserCredentialsException.php'; 

final class LoginService implements LoginUseCase 
{ 
    private GetUserByEmailPort $getUserByEmailPort; 

    public function __construct(GetUserByEmailPort $getUserByEmailPort) 
    { 
        $this->getUserByEmailPort = $getUserByEmailPort; 
    } 

    public function execute(LoginCommand $command): UserModel 
    { 
        $email = new UserEmail($command->getEmail()); 
        $user = $this->getUserByEmailPort->getByEmail($email); 

        // Validar si el usuario existe y si la contraseña coincide
        if ($user === null || !$user->password()->verifyPlain($command->getPassword())) { 
            throw InvalidUserCredentialsException::becauseCredentialsAreInvalid(); 
        } 

        // Validar si el usuario está activo
        if ($user->status() !== UserStatusEnum::ACTIVE) { 
            throw InvalidUserCredentialsException::becauseUserIsNotActive(); 
        } 

        return $user; 
    } 
}