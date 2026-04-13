<?php

declare(strict_types=1);

// --- IMPORTAMOS NUESTRAS PIEZAS (Value Objects y Enums) ---
require_once __DIR__ . '/../ValueObjects/GastoId.php';
require_once __DIR__ . '/../ValueObjects/GastoValue.php';
require_once __DIR__ . '/../ValueObjects/GastoDescription.php';
require_once __DIR__ . '/../ValueObjects/GastoIva.php';
require_once __DIR__ . '/../ValueObjects/GastoFecha.php';
require_once __DIR__ . '/../ValueObjects/GastoLugar.php';
require_once __DIR__ . '/../Enums/GastoCategoryEnum.php';

final class GastoModel
{
    // Atributos definidos con nuestras piezas
    private GastoId $id;
    private GastoValue $value;
    private GastoDescription $description;
    private GastoIva $iva;
    private GastoFecha $fecha;
    private GastoLugar $lugar;
    private string $category;

    // CONSTRUCTOR (Para reconstruir un gasto existente)
    public function __construct(
        GastoId $id,
        GastoValue $value,
        GastoDescription $description,
        GastoIva $iva,
        GastoFecha $fecha,
        GastoLugar $lugar,
        string $category
    ) {
        // El Enum valida que el texto de la categoría sea real
        GastoCategoryEnum::ensureIsValid($category);

        $this->id = $id;
        $this->value = $value;
        $this->description = $description;
        $this->iva = $iva;
        $this->fecha = $fecha;
        $this->lugar = $lugar;
        $this->category = $category;
    }

    // MÉTODO CREATE para cuando nace un gasto
    public static function create(
        GastoId $id,
        GastoValue $value,
        GastoDescription $description,
        GastoIva $iva,
        GastoFecha $fecha,
        GastoLugar $lugar,
        string $category
    ): self {
        return new self($id, $value, $description, $iva, $fecha, $lugar, $category);
    }

    //GETTERS 
    public function id(): GastoId { return $this->id; }
    public function value(): GastoValue { return $this->value; }
    public function description(): GastoDescription { return $this->description; }
    public function iva(): GastoIva { return $this->iva; }
    public function fecha(): GastoFecha { return $this->fecha; }
    public function lugar(): GastoLugar { return $this->lugar; }
    public function category(): string { return $this->category; }




    // MÉTODOS DE CAMBIO 


    public function changeValue(GastoValue $value): self {
        return new self(
            $this->id, 
            $value, 
            $this->description, 
            $this->iva, 
            $this->fecha, 
            $this->lugar, 
            $this->category);
    }

    public function changeDescription(GastoDescription $description): self {
        return new self(
            $this->id, 
            $this->value, 
            $description, 
            $this->iva, 
            $this->fecha, 
            $this->lugar, 
            $this->category);
    }

    public function changeCategory(string $category): self {
        return new self(
            $this->id, 
            $this->value, 
            $this->description, 
            $this->iva, 
            $this->fecha, 
            $this->lugar, 
            $category);
    }

    // TO ARRAY (Para pasar los datos a la base de datos o simplemente mostrarlos)
    public function toArray(): array {
        return [
            'id' => $this->id->value(),
            'value' => $this->value->value(),
            'description' => $this->description->value(),
            'iva' => $this->iva->value(),
            'fecha' => $this->fecha->value(),
            'lugar' => $this->lugar->value(),
            'category' => $this->category
        ];
    }
}