/************************************************
-- Doel: Maken van een record in de tabel
         countries.
************************************************
-- Versie: 01
-- Datum:  27-09-2024
-- Auteur: Arjan de Ruijter
************************************************/

-- Noem de database voor de stored procedure
use `mvc-framework-io-sd-2309b-startertmp`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spCreateCountry;

DELIMITER //

CREATE PROCEDURE spCreateCountry
(
    IN  Name        VARCHAR(250),
    IN  CapitalCity VARCHAR(250),
    IN  Continent   VARCHAR(250), 
    IN  Population  INT UNSIGNED,
    IN  Zipcode     VARCHAR(6)    
)
BEGIN
    
    INSERT INTO Country (
        Name
        ,CapitalCity
        ,Continent
        ,Population
        ,Zipcode)
    VALUES (
        Name
        ,CapitalCity
        ,Continent
        ,Population
        ,Zipcode
    );

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spCreateCountry('Nederland', 'Amsterdam', 'Europa', '180000000', '2309AB');
****************************************************/

