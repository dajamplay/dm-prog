<?php


namespace App\Domain;


class User
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}