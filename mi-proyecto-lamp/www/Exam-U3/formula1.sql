-- ============================================================
--  Base de datos: formula1
--  Examen PHP 8.5 + MySQLi (consultas preparadas)
--  Datos orientativos para el ejercicio (temporada 2026).
-- ============================================================

DROP DATABASE IF EXISTS formula1;
CREATE DATABASE formula1
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_spanish_ci;

USE formula1;

CREATE TABLE pilotos (
    codigo           CHAR(3)      NOT NULL,
    nombre           VARCHAR(60)  NOT NULL,
    fecha_nacimiento DATE         NOT NULL,
    escuderia        VARCHAR(40)  NOT NULL,
    victorias        INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (codigo)
) ENGINE = InnoDB;

INSERT INTO pilotos (codigo, nombre, fecha_nacimiento, escuderia, victorias) VALUES
('VER', 'Max Verstappen',    '1997-09-30', 'Red Bull',     70),
('HAD', 'Isack Hadjar',      '2004-09-28', 'Red Bull',      0),
('LEC', 'Charles Leclerc',   '1997-10-16', 'Ferrari',       8),
('HAM', 'Lewis Hamilton',    '1985-01-07', 'Ferrari',     105),
('NOR', 'Lando Norris',      '1999-11-13', 'McLaren',      11),
('PIA', 'Oscar Piastri',     '2001-04-06', 'McLaren',       9),
('RUS', 'George Russell',    '1998-02-15', 'Mercedes',      5),
('ANT', 'Kimi Antonelli',    '2006-08-25', 'Mercedes',      0),
('ALO', 'Fernando Alonso',   '1981-07-29', 'Aston Martin', 32),
('STR', 'Lance Stroll',      '1998-10-29', 'Aston Martin',  0),
('SAI', 'Carlos Sainz',      '1994-09-01', 'Williams',      4),
('ALB', 'Alexander Albon',   '1996-03-23', 'Williams',      0),
('GAS', 'Pierre Gasly',      '1996-02-07', 'Alpine',        1),
('PER', 'Sergio Pérez',      '1990-01-26', 'Cadillac',      6),
('BOT', 'Valtteri Bottas',   '1989-08-28', 'Cadillac',     10);


