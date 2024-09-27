/************************************************
-- Doel: Opvragen alle records uit de tabel
-- countries.
************************************************
-- Versie: 01
-- Datum:  25-09-2024
-- Auteur: Arjan de Ruijter
-- Stored procedure voor index model method
************************************************/

-- Noem de database voor de stored procedure
use `mvc-framework-io-sd-2309b-startertmp`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetCountries;

DELIMITER //

CREATE PROCEDURE spGetCountries()
BEGIN

    SELECT Id
           ,Name
           ,CapitalCity
           ,Continent
           ,Population
           ,Zipcode
    FROM   Country
    Order BY Id;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetCountries();
****************************************************/

