<?php

class Gasto
{
    private GastoIdValueObject $id;
    private GastoFechaValueObject $fecha;
    private GastoValorValueObject $valor;
    private GastoLugarValueObject $lugar;
    private GastoCategoryEnum $categoria;
    private GastoDescriptionValueObject $descripcion;
    private GastoImagenValueObject $evidencia;
    private UserIdValueObject $usuarioId; 

    public function __construct(
        GastoIdValueObject $id,
        GastoFechaValueObject $fecha,
        GastoValorValueObject $valor,
        GastoLugarValueObject $lugar,
        GastoCategoryEnum $categoria,
        GastoDescriptionValueObject $descripcion,
        GastoImagenValueObject $evidencia,
        UserIdValueObject $usuarioId
    ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->valor = $valor;
        $this->lugar = $lugar;
        $this->categoria = $categoria;
        $this->descripcion = $descripcion;
        $this->evidencia = $evidencia;
        $this->usuarioId = $usuarioId;
    }

    // Métodos para obtener la información (Getters)
    public function getId(): GastoIdValueObject { return $this->id; }
    public function getUsuarioId(): UserIdValueObject { return $this->usuarioId; }
    public function getResumen(): string 
    {
        return "Factura de " . $this->lugar->getValue() . " por valor de " . $this->valor->getValorTotal();
    }
}