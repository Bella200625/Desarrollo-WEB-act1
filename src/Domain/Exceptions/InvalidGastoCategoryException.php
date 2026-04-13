<?php

class InvalidGastoCategoryException extends Exception
{
    public static function becauseValueIsInvalid($value)
    {
        return new self("La categoría '$value' no es válida. Por favor usa una de la lista de servicios públicos.");
    }
}
