<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoDescriptionException.php';

class GastoDescription {
    private string $value;
    public function __construct($value) {
        if (empty(trim($value))) { 
            throw InvalidGastoDescriptionException::becauseValueIsEmpty(); 
        }
        $this->value = $value;
    }
    public function value(): string { return $this->value; }
    public function equals(GastoDescription $other): bool { return $this->value === $other->value(); }
    public function __toString(): string { return $this->value; }
}
