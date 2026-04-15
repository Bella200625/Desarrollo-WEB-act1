<?php
declare(strict_types=1);

final class GastoPersistenceDto
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
        $this->id = trim($id);
        $this->fecha = trim($fecha);
        $this->tipoServicio = trim($tipoServicio);
        $this->montoSinIva = $montoSinIva;
        $this->iva = $iva;
        $this->montoTotal = $montoTotal;
        $this->lugar = trim($lugar);
        $this->descripcion = trim($descripcion);
    }

    public function id(): string { return $this->id; }
    public function fecha(): string { return $this->fecha; }
    public function tipoServicio(): string { return $this->tipoServicio; }
    public function montoSinIva(): float { return $this->montoSinIva; }
    public function iva(): float { return $this->iva; }
    public function montoTotal(): float { return $this->montoTotal; }
    public function lugar(): string { return $this->lugar; }
    public function descripcion(): string { return $this->descripcion; }
}