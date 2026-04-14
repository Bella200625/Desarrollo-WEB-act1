<?php
require_once __DIR__ . '/../Exceptions/InvalidUserPasswordException.php';
class UserPassword
{
    private $value;

    public function __construct($value)
    {
        $normalized = trim((string) $value);

        if ($normalized === '') {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }

        if (strlen($normalized) < 8) {
            throw InvalidUserPasswordException::becauseLengthIsTooShort(8);
        }

        $this->value = $normalized;
    }

    public static function fromPlainText(string $value): self 
    { 
        return new self($value); 
    }

    public function value() { return $this->value; }
    public function equals(UserPassword $other) { return $this->value === $other->value(); }
    public function __toString() { return (string) $this->value; }
}