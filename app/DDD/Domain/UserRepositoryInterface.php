<?php

namespace App\Domain;

interface UserRepositoryInterface
{
    /** @return User[]  */
    public function getAll(): array;

    /**
     * @param int $id
     * @return User
     */
    public function getById(int $id): User;
}