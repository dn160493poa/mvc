<?php

use dto\CallElement;
use dto\ContainerOfCalls;
use exceptions\BaseException;
use exceptions\MethodNotAllowed;
use exceptions\BadRequestException;
use external\IpStackExternalService;

class Controller_Upload extends Controller
{
    private const REGEX_OF_TIME = '/^20\d{2}-(0[0-9]|1[0-9])-(0[1-9]|1[0-9]|2[0-9]|3[01])\s{1}(0[0-9]|1[0-9]|2[0-3]):(0[0-9]|[0-5][0-9]:(0[0-9]|[0-5][0-9]))$/';

    private IpStackExternalService $ip_stack_external_service;

    public function __construct()
    {
        parent::__construct();

        $this->ip_stack_external_service = new IpStackExternalService();
    }

    public function action_index()
    {
        try {
            $this->validateOrException();

            $container = $this->getContainerOfCalls();

            $this->view->generate('uploaded_view.php', 'template_view.php', [
                'container' => $this->getContainerOfCalls()
            ]);
        } catch (BaseException $unprocessable_entity_exception) {
            Route::ErrorPage($unprocessable_entity_exception->getCode());
        }
    }

    private function getContainerOfCalls(): ContainerOfCalls
    {
        $container_of_calls = new ContainerOfCalls();

        $csv_input_data = $this->parseCsvAsArray();

        foreach ($csv_input_data as $key => $call_data) {
            $this->validateCsvRowOrException($call_data);

            $ip = (string)$call_data[4];

            $call_element = new CallElement(
                (int)$call_data[0],
                (int)$call_data[2],
                (string)$call_data[1],
                (string)$call_data[3],
                $ip,
                $this->ip_stack_external_service->findByIp($ip)
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

    private function parseCsvAsArray(): array
    {
        return array_map('str_getcsv', file($_FILES['file']['tmp_name']));
    }

    private function validateOrException(): void
    {
        if (!$this->isPostRequest()) {
            throw new MethodNotAllowed('Method is not allowed', 405);
        }

        if (!$this->isExistsKeyInRequest()) {
            throw new BadRequestException('Unprocessable Entity', 422);
        }

        if (!$this->isCsvFileExtension()) {
            throw new BadRequestException('File is not CSV', 406);
        }
    }

    private function isCsvFileExtension(): bool
    {
        $file_name = $_FILES['file']['name'];

        $file_name_cmps = explode(".", $file_name);
        $file_extension = strtolower(end($file_name_cmps));

        return in_array($file_extension, ['csv']);
    }

    private function isExistsKeyInRequest(): bool
    {
        return isset($_FILES['file']);
    }

    private function isPostRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}