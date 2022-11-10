<?php

namespace App\Services\Reader;

interface Reader
{
    public function setFile(string $fileName): void;

    public function read(): void;

    public function getResult(): array;
}