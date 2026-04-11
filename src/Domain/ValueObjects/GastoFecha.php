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

        if (!strtotime($value)) {
            throw InvalidGastoFechaException::becauseFormatIsInvalid($value);
        }

        $this->value = $value;
    }

    public function value(): string { 
        return $this->value; 
    }

    public function equals(GastoFecha $other): bool { 
        return $this->value === $other->value(); 
    }

    public function __toString(): string { 
        return $this->value; 
    }
}