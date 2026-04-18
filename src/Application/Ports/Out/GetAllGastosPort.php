<?php

declare(strict_types=1);

require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';

interface GetAllGastosPort
{
    /** @return GastoModel[] */
    public function getAll(): array;
}