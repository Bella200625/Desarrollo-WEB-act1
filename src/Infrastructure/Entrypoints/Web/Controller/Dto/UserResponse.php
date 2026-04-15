<?php

class UserResponse
{
    public $id;
    public $name;
    public $email;
    public $role;
    public $status;

    public function __construct($id, $name, $email, $role, $status)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->status = $status;
    }
}