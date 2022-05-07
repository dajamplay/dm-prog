<?php

namespace App\Application;

use App\Domain\UserServiceInterface;

class UserController
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function select()
    {
        return $this->userService->getAll();
    }

    public function create()
    {
        $userRequest = $request->getPost();
        $userForm = new UserForm(...$userRequest);
        if ($userForm->validate()) {
            return $this->userService->create($userForm->getDTO());
        }
    }
}