<?php

class UserController
{
    private $mapper;
    private $createService;
    private $updateService;
    // Aquí irían los otros servicios como search o delete

    public function __construct(UserWebMapper $mapper, $createService, $updateService)
    {
        $this->mapper = $mapper;
        $this->createService = $createService;
        $this->updateService = $updateService;
    }

    public function create($request)
    {
        // Convertimos lo que llega de la web a un Comando
        $command = $this->mapper->toCreateCommand($request);

        // Ejecutamos la lógica de negocio
        $this->createService->execute($command);

        // Redireccionamos o mostramos mensaje de éxito
        Flash::set('success', '¡Usuario creado correctamente!');
        header('Location: /users');
    }
}