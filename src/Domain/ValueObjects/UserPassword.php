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



//METODOS QUE NO SE MENCIONARON EN LA GUIA DOS
    public static function fromPlainText(string $raw): self
    {
        // Forzamos la validación usando el constructor
        return new self(password_hash($raw, PASSWORD_BCRYPT));
    }

    //Carga un hash que ya existe en la base de datos.
    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function verifyPlain(string $pin): bool
    {
        return password_verify($pin, $this->value);
    }



    public function value() { return $this->value; }
    public function equals(UserPassword $other) { return $this->value === $other->value(); }
    public function __toString() { return (string) $this->value; }
}