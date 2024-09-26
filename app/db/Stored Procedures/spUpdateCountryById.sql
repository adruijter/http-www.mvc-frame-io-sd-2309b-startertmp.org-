/************************************************
-- Doel: Opvragen van 1 record uit de tabel
-- countries.
************************************************
-- Versie: 01
-- Datum:  25-09-2024
-- Auteur: Arjan de Ruijter
-- Stored procedure voor update method
************************************************/

-- Noem de database voor de stored procedure
use `mvc-framework-io-sd-2309b-startertmp`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spUpdateCountryById;

DELIMITER //

CREATE PROCEDURE spUpdateCountryById
(
    IN id           INT             UNSIGNED,
    IN name         VARCHAR(250),
    IN capitalCity  VARCHAR(250),
    IN continent    VARCHAR(250),
    IN population   INT             UNSIGNED,
    IN zipCode      VARCHAR(6)
)
BEGIN
    UPDATE  Country AS COUN
    SET  COUN.Name = name
        ,COUN.CapitalCity = capitalCity
        ,COUN.Continent = continent
        ,COUN.Population = population
        ,COUN.Zipcode = zipCode
    WHERE COUN.Id = id;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spUpdateGetCountries(2, 'Naam', 'capitalCity', 'Continent', 54321, '2308RT');
****************************************************/

