<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllUsersQuery.php'; 
require_once __DIR__ . '/../../../Domain/Models/GastoModel.php';

interface GetAllGastosUseCase
{
    /** @return GastoModel[] */
    public function execute(GetAllGastosQuery $query): array;
}