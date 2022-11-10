<?php

namespace App\Services\Reader;

class CSVReader implements Reader
{
    private $result;
    private $fileName;

    public function setFile(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function read(): void
    {
        $data = file($this->fileName);
        array_shift($data);
        foreach ($data as $row) {
            $this->result[] = str_getcsv($row, ';');
        }
    }

    public function getResult(): array
    {
        return $this->result;
    }
}