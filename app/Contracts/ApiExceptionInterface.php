<?php

namespace App\Contracts;

interface ApiExceptionInterface
{
    public function getStatusCode(): int;
    public function response(): array;
}
