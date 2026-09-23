CREATE DATABASE IF NOT EXISTS clinica_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE clinica_db;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Usuário inicial:
-- E-mail: admin@clinica.com
-- Senha: 123456
INSERT IGNORE INTO usuarios (nome, email, senha)
VALUES ('Administrador', 'admin@clinica.com', '$2y$10$txdsnTLgXnxfVSb4hINLouwAWIbEylUcRuwTX7zutIyYyvrP0hy5i');
