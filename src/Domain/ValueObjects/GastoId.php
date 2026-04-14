<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoIdException.php';
class GastoId
{
    private string $value;

    public function __construct(string $value) {
        if (empty(trim($value))) {
            throw InvalidGastoIdException::becauseValueIsEmpty();
        }
        $this->value = $value;
    }

    public function value() { 
        return $this->value; 
    }

    public function equals(GastoId $other) { 
        return $this->value === $other->value(); 
    }

    public function __toString() { 
        return $this->value; 
    }
}