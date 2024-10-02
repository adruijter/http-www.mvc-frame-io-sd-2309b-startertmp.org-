<?php

function logError($errorMessage, $file, $line, $method)
{
    $logFile = APPROOT. '/logs/log.txt';

    $dateTime = date("Y-m-d H:i:s");

    $logMessage = "[$dateTime] Error in $file at line $line, method: $method - $errorMessage" . PHP_EOL;;

    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

function errorHandler($errno, $errstr, $errfile, $errline) 
{
    // De method waar de fout plaatsvond
    $method = debug_backtrace()[1]['function'] ?? 'global scope';

    // Fout loggen
    logError($errstr, $errfile, $errline, $method);
}