<?php require_once APPROOT . '/views/includes/header.php'; ?>

    <div class="container">
        <div class="row mt-3" style="display:<?= $data['messageVisibility']; ?>">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="alert alert-<?= $data['messageColor']; ?>" role="alert">
                    <?= $data['message']; ?>
                </div>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6">
                <h3><?= $data['title']; ?></h3>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row mt-3">
            <div class="col-3">
            </div>
            <div class="col-6">
                <form action="<?= URLROOT; ?>/countries/update/<?= $data['Id']; ?>" method="post">
                    <div class="mb-3">
                        <label for="inputNameCountry" class="form-label">Land:</label>
                        <input value="<?= $data['country']; ?>" name="country" type="text" class="form-control" id="inputNameCountry" placeholder="Vul hier de naam van het land in">
                        <div class="errorForm"><?= $data['countryError']; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="inputNameCapitalCity" class="form-label">Hoofdstad:</label>
                        <input value="<?= $data['capitalCity']; ?>" name="capitalCity" type="text" class="form-control" id="inputNameCapitalCity" placeholder="Vul hier de naam van de hoofdstad in">
                        <div class="errorForm"><?= $data['capitalCityError']; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="inputNameContinent" class="form-label">Continent:</label>
                        <select name="continent" class="form-select" id="inputNameContinent" aria-label="Default select example">
                            <option selected>Vul hier de naam van het continent in</option>
                            <option <?= ($data['continent'] == 'Afrika') ? 'selected' : ''; ?> value="Afrika">Afrika</option>
                            <option <?= ($data['continent'] == 'Azi&euml;') ? 'selected' : ''; ?> value="Azi&euml;">Azië</option>
                            <option <?= ($data['continent'] == 'Europa') ? 'selected' : ''; ?> value="Europa">Europa</option>
                            <option <?= ($data['continent'] == 'Noord-Amerika') ? 'selected' : ''; ?> value="Noord-Amerika">Noord-Amerika</option>
                            <option <?= ($data['continent'] == 'Zuid-Amerika') ? 'selected' : ''; ?> value="Zuid-Amerika">Zuid-Amerika</option>
                            <option <?= ($data['continent'] == 'Antarctica') ? 'selected' : ''; ?> value="Antarctica">Antarctica</option>
                            <option <?= ($data['continent'] == 'Oceani&euml;') ? 'selected' : ''; ?> value="Oceani&euml;">Oceanië</option>
                        </select>
                        <div class="errorForm"><?= $data['continentError']; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="inputPopulation" class="form-label">Aantal inwoners:</label>
                        <input value="<?= $data['population']; ?>" name="population" type="text" class="form-control" id="inputPolulation" placeholder="Vul hier het aantal mensen in woonachtig in het land">
                        <div class="errorForm"><?= $data['populationError']; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="inputNameZipcode" class="form-label">Postcode:</label>
                        <input value="<?= $data['zipcode']; ?>" name="zipcode" type="text" class="form-control" id="inputNameZipcode" placeholder="Vul hier je eigen postcode in!">
                        <div class="errorForm"><?= $data['zipcodeError']; ?></div>
                    </div>

                    <input type="hidden" name="Id" value="<?= $data['Id']; ?>">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success" <?= $data['buttonDisabled']; ?>>Sla op</button>
                    </div>
                </form>
            </div>
            <div class="col-3">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6">
                <a href="<?= URLROOT; ?>/homepages/index">Homepage</a>        
            </div>
            <div class="col-3"></div>
        </div>
        </div>

 <?php require_once APPROOT . '/views/includes/footer.php'; ?>