<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoLugarException.php';

class GastoLugar {
    private string $value;

    public function __construct(string $value) {
        if (empty(trim($value))) {
            throw InvalidGastoLugarException::becauseValueIsEmpty();
        }
        $this->value = $value;
    }

    public function value(): string { 
        return $this->value; 
    }

    public function equals(GastoLugar $other): bool { 
        return $this->value === $other->value(); 
    }

    public function __toString(): string { 
        return $this->value; 
    }
}