<?php

declare(strict_types=1);

require_once realpath(__DIR__ . '/../../..') . '/Domain/Models/GastosModel.php';

interface DeleteGastoPort
{
    /**
     * Este puerto no devolvera nada (void), 
     * solo da la orden de eliminar por ID.
     */
    public function delete(GastoId $id): void;
}