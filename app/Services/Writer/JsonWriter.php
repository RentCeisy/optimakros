<?php

namespace App\Services\Writer;

class JsonWriter implements Writer
{
    private $data;

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function write(): void
    {
        $fileName = $argv[2] ?? 'result';
        $json = json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($fileName . '.json', $json);
    }
}