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

function logger($fileName, $methodName, $lineNumber, $error) {
    /**
     * We gaan de tijd toevoegen waarop de error plaatsvond
     */
    date_default_timezone_set('Europe/Amsterdam');
    $time = "Datum/tijd: " . date('d-M-Y H:i:s', time()) . "\t";

    /**
     * De error uit de code
     */
    $error = "De error is: " . $error . "\t";

    /**
     * Het ip adres van degene die de error veroorzaakte
     */
    $ip  = "Remote IP Address: " . $_SERVER["REMOTE_ADDR"] . "\t";

    /**
     * Waar het de error plaatsgevonden
     */
    $placeOfError = "file: " . $fileName . " method: " . $methodName . " linenumber: " . $lineNumber . "\t";
    /**
     * we maken een logfile aan
     */
    $pathToLogfile = APPROOT . '/logs/nonfunctionallog.txt';
    
    /**
     * Check of er al een logfile bestaat, zo niet maak hem dan.
     */
    if (!file_exists($pathToLogfile)) {
        file_put_contents($pathToLogfile, "Non Functional Log\r");
    }

    /**
     * Vraag de content op van het logfile
     */
    $contents = file_get_contents($pathToLogfile);

    /**
     * Voeg de nieuwe error toe aan het logfile
     */
    $contents .= $time . $ip . $error . $placeOfError . "\r";

    /**
     * Schrijf de nieuwe content naar de logfile
     */
    file_put_contents($pathToLogfile, $contents);
} 

?>