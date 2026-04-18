<?php

declare(strict_types=1);

require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';

interface SaveGastoPort
{
    public function save(GastoModel $gasto): GastoModel;
}