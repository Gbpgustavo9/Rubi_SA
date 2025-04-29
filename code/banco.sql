CREATE DATABASE sistema_login;
USE sistema_login;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);
CREATE TABLE ouvidoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reclamacao TEXT NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE ramais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_ramal VARCHAR(20) NOT NULL,
    nome_departamento VARCHAR(100) NOT NULL
);
