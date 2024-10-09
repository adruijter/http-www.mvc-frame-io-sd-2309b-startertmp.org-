<?php

class Countries extends BaseController
{
    private $countryModel;

    public function __construct()
    {
        $this->countryModel = $this->model('Country');
    }

    public function index()
    {
        $data = [
            'title' => 'Landen van de Wereld',
            'dataRows' => '',
            'message' => '',
            'messageColor' => '',
            'messageVisibility' => 'none'
        ];

        $countries = $this->countryModel->getCountries();

        if (is_null($countries)) {
            $data['message'] = "Er is een fout opgetreden";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['dataRows'] = NULL;

            header('Refresh:3; ' . URLROOT . '/homepages/index');
        } else {
            $data['dataRows'] = $countries;
        }

        $this->view('countries/index', $data);
    }

    /**
     * Creates a new country.
     *
     * This method is responsible for rendering the create view and passing the necessary data to it.
     *
     * @return void
     */
    public function create()
    {
        $data = [
            'title' => 'Voeg een nieuw land toe',
            'message' => '',
            'messageColor' => '',
            'messageVisibility' => 'none',
            'country' => '',
            'capitalCity' => '',
            'continent' => '',
            'population' => '',
            'zipcode' => '',
            'countryError' => '',
            'capitalCityError' => '',
            'continentError' => '',
            'populationError' => '',
            'zipcodeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /**
             * Maak het $_POST-array schoon van ongewenste tekens en tags
             */
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // var_dump($_POST);
            $data['country'] = trim($_POST['country']);
            $data['capitalCity'] = trim($_POST['capitalCity']);
            $data['continent'] = trim($_POST['continent']);
            $data['population'] = trim($_POST['population']);
            $data['zipcode'] = trim($_POST['zipcode']);
         
            $data = $this->validateCreateForm($data);

           
            /**
             * Wanneer alle Error-keys uit $data leeg zijn kunnen we wegschrijven naar de database
             */
            if ( 
                empty($data['countryError']) 
                && empty($data['capitalCityError'])
                && empty($data['continentError'])
                && empty($data['populationError'])
                && empty($data['zipcodeError'])
            ) {
                /**
                 * Roep de createCountry methode aan van het countryModel object waardoor
                 * de gegevens in de database worden opgeslagen
                 */
                $result = $this->countryModel->createCountry($_POST);

                if (is_null($result)) {
                    $data['message'] = "Er is een fout opgetreden, opslaan is nu niet mogelijk";
                    $data['messageColor'] = "danger";
                    $data['messageVisibility'] = "flex";       
                    $data['dataRows'] = NULL;
        
                    header('Refresh:3; ' . URLROOT . '/countries/create');
                } else {
                    $data['messageVisibility'] = '';
                    $data['message'] = FORM_SUCCESS;
                    $data['messageColor'] = FORM_SUCCESS_COLOR;
    
                    /**
                     * Na het opslaan van de formulier wordt de gebruiker teruggeleid naar de index-pagina
                     */
                    header("Refresh:3; url=" . URLROOT . "/countries/index");

                }
            } else {
                $data['messageVisibility'] = '';
                $data['message'] = FORM_DANGER;
                $data['messageColor'] = FORM_DANGER_COLOR;
            }
        }
        $this->view('countries/create', $data);
    }

    public function validateCreateForm($data)
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

        // var_dump(CONTINENTS);
        // var_dump($data['continent']);
        if (!in_array($data['continent'], CONTINENTS)) {
            $data['continentError'] = 'Dit werelddeel bestaat niet, vervang deze door één uit het selectmenu';
        }


        echo preg_match('/^\d{4}[A-Z]{2}$/', $data['zipcode']);
        if (!preg_match('/^\d{4}[A-Z]{2}$/', $data['zipcode'])) {
            $data['zipcodeError'] = 'De ingevoerde postcode heeft geen geldig formaat, probeer het opnieuw';
        }



        return $data;
    }

    public function update($countryId)
    {

        $result = $this->countryModel->getCountry($countryId) ?? header('Refresh:3; ' . URLROOT . '/countries/index');
        
        
        $data = [
            'title' => 'Wijzig Land',
            'message' => is_null($result) ? 'Er is een fout opgetreden, wijzigen is nu niet mogelijk' : '',
            'messageColor' => is_null($result) ? 'danger' : '',
            'messageVisibility' => is_null($result) ? 'flex': 'none',
            'buttonDisabled' => is_null($result) ? 'disabled' : '',
            'Id' => $result->Id ?? '-',
            'country' => $result->Name ?? '-',
            'capitalCity' => $result->CapitalCity ?? '-',
            'continent' => $result->Continent ?? '-',
            'population' => $result->Population ?? '-',
            'zipcode' => $result->Zipcode ?? '-',
            'countryError' => '',
            'capitalCityError' => '',
            'continentError' => '',
            'populationError' => '',
            'zipcodeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->countryModel->updateCountry($_POST);

             // var_dump($_POST);
             $data['country'] = trim($_POST['country']);
             $data['capitalCity'] = trim($_POST['capitalCity']);
             $data['continent'] = trim($_POST['continent']);
             $data['population'] = trim($_POST['population']);
             $data['zipcode'] = trim($_POST['zipcode']);
          
             $data = $this->validateCreateForm($data);

             /**
             * Wanneer alle Error-keys uit $data leeg zijn kunnen we wegschrijven naar de database
             */
            if ( 
                empty($data['countryError']) 
                && empty($data['capitalCityError'])
                && empty($data['continentError'])
                && empty($data['populationError'])
                && empty($data['zipcodeError'])
            ) {
                /**
                 * Roep de createCountry methode aan van het countryModel object waardoor
                 * de gegevens in de database worden opgeslagen
                 */
                $result = $this->countryModel->updateCountry($_POST);

                $data['messageVisibility'] = '';
                $data['message'] = TEST;
                $data['messageColor'] = FORM_SUCCESS_COLOR;

                /**
                 * Na het opslaan van de formulier wordt de gebruiker teruggeleid naar de index-pagina
                 */
                header("Refresh:3; url=" . URLROOT . "/countries/index");
            } else {
                $data['messageVisibility'] = '';
                $data['message'] = FORM_DANGER;
                $data['messageColor'] = FORM_DANGER_COLOR;
            }           
        }

        $this->view('countries/update', $data);
    }

    public function delete($countryId)
    {
       $result = $this->countryModel->deleteCountry($countryId);

       $data = [
           'message' => 'Het record is verwijderd. U wordt doorgestuurd naar de index-pagina.'
       ];

       header("Refresh:1; " . URLROOT . "/countries/index");

       $this->view('countries/delete', $data);
    }
}