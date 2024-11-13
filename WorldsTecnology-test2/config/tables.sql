create database usc;
use usc;
CREATE TABLE admin (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
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
ALTER TABLE PingPong ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE futbolito ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE billar ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE aerohockey ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';
ALTER TABLE consolas ADD COLUMN estado VARCHAR(20) DEFAULT 'activo';

