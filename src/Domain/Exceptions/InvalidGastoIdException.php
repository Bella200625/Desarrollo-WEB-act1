<?php
class InvalidGastoIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('Error: El ID se generó vacío. Por favor, volver a intentar.');
    }
}