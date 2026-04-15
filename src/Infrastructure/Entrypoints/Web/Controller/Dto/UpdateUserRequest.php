<?php

class UpdateUserRequest
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $status;

    public function __construct($id, $name, $email, $password, $role, $status)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }
}