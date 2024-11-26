create database usc;
use usc;
CREATE TABLE admin (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    code VARCHAR(255) NOT NULL
);

CREATE TABLE consolas (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    estudiante      VARCHAR(255) NOT NULL,
    juego           VARCHAR(255) NOT NULL,
    hora_finalizacion TIME NOT NULL
);

CREATE TABLE PingPong (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    estudiante      VARCHAR(255) NOT NULL,
    hora_finalizacion TIME NOT NULL
);

CREATE TABLE billar (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    estudiante      VARCHAR(255) NOT NULL,
    hora_finalizacion TIME NOT NULL
);

CREATE TABLE futbolito (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    estudiante      VARCHAR(255) NOT NULL,
    hora_finalizacion TIME NOT NULL
);

CREATE TABLE aerohockey (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    estudiante      VARCHAR(255) NOT NULL,
    hora_finalizacion TIME NOT NULL
);

CREATE TABLE Incidentes (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    titulo           VARCHAR(255) NOT NULL,
    utensilio_afectado VARCHAR(255) NOT NULL,
    fecha_creacion   DATE NOT NULL,
    descripcion      TEXT NOT NULL
);

CREATE TABLE reservas_historial (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    juego VARCHAR(255) NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE PingPong ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE futbolito ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE billar ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE aerohockey ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE consolas ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';


-- Insertar para la tabla consolas
INSERT INTO consolas (estudiante, juego, hora_finalizacion, estado) 
VALUES
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo'),
('', '', '00:00:00', 'activo');

-- Insertar 6 registros para la tabla PingPong
INSERT INTO PingPong (estudiante, hora_finalizacion, estado)
VALUES
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo');

-- Insertar 3 registros para la tabla billar
INSERT INTO billar (estudiante, hora_finalizacion, estado)
VALUES
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo');

-- Insertar 3 registros para la tabla futbolito
INSERT INTO futbolito (estudiante, hora_finalizacion, estado)
VALUES
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo');

-- Insertar 2 registros para la tabla aerohockey
INSERT INTO aerohockey (estudiante, hora_finalizacion, estado)
VALUES
('', '00:00:00', 'activo'),
('', '00:00:00', 'activo');
