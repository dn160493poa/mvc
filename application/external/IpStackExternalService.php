<?php

namespace external;

use exceptions\BadResponseException;
use external\output\Country;

class IpStackExternalService
{
    private const BASE_URL = 'http://api.ipstack.com';

    private const API_KEY = '0d0c2a27212bc3be9b5529b24f5e0d17';

    private const NEED_KEYS_IN_RESPONSE = ['country_code', 'country_name'];

    public function findByIp(string $ip): Country
    {
//        $ch = $this->makeCurlRequest($ip);
//        $result = curl_exec($ch);
//        $decode_result = json_decode($result, true);
        $decode_result = ['country_name' => 'Germany', 'country_code' => 'DE'];

        $this->validateResponseOrException($decode_result);

        return new Country(
            $decode_result['country_name'],
            $decode_result['country_code']
        );
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