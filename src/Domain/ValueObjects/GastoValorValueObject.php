<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoValueException.php';
class GastoValorValueObject
{
    private $value;

    public function __construct($value) {
        if ($value === null || $value === '') {
            throw InvalidGastoValueException::becauseValueIsEmpty();
        }

        if ($value < 0) {
            throw InvalidGastoValueException::becauseValueIsNegative($value);
        }

        $this->value = $value;
    }

    public function value() { return $this->value; }
    public function __toString() { return (string)$this->value; }
}