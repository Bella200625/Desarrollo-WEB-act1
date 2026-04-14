<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoAmountException.php';
class GastoAmount
{
    private float $value;

    public function __construct($value) {
        if ($value === null || $value === '') {
            throw InvalidGastoAmountException::becauseValueIsEmpty();
        }

        if (!is_numeric($value)) {
            throw InvalidGastoAmountException::becauseValueIsNotNumeric($value);
        }

        $valueP = (float)$value;

        if ($valueP < 0) {
            throw InvalidGastoAmountException::becauseAmountIsNegative($value);
        }

        $this->value = $valueP;
    }

    public function value(): float { return $this->value; }

    public function equals(GastoAmount $other) { 
        return $this->value === $other->value(); 
    }
    public function __toString() { return (string)$this->value; }
}