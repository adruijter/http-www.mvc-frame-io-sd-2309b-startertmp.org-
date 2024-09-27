/************************************************
-- Doel: Restore Database mvc-framework-io-sd-2309b-startertmp
************************************************
-- Versie: 01
-- Datum:  27-09-2024
-- Auteur: Arjan de Ruijter
************************************************/

-- Noem de database voor de stored procedure
use `mvc-framework-io-sd-2309b-startertmp`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spRestoreDb;

DELIMITER //

CREATE PROCEDURE spRestoreDb()
    BEGIN
        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        --
        -- Host: 127.0.0.1:3306
        -- Gegenereerd op: 27 sep 2024 om 07:44
        -- Serverversie: 9.0.1
        -- PHP-versie: 8.3.11

        SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        START TRANSACTION;
        SET time_zone = "+00:00";


        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
        /*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `CapitalCity` varchar(250) NOT NULL,
  `Continent` varchar(250) NOT NULL,
  `Population` int UNSIGNED NOT NULL,
  `Zipcode` varchar(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `country`
--

INSERT INTO `country` (`Id`, `Name`, `CapitalCity`, `Continent`, `Population`, `Zipcode`) VALUES
(2, 'Argentini&euml;', 'Buenos Aires', 'Zuid-Amerika', 4294967294, '2309CC'),
(4, 'Japan', 'Tokio', 'Azi&euml;', 125700000, '8761EE'),
(5, 'Zwitserlandd', 'Bern', 'Europa', 8703000, '2345RR'),
(6, 'Noorwegen', 'Oslo', 'Europa', 5550203, '2314UT'),
(11, 'Litouwen', 'Vilnius', 'Europa', 340000000, '9382YY'),
(15, 'Marokko', 'Rabat', 'Afrika', 37500000, '1243HH'),
(16, 'Nepal', 'Kathmandu', 'Azi&euml;', 30000000, '6534GG'),
(17, 'Chili', 'Santiago', 'Zuid-Amerika', 18276870, '8347AA'),
(18, 'Japan', 'Tokio', 'Azi&euml;', 125700000, '2342TT');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reuzenrad`
--

DROP TABLE IF EXISTS `reuzenrad`;
CREATE TABLE IF NOT EXISTS `reuzenrad` (
  `Id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) NOT NULL,
  `Hoogte` smallint NOT NULL,
  `Land` varchar(100) NOT NULL,
  `Kosten` int NOT NULL,
  `AantalPassagiers` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reuzenrad`
--

INSERT INTO `reuzenrad` (`Id`, `Naam`, `Hoogte`, `Land`, `Kosten`, `AantalPassagiers`) VALUES
(6, 'Ain Dubai', 250, 'Verenigde Arabische Emiraten', 270, 1750),
(7, 'High Roller', 168, 'Verenigde Staten', 203, 1120),
(8, 'Singapore Flyer', 165, 'Singapore', 240, 784),
(9, 'Star of Nanchang', 160, 'China', 57, 480),
(10, 'London Eye', 135, 'Engeland', 65, 320);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `zangeres`
--

DROP TABLE IF EXISTS `zangeres`;
CREATE TABLE IF NOT EXISTS `zangeres` (
  `Id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) NOT NULL,
  `NettoWaarde` smallint NOT NULL,
  `Land` varchar(100) NOT NULL,
  `Mobiel` varchar(20) NOT NULL,
  `Leeftijd` tinyint NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `zangeres`
--

INSERT INTO `zangeres` (`Id`, `Naam`, `NettoWaarde`, `Land`, `Mobiel`, `Leeftijd`) VALUES
(1, 'Rihanna', 1400, 'Barbados', '+1246240001862400', 36),
(2, 'Madonna', 575, 'Verenigde Staten', '+1 3425 185876', 65),
(3, 'Taylor', 570, 'Verenigde Staten', '+1 5876 236512', 34),
(4, 'Beyoncé', 420, 'Verenigde Staten', '+1 6794908465', 42),
(5, 'Jennifer Lopez', 400, 'Verenigde Staten', '+1 3131 857345', 54);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


        
        

    END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spRestoreDb();
****************************************************/

