<?php

declare(strict_types=1);

// Importamos todos los Value Objects y Enums
require_once __DIR__ . '/../ValueObjects/UserId.php';
require_once __DIR__ . '/../ValueObjects/UserName.php';
require_once __DIR__ . '/../ValueObjects/UserEmail.php';
require_once __DIR__ . '/../ValueObjects/UserPassword.php';
require_once __DIR__ . '/../Enums/UserRoleEnum.php';
require_once __DIR__ . '/../Enums/UserStatusEnum.php';

final class UserModel
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;
    private string $role;
    private string $status;

    // EL CONSTRUCTOR para reconstruir un usuario 
    public function __construct(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        string $role,
        string $status
    ) {
        // usamos los Enums para validar que el texto sea un rol/estado real
        UserRoleEnum::ensureIsValid($role);
        UserStatusEnum::ensureIsValid($status);

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    // metodo create Para usuarios NUEVOS
    public static function create(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        string $role
    ): self {
        return new self(
            $id,
            $name,
            $email,
            $password,
            $role,
            UserStatusEnum::PENDING // siempre nace pending
        );
    }

    // Getters (para sacar la información)
    public function id(): UserId { return $this->id; }
    public function name(): UserName { return $this->name; }
    public function email(): UserEmail { return $this->email; }
    public function role(): string { return $this->role; }
    public function status(): string { return $this->status; }
    
    //metodo cambio
    public function activate(): self {
        return new self($this->id, $this->name, $this->email, $this->password, $this->role, UserStatusEnum::ACTIVE);
    }

    public function toArray(): array {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'email' => $this->email->value(),
            'role' => $this->role,
            'status' => $this->status
        ];
    }
}