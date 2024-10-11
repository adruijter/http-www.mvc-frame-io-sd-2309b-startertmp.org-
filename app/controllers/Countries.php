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

            $data = CountryValidator::validateCountryInputFields($data);
           
            /**
             * Wanneer alle Error-keys uit $data leeg zijn kunnen we wegschrijven naar de database
             */
            if ($data['isViewValid']) {
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

    public function update($countryId)
    {

        /**
         * De coalesce operator checked of de opgehaalde resultaten uit de database null zijn. Als dat zo is 
         * wordt de header refresh ingeschakeld. Anders worden de resultaten in $result gezet
         */
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

             // var_dump($_POST);
             $data['country'] = trim($_POST['country']);
             $data['capitalCity'] = trim($_POST['capitalCity']);
             $data['continent'] = trim($_POST['continent']);
             $data['population'] = trim($_POST['population']);
             $data['zipcode'] = trim($_POST['zipcode']);
          
             $data = CountryValidator::validateCountryInputFields($data);

             /**
             * Wanneer alle Error-keys uit $data leeg zijn kunnen we wegschrijven naar de database
             */
            if ($data['isViewValid']) {
                /**
                 * Roep de createCountry methode aan van het countryModel object waardoor
                 * de gegevens in de database worden opgeslagen
                 */
                $result = $this->countryModel->updateCountry($_POST);

                if (is_null($result)) {
                    $data['messageVisibility'] = 'flex';
                    $data['message'] = 'Het updaten is niet gelukt';
                    $data['messageColor'] = FORM_DANGER_COLOR;
                } else {
                    $data['messageVisibility'] = 'flex';
                    $data['message'] = TEST;
                    $data['messageColor'] = FORM_SUCCESS_COLOR;
                }                

                /**
                 * Na het opslaan van de formulier wordt de gebruiker teruggeleid naar de index-pagina
                 */
                header("Refresh:3; url=" . URLROOT . "/countries/index");
            } else {
                $data['messageVisibility'] = 'flex';
                $data['message'] = FORM_DANGER;
                $data['messageColor'] = FORM_DANGER_COLOR;
            }           
        }

        $this->view('countries/update', $data);
    }

    public function delete($countryId)
    {
       /**
        * Probeer het record met het opgegeven land-ID te verwijderen uit de database.
        * @param int $countryId Het ID van het land dat moet worden verwijderd.
        * @return mixed $result Het resultaat van de verwijderingsoperatie, of null bij mislukking.
        */
        $result = $this->countryModel->deleteCountry($countryId);

       /**
        * Stel de waarden voor de data-array samen om aan de view te worden doorgegeven.
        * Dit omvat een titel en een bericht dat feedback geeft over de verwijderingsoperatie.
        * De messageColor bepaalt de stijl van het bericht (groen voor succes, rood voor fout).
        * De messageVisibility is standaard op 'flex' ingesteld, wat zorgt voor zichtbaarheid van het bericht.
        */
        $data = [
            'title' => 'Landen van de wereld',
            'message' => is_null($result) ? 'Er is een fout opgetreden, het record is niet verwijderd' : 'Het record is succesvol verwijderd.',
            'messageColor' => is_null($result) ? 'danger' : 'success',
            'messageVisibility' => 'flex' // Het bericht wordt altijd zichtbaar getoond, ongeacht het resultaat.
        ];

       /**
        * Haal alle landen op uit de database om deze opnieuw weer te geven na de verwijderingsactie.
        * @return array|null $countries De lijst met landen, of null als er iets misgaat.
        */
        $countries = $this->countryModel->getCountries();

       /**
        * Controleer of het ophalen van landen succesvol was.
        * Als er geen landen zijn opgehaald (null), wordt een foutbericht weergegeven en
        * wordt de gebruiker omgeleid naar de homepage na 3 seconden.
        * Als de landen succesvol zijn opgehaald, worden ze toegevoegd aan de data-array.
        */
        if (is_null($countries)) {
            $data['message'] = "Er is een fout opgetreden, er kunnen geen landen worden getoond";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['dataRows'] = null; // Geen data om weer te geven

            // Omleiding naar de homepage na 3 seconden in geval van fout
            header('Refresh:3; ' . URLROOT . '/homepages/index');
        } else {
            $data['dataRows'] = $countries; // Toevoegen van de opgehaalde landen aan de data-array
        }

       /**
        * Nadat de bewerking is voltooid, wordt de gebruiker omgeleid naar de overzichtspagina
        * van landen (countries/index) na een korte vertraging van 3 seconden.
        */
        header("Refresh:3; " . URLROOT . "/countries/index");

       /**
        * Laad de view 'countries/index' en geef de data door die is samengesteld,
        * inclusief eventuele berichten en de bijgewerkte lijst met landen.
        */
        $this->view('countries/index', $data);
    }

    
}