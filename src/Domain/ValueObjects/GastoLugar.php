<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoLugarException.php';

class GastoLugar {
    private string $value;

    public function __construct(string $value) {
        if (empty(trim($value))) {
            throw InvalidGastoLugarException::becauseValueIsEmpty();
        }

        if (strlen($value) < 3) {
            throw InvalidGastoLugarException::becauseLengthIsTooShort(3);
        }
        $this->value = $value;
    }

    public function value() { 
        return $this->value; 
    }

    public function equals(GastoLugar $other) { 
        return $this->value === $other->value(); 
    }

    public function __toString() { 
        return $this->value; 
    }
}