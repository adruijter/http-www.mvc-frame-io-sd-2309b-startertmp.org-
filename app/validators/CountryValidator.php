<?php

class CountryValidator
{
    public static function validateCountryInputFields($data)
    {
       /**
         *  Inspecteer of het veld country is ingevuld
         */
        if ( empty($data['country'])) {
            $data['countryError'] = 'Het is verplicht de naam van een land in te vullen!';
        }
        if ( empty($data['capitalCity'])) {
            $data['capitalCityError'] = 'Het is verplicht de naam van de hoofdstad in te vullen!';
        }
        if ( empty($data['continent'])) {
            $data['continentError'] = 'Het is verplicht de naam van het continent in te vullen!';
        }
        if ( empty($data['population'])) {
            $data['populationError'] = 'Het is verplicht het aantal inwoners van het land in te vullen!';
        }
        if ( !filter_var($data['population'], FILTER_VALIDATE_INT)) {
            $data['populationError'] = 'U kunt alleen positieve gehele getallen invoeren';
        }
        if ( 
            $data['population'] < 0
            || $data['population'] > 4294967295) {
            $data['populationError'] = 'U kunt alleen positieve getallen invoeren kleiner dan 4294967295';
        }

        if (!in_array($data['continent'], CONTINENTS)) {
            $data['continentError'] = 'Dit werelddeel bestaat niet, vervang deze door één uit het selectmenu';
        }


        echo preg_match('/^\d{4}[A-Z]{2}$/', $data['zipcode']);
        if (!preg_match('/^\d{4}[A-Z]{2}$/', $data['zipcode'])) {
            $data['zipcodeError'] = 'De ingevoerde postcode heeft geen geldig formaat, probeer het opnieuw';
        }

        if (
            empty($data['countryError']) 
            && empty($data['capitalCityError'])
            && empty($data['continentError'])
            && empty($data['populationError'])
            && empty($data['zipcodeError'])
        ) {
            $data['isViewValid'] = true;
        } else {
            $data['isViewValid'] = false;
        }
        return $data;
    }
}