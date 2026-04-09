<?php
require_once __DIR__ . '/../Exceptions/InvalidGastoLocationException.php';
class GastoLugarValueObject
{
    private $value;

    public function __construct($value) {
        $normalized = trim((string)$value);
        if ($normalized === '') {
            throw InvalidGastoLocationException::becauseValueIsEmpty();
        }
        $this->value = $normalized;
    }

    public function value() { return $this->value; }
    public function __toString() { return (string)$this->value; }
}