<?php

/**
 * Functie voor het loggen van fouten die ontstaan in een try-catch blok
 * De volgende zaken worden gelogd
 * *******************************
 * - Errormessage van de fout
 * - Datum en tijd wanneer de fout is opgetreden
 * - Naam van het bestand waar de fout is opgetreden
 * - Regelnummer waar de fout is ontstaan
 * - Method waarin de fout is opgetreden
 * - ip-adres van de veroorzaker van de fout
 */


function logger($line, $method, $file, $error)
{
    /**
     * De error uit de code
     */
    $error = "De error is: " . $error . "\t";

    /**
     * De tijd en datum waarop de error heeft plaatsgevonden
     */
    date_default_timezone_set('Europe/Amsterdam');
    $dateTime = 'Datum/tijd: ' . date('d-m-Y H:i:s', time()) . "\t";

    /**
     * Het IP-adres van degene die de fout heeft veroorzaakt
     */
    $remote_ip = 'Remote IP-adres: ' . $_SERVER['REMOTE_ADDR'] . "\t";

    /**
     * Bestandsnaam van het bestand waar de error is opgetreden
     */
    $filename = "Bestandsnaam: " . $file . "\t";
    
    /**
     * Methodnaam waar de fout is opgetreden
     */
    $methodname = 'Methodnaam: ' . $method . "\t";

    /**
     * Regelnummer van de fout
     */
    $lineNumber = 'Regelnummer: ' . $line . "\t";

    /**
     * Regel met alle bovenstaande informatie
     */
    $content = $dateTime . $remote_ip . $error . $filename . $methodname . $lineNumber . "\r";

    /**
     * Pad naar het logbestand
     */
    $pathToLogFile = APPROOT . '/logs/log.txt';

    /**
     * Als het logbestand nog niet bestaat dan wordt het bestand gemaakt en wordt er 
     * een kopje boven aan het bestand geplaatst
     */
    if (!file_exists($pathToLogFile)) {
        file_put_contents($pathToLogFile, "Non functional Log\r++++++++++++++++++\r");
    }

    /**
     * Voeg de errorinformatie toe aan een logbestand
     */
    file_put_contents($pathToLogFile, $content, FILE_APPEND);

}