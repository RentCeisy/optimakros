<?php

namespace App\Exceptions;

class FileNotExistsException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message, 422);
    }
}