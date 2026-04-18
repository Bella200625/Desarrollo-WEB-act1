<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetGastoByIdQuery.php';
require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';
interface GetGastoByIdUseCase
{
    /**
     * Recibe la query con el ID y retorna el modelo 
     * con todos los datos del gasto encontrado.
     */
    public function execute(GetGastoByIdQuery $query): GastoModel;
}