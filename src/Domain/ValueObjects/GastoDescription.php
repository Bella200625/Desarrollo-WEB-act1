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
    public function value() { return $this->value; }
    public function equals(GastoDescription $other) { 
        return $this->value === $other->value();
         }
    public function __toString() { return (string) $this->value; }
}
