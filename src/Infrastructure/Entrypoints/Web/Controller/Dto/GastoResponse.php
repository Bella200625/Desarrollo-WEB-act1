<?php

declare(strict_types=1);

final class GastoResponse
{
    private string $id;
    private string $fecha;
    private string $tipoServicio;
    private float $montoSinIva;
    private float $iva;
    private float $montoTotal;
    private string $lugar;
    private string $descripcion;

    public function __construct(
        string $id,
        string $fecha,
        string $tipoServicio,
        float $montoSinIva,
        float $iva,
        float $montoTotal,
        string $lugar,
        string $descripcion
    ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->tipoServicio = $tipoServicio;
        $this->montoSinIva = $montoSinIva;
        $this->iva = $iva;
        $this->montoTotal = $montoTotal;
        $this->lugar = $lugar;
        $this->descripcion = $descripcion;
    }

    public function getId(): string { return $this->id; }
    public function getFecha(): string { return $this->fecha; }
    public function getTipoServicio(): string { return $this->tipoServicio; }
    public function getMontoSinIva(): float { return $this->montoSinIva; }
    public function getIva(): float { return $this->iva; }
    public function getMontoTotal(): float { return $this->montoTotal; }
    public function getLugar(): string { return $this->lugar; }
    public function getDescripcion(): string { return $this->descripcion; }

    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'fecha' => $this->fecha,
            'tipo_servicio' => $this->tipoServicio,
            'monto_sin_iva' => $this->montoSinIva,
            'iva' => $this->iva,
            'monto_total' => $this->montoTotal,
            'lugar' => $this->lugar,
            'descripcion' => $this->descripcion,
        );
    }
}