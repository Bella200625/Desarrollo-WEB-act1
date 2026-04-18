<?php

declare(strict_types=1);

require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/GastoId.php';

interface GetGastoByIdPort
{
    public function getById(GastoId $id): ?GastoModel;
}