<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveGastoPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateGastoPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetGastoByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllGastosPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteGastoPort.php';
require_once __DIR__ . '/../Mapper/GastoPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/GastoModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/GastoId.php';

final class GastoRepositoryMySQL implements 
    SaveGastoPort, UpdateGastoPort, GetGastoByIdPort, GetAllGastosPort, DeleteGastoPort
{
    private PDO $pdo;
    private GastoPersistenceMapper $mapper;

    public function __construct(PDO $pdo, GastoPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(GastoModel $gasto): GastoModel
    {
        $dto = $this->mapper->fromModelToDto($gasto);
        $sql = 'INSERT INTO gastos (id, fecha, tipo_servicio, monto_sin_iva, iva, monto_total, lugar, descripcion, created_at, updated_at) 
                VALUES (:id, :fecha, :tipo_servicio, :monto_sin_iva, :iva, :monto_total, :lugar, :descripcion, NOW(), NOW())';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $dto->id(),
            ':fecha' => $dto->fecha(),
            ':tipo_servicio' => $dto->tipoServicio(),
            ':monto_sin_iva' => $dto->montoSinIva(),
            ':iva' => $dto->iva(),
            ':monto_total' => $dto->montoTotal(),
            ':lugar' => $dto->lugar(),
            ':descripcion' => $dto->descripcion(),
        ]);

        return $this->getById(new GastoId($dto->id()));
    }

    public function update(GastoModel $gasto): GastoModel
    {
        $dto = $this->mapper->fromModelToDto($gasto);
        $sql = 'UPDATE gastos SET fecha = :fecha, tipo_servicio = :tipo_servicio, monto_sin_iva = :monto_sin_iva, iva = :iva, 
                monto_total = :monto_total, lugar = :lugar, descripcion = :descripcion, updated_at = NOW() WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $dto->id(),
            ':fecha' => $dto->fecha(),
            ':tipo_servicio' => $dto->tipoServicio(),
            ':monto_sin_iva' => $dto->montoSinIva(),
            ':iva' => $dto->iva(),
            ':monto_total' => $dto->montoTotal(),
            ':lugar' => $dto->lugar(),
            ':descripcion' => $dto->descripcion(),
        ]);

        return $this->getById(new GastoId($dto->id()));
    }

    public function getById(GastoId $id): ?GastoModel
    {
        $sql = 'SELECT * FROM gastos WHERE id = :id LIMIT 1';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id' => $id->value()]);
        $row = $statement->fetch();
        return ($row === false) ? null : $this->mapper->fromRowToModel($row);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM gastos ORDER BY fecha DESC';
        $statement = $this->pdo->query($sql);
        return $this->mapper->fromRowsToModels($statement->fetchAll());
    }

    public function delete(GastoId $id): void
    {
        $sql = 'DELETE FROM gastos WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id' => $id->value()]);
    }
}