-- ============================================================
--  Base de datos: concesionario
--  Ejercicio PHP 8.5 + MySQLi (consultas preparadas)
-- ============================================================

DROP DATABASE IF EXISTS concesionario;
CREATE DATABASE concesionario
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_spanish_ci;

USE concesionario;

CREATE TABLE vehiculos (
    matricula VARCHAR(10)  NOT NULL,
    marca     VARCHAR(30)  NOT NULL,
    modelo    VARCHAR(50)  NOT NULL,
    fecha     DATE         NOT NULL,
    kms       INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (matricula)
) ENGINE = InnoDB;

INSERT INTO vehiculos (matricula, marca, modelo, fecha, kms) VALUES
('1234ABC', 'Seat',       'Ibiza',      '2018-03-15',  85000),
('2345BCD', 'Renault',    'Clio',       '2019-07-22',  62000),
('3456CDF', 'Volkswagen', 'Golf',       '2020-01-10',  45000),
('4567DFG', 'Toyota',     'Corolla',    '2021-05-05',  30000),
('5678FGH', 'Peugeot',    '308',        '2017-11-30', 120000),
('6789GHJ', 'Ford',       'Focus',      '2016-09-18', 150000),
('7890HJK', 'Kia',        'Sportage',   '2022-02-14',  18000),
('8901JKL', 'Hyundai',    'Tucson',     '2023-06-01',   9000),
('9012KLM', 'BMW',        'Serie 3',    '2019-04-25',  70000),
('0123LMN', 'Dacia',      'Sandero',    '2024-01-20',   5000);

-- Usuario de la aplicación (opcional, recomendado en lugar de root)
CREATE USER IF NOT EXISTS 'concesionario'@'localhost' IDENTIFIED BY 'concesionario';
GRANT SELECT, INSERT, UPDATE, DELETE ON concesionario.* TO 'concesionario'@'localhost';
FLUSH PRIVILEGES;
