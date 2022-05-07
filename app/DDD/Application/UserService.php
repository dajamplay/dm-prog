<?php


namespace App\Application;


use App\Domain\UserRepositoryInterface;
use App\Domain\UserServiceInterface;

class UserService implements UserServiceInterface
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }
}