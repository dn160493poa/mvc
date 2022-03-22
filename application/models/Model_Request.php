<?php


namespace models;

use exceptions\BadRequestException;
use exceptions\MethodNotAllowed;

class Model_Request
{
    public function validateOrException(string $request_method, array $file): void
    {
        if (!$this->isPostRequest($request_method)) {
            throw new MethodNotAllowed('Method is not allowed', 405);
        }

        if (!$this->isExistsKeyInRequest($file)) {
            throw new BadRequestException('Unprocessable Entity', 422);
        }

        if (!$this->isCsvFileExtension($file)) {
            throw new BadRequestException('File is not CSV', 406);
        }
    }

    private function isCsvFileExtension(array $file): bool
    {
        $file_name_cmps = explode(".", $file['file']['name']);
        $file_extension = strtolower(end($file_name_cmps));

        return in_array($file_extension, ['csv']);
    }

    private function isExistsKeyInRequest(array $file): bool
    {
        return isset($file['file']);
    }

    private function isPostRequest(string $method): bool
    {
        return $method === 'POST';
    }
}