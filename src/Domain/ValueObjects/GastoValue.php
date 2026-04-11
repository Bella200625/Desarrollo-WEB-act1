<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoValueException.php';
class GastoValue
{
    private float $value;

    public function __construct($value) {
        if ($value === null || $value === '') {
            throw InvalidGastoValueException::becauseValueIsEmpty();
        }

        if (!is_numeric($value)) {
            throw InvalidGastoValueException::becauseValueIsNotNumeric($value);
        }

        $valueP = (float)$value;

        if ($valueP < 0) {
            throw InvalidGastoValueException::becauseValueIsNegative($value);
        }

        $this->value = $valueP;
    }

    public function value(): float { return $this->value; }

    public function equals(GastoValue $other): bool { 
        return $this->value === $other->value(); 
    }
    public function __toString(): string { return (string)$this->value; }
}