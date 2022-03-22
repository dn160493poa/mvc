<?php

namespace external;

use exceptions\BadResponseException;

class IpStackExternalService
{
    private const BASE_URL = 'http://api.ipstack.com';

    private const API_KEY = '239de47fa9e4477adb8c7aafad362b24';

    private const NEED_KEYS_IN_RESPONSE = ['continent_name'];

    public function findByIp(string $ip): string
    {
        //$ch = $this->makeCurlRequest($ip);
        //$result = curl_exec($ch);
        //$decode_result = json_decode($result, true);

        //$this->validateResponseOrException($decode_result);

        //$answer = $decode_result["continent_name"];

//        $answer = ['Asia', 'Africa', 'Europe', 'North America', 'Oceania', 'South America', 'Antarctica']
//            [array_rand(['Asia', 'Africa', 'Europe', 'North America', 'Oceania', 'South America', 'Antarctica'], 1)];
        $answer = 'Europe';

        return $answer;
    }

    private function validateResponseOrException(array $decode_result): void
    {
        foreach (self::NEED_KEYS_IN_RESPONSE as $response_key) {
            if (!key_exists($response_key, $decode_result)) {
                throw new BadResponseException("Key {$response_key} is required");
            }
        }
    }

    private function makeCurlRequest(string $ip)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, join('?', [$this->getUrl($ip), 'access_key=' . self::API_KEY]));
        curl_setopt($ch, CURLOPT_SSH_COMPRESSION, true);

        return $ch;
    }

    private function getUrl(string $ip): string
    {
        return join('/', [self::BASE_URL, $ip]);
    }
}