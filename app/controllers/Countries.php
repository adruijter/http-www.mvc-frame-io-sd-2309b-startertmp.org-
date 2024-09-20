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
        $countries = $this->countryModel->getCountries();

        $dataRows = "";

        foreach ($countries as $country) {
            $dataRows .= "<tr>
                            <td>{$country->Name}</td>
                            <td>{$country->CapitalCity}</td>
                            <td>{$country->Continent}</td>
                            <td>" . number_format($country->Population, 0, ",", ".") . "</td>
                            <td>{$country->Zipcode}</td>
                            <td>
                                <a href='" . URLROOT . "/countries/update/{$country->Id}'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>
                            </td>
                            <td>
                                <a href='" . URLROOT . "/countries/delete/{$country->Id}'>
                                    <i class='bi bi-trash'></i>
                                </a>
                            </td>            
                        </tr>";
        }

        $data = [
            'title' => 'Landen van de Wereld',
            'dataRows' => $dataRows
        ];

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
            ) {
                /**
                 * Roep de createCountry methode aan van het countryModel object waardoor
                 * de gegevens in de database worden opgeslagen
                 */
                $result = $this->countryModel->createCountry($_POST);

                $data['messageVisibility'] = '';
                $data['message'] = FORM_SUCCESS;
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



        return $data;
    }

    public function update($countryId)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->countryModel->updateCountry($_POST);

            echo '<div class="alert alert-success" role="alert">
                    Het land is gewijzigd. U wordt doorgestuurd naar de index-pagina.
                </div>';
                
            header("Refresh:3; url=" . URLROOT . "/countries/index");
        }

        $result = $this->countryModel->getCountry($countryId);
        
        $data = [
            'title' => 'Wijzig land',
            'Id' => $result->Id,
            'country' => $result->Name,
            'capitalCity' => $result->CapitalCity,
            'continent' => $result->Continent,
            'population' => $result->Population,
            'zipcode' => $result->Zipcode
        ];

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