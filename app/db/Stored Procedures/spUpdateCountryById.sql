/************************************************
-- Doel: Updaten van een record uit de tabel
         countries.
************************************************
-- Versie: 01
-- Datum:  27-09-2024
-- Auteur: Arjan de Ruijter
************************************************/

-- Noem de database voor de stored procedure
use `mvc-framework-io-sd-2309b-startertmp`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spUpdateCountryById;

DELIMITER //

CREATE PROCEDURE spUpdateCountryById
(
    IN  Id          INT UNSIGNED,
    IN  Name        VARCHAR(250),
    IN  CapitalCity VARCHAR(250),
    IN  Continent   VARCHAR(250), 
    IN  Population  INT UNSIGNED,
    IN  Zipcode     VARCHAR(6)    
)
BEGIN
    
    UPDATE Country AS COUN
    SET  COUN.Name = Name
        ,COUN.CapitalCity = CapitalCity
        ,COUN.Continent = Continent
        ,COUN.Population = Population
        ,COUN.Zipcode = Zipcode
    WHERE COUN.Id = Id;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spUpdateCountryById(2, 'Nederland', 'Amsterdam', 'Europa', '180000000', '2309AB');
****************************************************/

