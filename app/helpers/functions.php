<?php
// Functie om fouten te loggen
function logError($errorMessage, $file, $line, $method, $message) {
    echo $message;
    // Bestand waar de log in wordt opgeslagen
    $logFile = APPROOT . '/logs/log.txt';

    // Datum en tijd van het logmoment
    $dateTime = date('Y-m-d H:i:s');

    // Logbericht samenstellen
    $logMessage = "[$dateTime] Error in $file at line $line, method: $method - $errorMessage" . PHP_EOL;

    // Logbericht naar bestand schrijven
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

function errorHandler($errno, $errstr, $errfile, $errline, $message) {
    // De method waar de fout plaatsvond
    $method = debug_backtrace()[1]['function'] ?? 'global scope';

    // Fout loggen
    logError($errstr, $errfile, $errline, $method, $message);
}

?>