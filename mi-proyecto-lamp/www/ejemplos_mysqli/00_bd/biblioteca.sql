-- ============================================================
-- Base de datos de ejemplo: biblioteca
-- En Ubuntu/Debian se importa desde la terminal con:
--     sudo mariadb < biblioteca.sql
-- Vuelve a ejecutarlo cuando quieras dejar los datos como al principio
-- (los ejemplos insertan, modifican y borran libros).
-- ============================================================

CREATE DATABASE IF NOT EXISTS biblioteca
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usuario que usarán los scripts PHP (contraseña: comomola)
CREATE USER IF NOT EXISTS 'biblioteca'@'%' IDENTIFIED BY 'comomola';
GRANT ALL PRIVILEGES ON biblioteca.* TO 'biblioteca'@'%';

USE biblioteca;

DROP TABLE IF EXISTS libros;

-- Cambios respecto al material: InnoDB en lugar de MyISAM
-- (admite transacciones y claves ajenas) y utf8mb4 en lugar de latin1
-- (guarda bien tildes, ñ y cualquier carácter).
CREATE TABLE IF NOT EXISTS `libros` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `autor` varchar(30) NOT NULL DEFAULT 'Desconocido',
  `editorial` varchar(20) NOT NULL,
  `precio` decimal(5,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=10;

INSERT INTO `libros` (`codigo`, `titulo`, `autor`, `editorial`, `precio`) VALUES
(1, 'El aleph', 'Borges', 'Emece', 23.50),
(2, 'Alicia en el pais de las maravillas', 'Lewis Carroll', 'Planeta', 15.00),
(3, 'Matematica estas ahi', 'Paenza', 'Emece', 34.60),
(4, 'Martin Fierro', 'Jose Hernandez', 'Paidos', 43.50),
(5, 'Martin Fierro', 'Jose Hernandez', 'Planeta', 12.00),
(6, 'Aprenda PHP', 'Mario Molina', 'Paidos', 21.80),
(7, 'Aprenda Java', 'Mario Molina', 'Paidos', 55.40),
(8, 'Alicia a traves del espejo', 'Lewis Carroll', 'Emece', 18.00),
(9, 'Antologia poetica', 'Borges', 'Paidos', 47.90);
