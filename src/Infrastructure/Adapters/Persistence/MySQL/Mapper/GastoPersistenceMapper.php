<?php
declare(strict_types=1);
/*
require_once __DIR__ . '/../Dto/GastoPersistenceDto.php';
require_once __DIR__ . '/../Entity/GastoEntity.php';
require_once realpath(__DIR__ . '/../../../../..') . '/Domain/Models/GastosModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/GastoId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/GastoFecha.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/GastoAmount.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/GastoLugar.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/GastoDescription.php';*/

final class GastoPersistenceMapper
{
    public function fromModelToDto(GastoModel $gasto): GastoPersistenceDto
    {
        return new GastoPersistenceDto(
            $gasto->id()->value(),
            $gasto->fecha()->value(),
            $gasto->tipoServicio(),
            $gasto->montoSinIva()->value(),
            $gasto->iva(),
            $gasto->montoTotal(),
            $gasto->lugar()->value(),
            $gasto->descripcion()->value()
        );
    }

    public function fromRowToEntity(array $row): GastoEntity
    {
        return new GastoEntity(
            (string)$row['id'],
            (string)$row['fecha'],
            (string)$row['tipo_servicio'],
            (float)$row['monto_sin_iva'],
            (float)$row['iva'],
            (float)$row['monto_total'],
            (string)$row['lugar'],
            (string)$row['descripcion'],
            isset($row['created_at']) ? (string)$row['created_at'] : null,
            isset($row['updated_at']) ? (string)$row['updated_at'] : null
        );
    }

    public function fromEntityToModel(GastoEntity $entity): GastoModel
    {
        return new GastoModel(
            new GastoId($entity->id()),
            new GastoFecha($entity->fecha()),
            $entity->tipoServicio(),
            new GastoAmount($entity->montoSinIva()),
            new GastoLugar($entity->lugar()),
            new GastoDescription($entity->descripcion())
        );
    }

    public function fromRowToModel(array $row): GastoModel
    {
        return $this->fromEntityToModel($this->fromRowToEntity($row));
    }

    public function fromRowsToModels(array $rows): array
    {
        $models = [];
        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }
        return $models;
    }
}