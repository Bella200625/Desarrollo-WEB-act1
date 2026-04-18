<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateGastoCommand.php';
require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';

interface UpdateGastoUseCase
{
    public function execute(UpdateGastoCommand $command): GastoModel;
}