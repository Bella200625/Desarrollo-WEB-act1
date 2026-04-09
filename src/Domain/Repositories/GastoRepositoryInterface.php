<?php

interface GastoRepositoryInterface
{
    public function save(Gasto $gasto): void;
    public function findById(GastoIdValueObject $id): ?Gasto;
    public function findAllByUserId(UserIdValueObject $userId): array;
    public function delete(GastoIdValueObject $id): void;
}