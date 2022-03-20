<?php

namespace external\output;

class InformationOfIp
{
    private string $country_name;

    private string $country_code;

    /**
     * @param string $country_name
     * @param string $country_code
     */
    public function __construct(string $country_name, string $country_code)
    {
        $this->country_name = $country_name;
        $this->country_code = $country_code;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->country_name;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->country_code;
    }
}