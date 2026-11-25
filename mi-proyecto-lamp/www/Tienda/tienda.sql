DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_spanish_ci;

USE tienda;

CREATE TABLE productos (
    id         INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    nombre     VARCHAR(45)   NOT NULL,
    categoria  VARCHAR(25)   NOT NULL,
    precio     DECIMAL(6,2)  NOT NULL,
    stock      INT UNSIGNED  NOT NULL DEFAULT 0,
    fecha_alta DATE          NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

INSERT INTO productos (nombre, categoria, precio, stock, fecha_alta) VALUES
('Portátil Lenovo IdeaPad 3',   'Ordenadores', 549.90, 12, '2025-11-10'),
('Ratón Logitech MX Master 3S', 'Periféricos',  99.50, 35, '2026-01-15'),
('Monitor Samsung 27" IPS',     'Monitores',   189.00,  8, '2025-12-03'),
('Teclado Mecánico Keychron K2','Periféricos',  89.95, 20, '2026-02-01'),
('Disco SSD NVMe 1TB Kingston', 'Componentes',  64.50, 50, '2026-01-22'),
('Memoria RAM 16GB DDR5',       'Componentes',  58.00, 30, '2025-10-18'),
('Auriculares Sony WH-1000XM5', 'Audio',       299.00,  5, '2026-02-14'),
('Webcam Logitech C920 HD',     'Periféricos',  74.90, 18, '2025-09-30');

