<?php

class InvalidGastoIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('El ID del gasto no puede estar vacío.');
    }
}