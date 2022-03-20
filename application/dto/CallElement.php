<?php

namespace dto;

use DateTime;
use external\output\Country;
use external\output\InformationOfIp;

class CallElement
{
    private int $customer_id;

    private int $duration;

    private string $time_day_of_call;

    private string $dialed_phone_number;

    private string $ip;

    private Country $country;

    public function __construct(
        int $customer_id,
        int $duration,
        string $time_day_of_call,
        string $dialed_phone_number,
        string $ip,
        Country $country
    )
    {
        $this->customer_id = $customer_id;
        $this->duration = $duration;
        $this->setTimeDayOfCall($time_day_of_call);
        $this->dialed_phone_number = $dialed_phone_number;
        $this->ip = $ip;
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    /**
     * @return string
     */
    public function getTimeDayOfCall(): string
    {
        return $this->time_day_of_call;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
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
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    private function setTimeDayOfCall(string $time_day_of_call): void
    {
        $this->time_day_of_call = (new DateTime($time_day_of_call))->format('d.m.Y H:i');
    }
}