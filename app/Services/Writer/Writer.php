<?php

namespace App\Services\Writer;

interface Writer
{
    public function setData(array $data): void;

    public function write(): void;
}