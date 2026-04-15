<?php

class UserWebMapper
{
    // De lo que llega de la web (Request) -> Al comando de creación
    public function toCreateCommand(CreateUserRequest $request)
    {
        return new CreateUserCommand(
            uniqid(),
            $request->name,
            $request->email,
            $request->password,
            $request->role
        );
    }

    // De lo que llega de la web (Request) -> Al comando de actualización
    public function toUpdateCommand(UpdateUserRequest $request)
    {
        return new UpdateUserCommand(
            $request->id,
            $request->name,
            $request->email,
            $request->password,
            $request->role,
            $request->status
        );
    }

    // De lo que sale del sistema (Modelo) -> A lo que ve el usuario (Response)
    public function toResponse($userModel)
    {
        return new UserResponse(
            $userModel->id()->value(),
            $userModel->name()->value(),
            $userModel->email()->value(),
            $userModel->role(),
            $userModel->status()
        );
    }
}