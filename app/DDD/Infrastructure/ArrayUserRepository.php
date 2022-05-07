<?php


namespace App\Infrastructure;


use App\Domain\User;
use App\Domain\UserRepositoryInterface;

class ArrayUserRepository implements UserRepositoryInterface
{

    private array $users = [
        '1' => [
            'id' => 1,
            'name' => 'Dimon'
        ],
        '2' => [
            'id' => 2,
            'name' => 'Maks'
        ]
    ];

    public function getAll(): array
    {
        return array_map( function($user) {
            return new User($user['id'], $user['name']);
        }, $this->users  );
    }

    public function getById(int $id): User
    {
        return new User($this->users[$id]['id'], $this->users[$id]['name']);
    }
}