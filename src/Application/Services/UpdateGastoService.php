<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateGastoUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveGastoPort.php';
require_once __DIR__ . '/../Ports/Out/GetGastoByIdPort.php';
require_once __DIR__ . '/Mappers/GastoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/GastoNotFoundException.php';
require_once __DIR__ . '/../../Domain/Models/GastoModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoId.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoFecha.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoAmount.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoLugar.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoDescription.php';

final class UpdateGastoService implements UpdateGastoUseCase
{
    private SaveGastoPort $saveGastoPort;
    private GetGastoByIdPort $getGastoByIdPort;

    public function __construct(
        SaveGastoPort $saveGastoPort,
        GetGastoByIdPort $getGastoByIdPort
    ) {
        $this->saveGastoPort = $saveGastoPort;
        $this->getGastoByIdPort = $getGastoByIdPort;
    }

    public function execute(UpdateGastoCommand $command): GastoModel
    {
        $gastoId = new GastoId($command->getId());
        $existingGasto = $this->getGastoByIdPort->getById($gastoId);

        // Validamos que el gasto exista antes de intentar actualizarlo
        if ($existingGasto === null) {
            throw GastoNotFoundException::becauseIdWasNotFound($gastoId->value());
        }

        // Usamos el Mapper para crear el nuevo modelo con los datos del comando
        $gastoToUpdate = GastoApplicationMapper::fromUpdateCommandToModel($command);

        return $this->saveGastoPort->save($gastoToUpdate);
    }
}