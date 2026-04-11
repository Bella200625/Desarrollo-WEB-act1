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

    public function value(): string { 
        return $this->value; 
    }

    public function equals(GastoId $other): bool { 
        return $this->value === $other->value(); 
    }

    public function __toString(): string { 
        return $this->value; 
    }
}