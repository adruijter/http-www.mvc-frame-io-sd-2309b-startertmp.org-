/************************************************
-- Doel: Deleten van een record uit de tabel
         countries.
************************************************
-- Versie: 01
-- Datum:  25-09-2024
-- Auteur: Arjan de Ruijter
************************************************/

-- Noem de database voor de stored procedure
use `mvc-framework-io-sd-2309b-startertmp`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spDeleteCountryById;

DELIMITER //

CREATE PROCEDURE spDeleteCountryById
(
    IN Id INT UNSIGNED
)
BEGIN

    DELETE 
    FROM Country AS COUN
    WHERE COUN.Id = Id;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spDeleteCountryById(2);
****************************************************/

