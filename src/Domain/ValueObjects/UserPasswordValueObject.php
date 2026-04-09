<?php

class UserPasswordValueObject
{
    private string $password;

    public function __construct(string $password)
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException("La clave debe tener al menos 8 caracteres por seguridad.");
        }
        $this->password = $password;
    }

    public function getValue(): string { return $this->password; }
}