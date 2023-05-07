<?php

declare(strict_types=1);

namespace App\Services;

abstract class Request
{
    public function __construct(protected string $baseUrl)
    {}

    abstract public function send(array $params = []);

    protected function url(string $resource = null): string
    {
        return "{$this->baseUrl}{$resource}";
    }
}
