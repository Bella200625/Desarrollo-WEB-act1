<?php

declare(strict_types=1);

// Importamos los DTOs (Commands y Queries) específicos de Gastos
require_once __DIR__ . '/../Dto/Commands/CreateGastoCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateGastoCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteGastoCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetGastoByIdQuery.php';

// Importamos el Corazón (Domain) de Gastos
require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/GastoId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/GastoFecha.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/GastoAmount.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/GastoLugar.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/GastoDescription.php';

final class GastoApplicationMapper
{
    public static function fromCreateCommandToModel(CreateGastoCommand $command): GastoModel
    {
        // Al crear este modelo, el constructor de GastoModel calculara el IVA automáticamente
        return new GastoModel(
            new GastoId($command->getId()),
            new GastoFecha($command->getFecha()),
            $command->getTipoServicio(),
            new GastoAmount($command->getMontoSinIva()),
            new GastoLugar($command->getLugar()),
            new GastoDescription($command->getDescripcion())
        );
    }

    public static function fromUpdateCommandToModel(UpdateGastoCommand $command): GastoModel
    {
        return new GastoModel(
            new GastoId($command->getId()),
            new GastoFecha($command->getFecha()),
            $command->getTipoServicio(),
            new GastoAmount($command->getMontoSinIva()),
            new GastoLugar($command->getLugar()),
            new GastoDescription($command->getDescripcion())
        );
    }

    public static function fromGetGastoByIdQueryToGastoId(GetGastoByIdQuery $query): GastoId
    {
        return new GastoId($query->getId());
    }

    public static function fromDeleteCommandToGastoId(DeleteGastoCommand $command): GastoId
    {
        return new GastoId($command->getId());
    }

    /** * Convierte un modelo a un array simple para la vista
     * @return array<string, mixed> 
     */
    public static function fromModelToArray(GastoModel $gasto): array
    {
        return array(
            'id'             => $gasto->id()->value(),
            'fecha'          => $gasto->fecha()->value(),
            'tipo_servicio'  => $gasto->tipoServicio(),
            'monto_sin_iva'  => $gasto->montoSinIva()->value(),
            'iva'            => $gasto->iva(),
            'monto_total'    => $gasto->montoTotal(),
            'lugar'          => $gasto->lugar()->value(),
            'descripcion'    => $gasto->descripcion()->value()
        );
    }

    /** * Convierte una lista de modelos a arrays
     * @param GastoModel[] $gastos 
     * @return array<int, array<string, mixed>> 
     */
    public static function fromModelsToArray(array $gastos): array
    {
        $result = array();

        foreach ($gastos as $gasto) {
            $result[] = self::fromModelToArray($gasto);
        }

        return $result;
    }
}