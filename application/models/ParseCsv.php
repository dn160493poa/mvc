<?php


namespace models;

use dto\CallElement;
use dto\ContainerOfCalls;
use exceptions\BadRequestException;
use external\IpStackExternalService;
use internal\PhoneCodeInternalService;

class ParseCsv
{
    private const REGEX_OF_TIME = '/^20\d{2}-(0[0-9]|1[0-9])-(0[1-9]|1[0-9]|2[0-9]|3[01])\s{1}(0[0-9]|1[0-9]|2[0-3]):(0[0-9]|[0-5][0-9]:(0[0-9]|[0-5][0-9]))$/';

    private PhoneCodeInternalService $phone_code_internal_service;

    private IpStackExternalService $ip_stack_external_service;

    public function __construct()
    {
        $this->ip_stack_external_service = new IpStackExternalService();

        $this->phone_code_internal_service = new PhoneCodeInternalService();
    }

    private function parseCsvAsArray($path): array
    {
        return array_map('str_getcsv', file($path));
    }

    public function createContainerOfCalls($path): ContainerOfCalls
    {
        $container_of_calls = new ContainerOfCalls();

        $csv_input_data = ParseCsv::parseCsvAsArray($path);

        foreach ($csv_input_data as $key => $call_data) {
            $this->validateCsvRowOrException($call_data);

            $ip = (string)$call_data[4];

            $call_element = new CallElement(
                (int)$call_data[0],
                (int)$call_data[2],
                (string)$call_data[1],
                (string)$call_data[3],
                $ip,
                (string)$this->ip_stack_external_service->findByIp($ip),
                (string)$this->phone_code_internal_service->findByDialedPhone($call_data[3])
            );

            $container_of_calls->push($call_element);

            unset($csv_input_data[$key]);
        }

        return $container_of_calls;
    }

    private function validateCsvRowOrException(array $call_data): void
    {
        if (!is_numeric($call_data[0])) {
            throw new BadRequestException('Customer id is not numeric', 422);
        }

        if (!preg_match(self::REGEX_OF_TIME, $call_data[1])) {
            throw new BadRequestException('Call date is invalid', 422);
        }

        if (!is_numeric($call_data[2])) {
            throw new BadRequestException('Duration is required and must be numeric', 422);
        }

        if (!is_numeric($call_data[3])) {
            throw new BadRequestException('dialed_phone_number is required', 422);
        }
        if (!filter_var($call_data[4], FILTER_VALIDATE_IP)) {
            throw new BadRequestException('IP is required', 422);
        }
    }
}