<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoFechaException.php';
class GastoFecha
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw InvalidGastoFechaException::becauseValueIsEmpty();
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            throw InvalidGastoFechaException::becauseFormatIsInvalid($value);
        }

        $this->value = $value;
    }

    public function value() { 
        return $this->value; 
    }

    public function equals(GastoFecha $other) { 
        return $this->value === $other->value(); 
    }

    public function __toString() { 
        return (string) $this->value; 
    }
}