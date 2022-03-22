<?php


namespace dto;

class Customer
{
    private int $id;

    private string $continent;

    /**
     * Customer constructor.
     * @param int $id
     * @param string $continent
     */
    public function __construct(int $id, string $continent)
    {
        $this->id = $id;
        $this->continent = $continent;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContinent(): string
    {
        return $this->continent;
    }




}