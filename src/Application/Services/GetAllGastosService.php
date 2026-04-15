<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllGastosUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllGastosPort.php';

final class GetAllGastosService implements GetAllGastosUseCase
{
    private GetAllGastosPort $getAllGastosPort;

    public function __construct(GetAllGastosPort $getAllGastosPort)
    {
        $this->getAllGastosPort = $getAllGastosPort;
    }

    public function execute(GetAllGastosQuery $query): array
    {
        return $this->getAllGastosPort->getAll();
    }
}