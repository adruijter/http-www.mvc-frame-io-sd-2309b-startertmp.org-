<?php

class CustomException extends Exception
{
    private $originalException;

    public function __construct($message, Exception $originalException)
    {
        parent::__construct($message);
        $this->originalException = $originalException;
        echo $message . " | " . $this->originalException->getMessage();
    }

    function getOriginalException()
    {
        return $this->getOriginalException;
    }
}