<?php

namespace internal;

class PhoneCodeInternalService
{
    private const DB_PATH = './csv_db/geo_names.csv';

    private const CONTINENTS = array(
        'AF' => 'Africa',
        'AS' => 'Asia',
        'EU' => 'Europe',
        'NA' => 'North America',
        'OC' => 'Oceania',
        'SA' => 'South America',
        'AN' => 'Antarctica'
    );

    public function findByDialedPhone(string $phoneNumber): string
    {
        $phone_code = $this->getDialedPhoneCode($phoneNumber);

        $geo_names = $this->parseCsvAsArray();

        $continent_code = $this->getContinentCode($geo_names, $phone_code);

        $continent_name = $this->getContinentName($continent_code);

        return $continent_name;
    }

    private function getContinentName($continent_code) : string
    {
        return self::CONTINENTS[$continent_code];
    }

    private function getContinentCode(array $geo_names, $phone_code) : string
    {
        $continent_code = '';
        foreach ($geo_names as $county_data){
            if($county_data[12] === $phone_code){
                $continent_code = $county_data[8];
                break;
            }
        }
        return $continent_code;
    }

    private function getDialedPhoneCode(string $phone) : string
    {
        return substr($phone, 0, strlen($phone)-9);
    }

    private function parseCsvAsArray(): array
    {
        return array_map('str_getcsv', file(self::DB_PATH));
    }


}