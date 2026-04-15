<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteGastoUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteGastoPort.php';
require_once __DIR__ . '/../Ports/Out/GetGastoByIdPort.php';
require_once __DIR__ . '/Mappers/GastoApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/GastoNotFoundException.php';

final class DeleteGastoService implements DeleteGastoUseCase
{
    private DeleteGastoPort $deleteGastoPort;
    private GetGastoByIdPort $getGastoByIdPort;

    public function __construct(
        DeleteGastoPort $deleteGastoPort,
        GetGastoByIdPort $getGastoByIdPort
    ) {
        $this->deleteGastoPort = $deleteGastoPort;
        $this->getGastoByIdPort = $getGastoByIdPort;
    }

    public function execute(DeleteGastoCommand $command): void
    {
        $gastoId = GastoApplicationMapper::fromDeleteCommandToGastoId($command);
        $existingGasto = $this->getGastoByIdPort->getById($gastoId);

        if ($existingGasto === null) {
            throw GastoNotFoundException::becauseIdWasNotFound($gastoId->value());
        }

        $this->deleteGastoPort->delete($gastoId);
    }
}