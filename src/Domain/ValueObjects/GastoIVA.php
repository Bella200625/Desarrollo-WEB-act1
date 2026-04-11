<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoIVAException.php';

class GastoIVA {
    private float $value;

    public function __construct(float $value) {
        if ($value < 0 || $value > 100) {
            throw InvalidGastoIVAException::becauseIVAIsInvalid($value);
        }
        $this->value = $value;
    }

    public function value(): float { 
        return $this->value; 
    }

    public function equals(GastoIVA $other): bool { 
        return $this->value === $other->value(); 
    }

    public function __toString(): string { 
        return (string) $this->value; 
    }
}