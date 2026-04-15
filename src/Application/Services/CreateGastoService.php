<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateGastoUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveGastoPort.php';
require_once __DIR__ . '/Mappers/GastoApplicationMapper.php';

final class CreateGastoService implements CreateGastoUseCase
{
    private SaveGastoPort $saveGastoPort;

    public function __construct(SaveGastoPort $saveGastoPort)
    {
        $this->saveGastoPort = $saveGastoPort;
    }

    public function execute(CreateGastoCommand $command): GastoModel
    {
        $gasto = GastoApplicationMapper::fromCreateCommandToModel($command);
        return $this->saveGastoPort->save($gasto);
    }
}