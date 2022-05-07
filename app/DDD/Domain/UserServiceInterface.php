<?php


namespace App\Domain;


use App\Domain\UserRepositoryInterface;

interface UserServiceInterface
{
    public function getAll();
}
