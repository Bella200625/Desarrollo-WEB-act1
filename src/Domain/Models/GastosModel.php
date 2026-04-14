<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/GastoId.php';
require_once __DIR__ . '/../ValueObjects/GastoFecha.php';
require_once __DIR__ . '/../ValueObjects/GastoAmount.php';
require_once __DIR__ . '/../ValueObjects/GastoLugar.php';
require_once __DIR__ . '/../ValueObjects/GastoDescription.php';
require_once __DIR__ . '/../Enums/GastoServicioTipoEnum.php';

final class GastoModel
{
    private GastoId $id;
    private GastoFecha $fecha;
    private string $tipoServicio;
    private GastoAmount $montoSinIva;
    private float $iva;
    private float $montoTotal;
    private GastoLugar $lugar;
    private GastoDescription $descripcion;

    public function __construct(
        GastoId $id,
        GastoFecha $fecha,
        string $tipoServicio,
        GastoAmount $montoSinIva,
        GastoLugar $lugar,
        GastoDescription $descripcion
    ) {
        GastoServicioTipoEnum::ensureIsValid($tipoServicio);

        $this->id = $id;
        $this->fecha = $fecha;
        $this->tipoServicio = $tipoServicio;
        $this->montoSinIva = $montoSinIva;
        $this->lugar = $lugar;
        $this->descripcion = $descripcion;

        $this->iva = $montoSinIva->value() * 0.19;
        $this->montoTotal = $montoSinIva->value() + $this->iva;
    }

    public static function create(
        GastoId $id,
        GastoFecha $fecha,
        string $tipoServicio,
        GastoAmount $montoSinIva,
        GastoLugar $lugar,
        GastoDescription $descripcion
    ): self {
        return new self(
            $id,
            $fecha,
            $tipoServicio,
            $montoSinIva,
            $lugar,
            $descripcion
        );
    }

    // --- GETTERS ---

    public function id(): GastoId 
    { 
        return $this->id; 
    }

    public function fecha(): GastoFecha 
    { 
        return $this->fecha; 
    }

    public function tipoServicio(): string 
    { 
        return $this->tipoServicio; 
    }

    public function montoSinIva(): GastoAmount 
    { 
        return $this->montoSinIva; 
    }

    public function iva(): float 
    { 
        return $this->iva; 
    }

    public function montoTotal(): float 
    { 
        return $this->montoTotal; 
    }

    public function lugar(): GastoLugar 
    { 
        return $this->lugar; 
    }

    public function descripcion(): GastoDescription 
    { 
        return $this->descripcion; 
    }

    // --- MÉTODOS DE CAMBIO (INMUTABILIDAD) ---

    public function changeAmount(GastoAmount $montoSinIva): self 
    {
        return new self(
            $this->id,
            $this->fecha,
            $this->tipoServicio,
            $montoSinIva,
            $this->lugar,
            $this->descripcion
        );
    }

    public function changeLugar(GastoLugar $lugar): self 
    {
        return new self(
            $this->id,
            $this->fecha,
            $this->tipoServicio,
            $this->montoSinIva,
            $lugar,
            $this->descripcion
        );
    }

    public function changeTipoServicio(string $tipoServicio): self 
    {
        return new self(
            $this->id,
            $this->fecha,
            $tipoServicio,
            $this->montoSinIva,
            $this->lugar,
            $this->descripcion
        );
    }

    public function toArray(): array 
    {
        return [
            'id' => $this->id->value(),
            'fecha' => $this->fecha->value(),
            'tipo_servicio' => $this->tipoServicio,
            'monto_sin_iva' => $this->montoSinIva->value(),
            'iva' => $this->iva,
            'monto_total' => $this->montoTotal,
            'lugar' => $this->lugar->value(),
            'descripcion' => $this->descripcion->value()
        ];
    }
}