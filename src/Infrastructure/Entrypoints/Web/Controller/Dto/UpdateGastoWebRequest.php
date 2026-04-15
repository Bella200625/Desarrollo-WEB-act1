<?php

declare(strict_types=1);

final class UpdateGastoWebRequest
{
    private string $id;
    private string $fecha;
    private string $tipoServicio;
    private float $montoSinIva;
    private string $lugar;
    private string $descripcion;

    public function __construct(
        string $id,
        string $fecha,
        string $tipoServicio,
        float $montoSinIva,
        string $lugar,
        string $descripcion
    ) {
        $this->id = trim($id);
        $this->fecha = trim($fecha);
        $this->tipoServicio = trim($tipoServicio);
        $this->montoSinIva = $montoSinIva;
        $this->lugar = trim($lugar);
        $this->descripcion = trim($descripcion);
    }

    public function getId(): string { return $this->id; }
    public function getFecha(): string { return $this->fecha; }
    public function getTipoServicio(): string { return $this->tipoServicio; }
    public function getMontoSinIva(): float { return $this->montoSinIva; }
    public function getLugar(): string { return $this->lugar; }
    public function getDescripcion(): string { return $this->descripcion; }
}