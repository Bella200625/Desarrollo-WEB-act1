<?php
require_once __DIR__ . '/../Exceptions/InvalidUserEmailException.php';

class UserEmail
{
    private $value;

    public function __construct($value)
    {
        $normalized = trim((string) $value);

        if ($normalized === '') {
            throw InvalidUserEmailException::becauseValueIsEmpty();
        }

        if (!filter_var($normalized, FILTER_VALIDATE_EMAIL)) {
            throw InvalidUserEmailException::becauseFormatIsInvalid($normalized);
        }

        // normalizar a minusculas
        $this->value = strtolower($normalized);
    }

    public function value() { return $this->value; }
    public function equals(UserEmail $other) { return $this->value === $other->value(); }
    public function __toString() { return (string) $this->value; }
}