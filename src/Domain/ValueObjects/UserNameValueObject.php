<?php

class UserNameValueObject
{
    private string $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException("El nombre del usuario no puede estar vacio.");
        }
        $this->name = $name;
    }

    public function getValue(): string { return $this->name; }
}
