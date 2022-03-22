<?php

namespace dto;

use DateTime;

class CallElement
{
    private int $customer_id;

    private int $duration;

    private string $time_day_of_call;

    private string $dialed_phone_number;

    private string $ip;

    private string $continent;

    private string $dialedContinent;

    /**
     * CallElement constructor.
     * @param int $customer_id
     * @param int $duration
     * @param string $time_day_of_call
     * @param string $dialed_phone_number
     * @param string $ip
     * @param string $continent
     * @param string $dialedContinent
     */
    public function __construct(int $customer_id, int $duration, string $time_day_of_call, string $dialed_phone_number, string $ip, string $continent, string $dialedContinent)
    {
        $this->customer_id = $customer_id;
        $this->duration = $duration;
        $this->setTimeDayOfCall($time_day_of_call);
        $this->dialed_phone_number = $dialed_phone_number;
        $this->ip = $ip;
        $this->continent = $continent;
        $this->dialedContinent = $dialedContinent;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @return string|void
     */
    public function getTimeDayOfCall(): string
    {
        return $this->time_day_of_call;
    }

    /**
     * @return string
     */
    public function getDialedPhoneNumber(): string
    {
        return $this->dialed_phone_number;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getContinent(): string
    {
        return $this->continent;
    }

    /**
     * @return string
     */
    public function getDialedContinent(): string
    {
        return $this->dialedContinent;
    }

    /**
     * @return string
     */




    private function setTimeDayOfCall(string $time_day_of_call): void
    {
        $this->time_day_of_call = (new DateTime($time_day_of_call))->format('d.m.Y H:i');
    }
}