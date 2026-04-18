<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateGastoUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveGastoPort.php';
require_once __DIR__ . '/../Ports/Out/GetGastoByIdPort.php';
require_once __DIR__ . '/Mappers/GastoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/GastoNotFoundException.php';
require_once realpath(__DIR__ . '/../..') . '/Domain/Models/GastosModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoId.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoFecha.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoAmount.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoLugar.php';
require_once __DIR__ . '/../../Domain/ValueObjects/GastoDescription.php';

final class UpdateGastoService implements UpdateGastoUseCase
{
    private UpdateGastoPort $updateGastoPort; 
    private GetGastoByIdPort $getGastoByIdPort;

    public function __construct(
        UpdateGastoPort $updateGastoPort, 
        GetGastoByIdPort $getGastoByIdPort
    ) {
        $this->updateGastoPort = $updateGastoPort;
        $this->getGastoByIdPort = $getGastoByIdPort;
    }

    public function execute(UpdateGastoCommand $command): GastoModel
    {
        $gastoId = new GastoId($command->getId());
        $existingGasto = $this->getGastoByIdPort->getById($gastoId);

        if ($existingGasto === null) {
            throw GastoNotFoundException::becauseIdWasNotFound($gastoId->value());
        }

        $gastoToUpdate = GastoApplicationMapper::fromUpdateCommandToModel($command);

        return $this->updateGastoPort->update($gastoToUpdate);
    }
}
