<?php

namespace App;

use App\Exceptions\FileNotExistsException;
use App\Services\Handler\Handler;
use App\Services\Reader\Reader;
use App\Services\Writer\Writer;

class App
{
    private $reader;
    private $writer;
    private $handler;
    private $fileName;

    public function setReader(Reader $reader): self
    {
        $this->reader = $reader;
        return $this;
    }

    public function setWriter(Writer $writer): self
    {
        $this->writer = $writer;
        return $this;
    }

    public function setHandler(Handler $handler): self
    {
        $this->handler = $handler;
        return $this;
    }

    public function setFile(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @throws FileNotExistsException
     */
    public function run(): void
    {
        if (!file_exists($this->fileName)) {
            throw new FileNotExistsException('File not exists');
        }

        $this->reader->setFile($this->fileName);
        $this->reader->read();
        $this->handler->setData($this->reader->getResult());
        $this->handler->handle();
        $this->writer->setData($this->handler->getResult());
        $this->writer->write();
    }
}