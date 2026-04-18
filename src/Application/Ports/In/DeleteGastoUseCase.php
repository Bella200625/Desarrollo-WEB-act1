<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteGastoCommand.php';
require_once 'C:/xampp/htdocs/Desarrollo-WEB-act1/src/Domain/Models/GastosModel.php';
interface DeleteGastoUseCase
{
    public function execute(DeleteGastoCommand $command): void;
}