<?php

class GastoImagenValueObject
{
    private string $path;

    public function __construct(string $path)
    {
        // El nombre del archivo no esté vacío
        if (empty($path)) {
            throw new InvalidArgumentException("La ruta de la imagen de la factura es obligatoria.");
        }

        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}