<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateGastoCommand.php';
require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';
interface CreateGastoUseCase
{
    public function execute(CreateGastoCommand $command): GastoModel;
}