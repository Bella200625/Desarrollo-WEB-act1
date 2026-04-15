<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/GastoId.php';

interface DeleteGastoPort
{
    /**
     * Este puerto no devolvera nada (void), 
     * solo da la orden de eliminar por ID.
     */
    public function delete(GastoId $id): void;
}