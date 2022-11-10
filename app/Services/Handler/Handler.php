<?php

namespace App\Services\Handler;

interface Handler
{
    public function setData(array $data): void;

    public function handle(): void;

    public function getResult(): array;
}