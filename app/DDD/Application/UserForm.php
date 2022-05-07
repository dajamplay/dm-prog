<?php

namespace App\Application;

class UserForm
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function validate()
    {
        return true;
    }

    public function getDTO()
    {
        $userDTO = new UserDTO();
        $userDTO->id = $this->id;
        $userDTO->name = $this->name;
    }
}