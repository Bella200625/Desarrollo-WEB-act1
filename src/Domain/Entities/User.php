<?php

class User
{
    private UserIdValueObject $id;
    private UserNameValueObject $nombre;
    private UserPasswordValueObject $password;
    private UserRoleEnum $rol;
    private UserStatusEnum $estado;

    public function __construct(
        UserIdValueObject $id,
        UserNameValueObject $nombre,
        UserPasswordValueObject $password,
        UserRoleEnum $rol,
        UserStatusEnum $estado
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->estado = $estado;
    }

    // Getters para acceder a la informacion
    public function getId(): UserIdValueObject { return $this->id; }
    public function getNombre(): UserNameValueObject { return $this->nombre; }
    public function getRol(): UserRoleEnum { return $this->rol; }
    public function getEstado(): UserStatusEnum { return $this->estado; }

    // Metodo para verificar si es administrador
    public function esAdmin(): bool
    {
        return $this->rol === UserRoleEnum::ADMIN;
    }
}