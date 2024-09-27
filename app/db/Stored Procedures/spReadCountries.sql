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
DROP PROCEDURE IF EXISTS spReadCountries;

DELIMITER //

CREATE PROCEDURE spReadCountries()
BEGIN

    SELECT COUN.Id
           ,COUN.Name
           ,COUN.CapitalCity
           ,COUN.Continent
           ,COUN.Population
           ,COUN.Zipcode
    FROM   Country AS COUN
    Order BY COUN.Id;



END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spReadCountries();
****************************************************/

