<?php

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findById(UserIdValueObject $id): ?User;
    public function findByUserName(UserNameValueObject $userName): ?User;
}
