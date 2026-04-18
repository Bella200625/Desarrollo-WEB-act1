<?php
declare(strict_types=1);



/* Definimos la base de la carpeta 'src' para no perdernos con los puntos
$basePath = dirname(__DIR__, 4); 

// Requerir DTOs de Web (están en la misma carpeta que este archivo, subiendo un nivel)
require_once __DIR__ . '/../Dto/CreateGastoWebRequest.php';
require_once __DIR__ . '/../Dto/UpdateGastoWebRequest.php';
require_once __DIR__ . '/../Dto/GastoResponse.php';

// Requerir Commands/Queries de Aplicación (Usando la base segura)
require_once $basePath . '/Application/Services/Dto/Commands/CreateGastoCommand.php';
require_once $basePath . '/Application/Services/Dto/Commands/UpdateGastoCommand.php';
require_once $basePath . '/Application/Services/Dto/Commands/DeleteGastoCommand.php';
require_once $basePath . '/Application/Services/Dto/Queries/GetGastoByIdQuery.php';

// Requerir el Modelo del Dominio
require_once $basePath . '/Domain/Models/GastosModel.php'; */
final class GastoWebMapper
{
    /**
     * Convierte la petición de la web a un Comando de creación
     */
    public function fromCreateRequestToCommand(CreateGastoWebRequest $request): CreateGastoCommand
    {
        return new CreateGastoCommand(
            $request->getId(),
            $request->getFecha(),
            $request->getTipoServicio(),
            $request->getMontoSinIva(),
            $request->getLugar(),
            $request->getDescripcion()
        );
    }

    /**
     * Convierte la petición de la web a un Comando de actualización
     */
    public function fromUpdateRequestToCommand(UpdateGastoWebRequest $request): UpdateGastoCommand
    {
        return new UpdateGastoCommand(
            $request->getId(),
            $request->getFecha(),
            $request->getTipoServicio(),
            $request->getMontoSinIva(),
            $request->getLugar(),
            $request->getDescripcion()
        );
    }

    /**
     * Convierte un ID de la URL a un Query de consulta
     */
    public function fromIdToGetByIdQuery(string $id): GetGastoByIdQuery
    {
        return new GetGastoByIdQuery($id);
    }

    /**
     * Convierte un ID de la URL a un Comando de eliminación
     */
    public function fromIdToDeleteCommand(string $id): DeleteGastoCommand
    {
        return new DeleteGastoCommand($id);
    }

    /**
     * Convierte el modelo del dominio a una respuesta para la web
     */
    public function fromModelToResponse(GastoModel $model): GastoResponse
{
    // Obtenemos el monto base
    $montoSinIva = $model->montoSinIva()->value();
    
    // Calculamos aquí mismo para asegurar que NO salga vacío
    $ivaCalculado = $montoSinIva * 0.19; 
    $totalCalculado = $montoSinIva + $ivaCalculado;

    return new GastoResponse(
        $model->id()->value(),
        $model->fecha()->value(),
        $model->tipoServicio(),
        (float)$montoSinIva,
        (float)$ivaCalculado,
        (float)$totalCalculado,
        $model->lugar()->value(),
        $model->descripcion()->value()
    );
}

    /**
     * Convierte una lista de modelos a una lista de respuestas
     * @param GastoModel[] $models
     * @return GastoResponse[]
     */
    public function fromModelsToResponses(array $models): array
    {
        $responses = array();
        foreach ($models as $model) {
            $responses[] = $this->fromModelToResponse($model);
        }
        return $responses;
    }
}