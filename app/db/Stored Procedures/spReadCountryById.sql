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
DROP PROCEDURE IF EXISTS spReadCountryById;

DELIMITER //

CREATE PROCEDURE spReadCountryById 
(
    IN Id INT UNSIGNED
)
BEGIN

    SELECT  COUN.Id
            ,COUN.Name
            ,COUN.CapitalCity
            ,COUN.Continent
            ,COUN.Population
            ,COUN.Zipcode
    FROM Country AS COUN
    WHERE COUN.Id = Id;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spReadCountryById(2);
****************************************************/

