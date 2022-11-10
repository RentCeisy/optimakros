<?php

namespace Test;

use App\App;
use App\Exceptions\FileNotExistsException;
use App\Services\Handler\TreeHandler;
use App\Services\Reader\CSVReader;
use App\Services\Writer\JsonWriter;
use PHPUnit\Framework\TestCase;

class HandlerTest extends TestCase
{
    /**
     * @throws FileNotExistsException
     * @throws \Exception
     */
    public function testConvertToTree()
    {
        $app = new App();
        $app->setFile('input.csv')
            ->setReader(new CSVReader())
            ->setHandler(new TreeHandler())
            ->setWriter(new JsonWriter());
        $app->run();
        $result = file('result.json');
        $checkFile = file('output.json');
        $this->assertEquals($result, $checkFile);
    }
}