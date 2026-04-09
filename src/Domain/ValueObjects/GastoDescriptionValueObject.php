<?php

class GastoDescriptionValueObject
{
    private string $description;

    public function __construct(string $description)
    {
        if (strlen($description) > 255) {
            throw new InvalidArgumentException("La descripcion no puede superar los 255 caracteres.");
        }
        $this->description = $description;
    }

    public function getValue(): string { return $this->description; }
}
