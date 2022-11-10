<?php

use App\App;
use App\Exceptions\FileNotExistsException;
use App\Services\Handler\TreeHandler;
use App\Services\Reader\CSVReader;
use App\Services\Writer\JsonWriter;

require 'vendor/autoload.php';

$app = new App();
$fileInput = $argv[1] ?? 'input.csv';
$app->setFile($argv[1])
    ->setReader(new CSVReader())
    ->setHandler(new TreeHandler())
    ->setWriter(new JsonWriter());

try {
    $app->run();
} catch (FileNotExistsException $e) {
    print_r($e->getMessage());
    die();
}

