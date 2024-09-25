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
DROP PROCEDURE IF EXISTS spGetCountryById;

DELIMITER //

CREATE PROCEDURE spGetCountryById
(
    IN countryId INT UNSIGNED
)
BEGIN
    SELECT  Id
            ,Name
            ,CapitalCity
            ,Continent
            ,Population
            ,Zipcode
    FROM Country
    WHERE Id = countryId;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetCountries(2);
****************************************************/

