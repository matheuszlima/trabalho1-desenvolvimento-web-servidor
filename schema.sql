CREATE DATABASE IF NOT EXISTS clinica_db;
USE clinica_db;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  senha_hash VARCHAR(255) NOT NULL
);

CREATE TABLE pacientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  cpf VARCHAR(14) UNIQUE NOT NULL,
  telefone VARCHAR(20),
  email VARCHAR(100),
  data_nascimento DATE,
  endereco VARCHAR(200)
);

CREATE TABLE profissionais (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  especialidade VARCHAR(100) NOT NULL,
  registro VARCHAR(50),
  telefone VARCHAR(20)
);

CREATE TABLE consultas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  paciente_id INT NOT NULL,
  profissional_id INT NOT NULL,
  data_hora DATETIME NOT NULL,
  status VARCHAR(20) DEFAULT 'agendada',
  observacoes TEXT,
  FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
  FOREIGN KEY (profissional_id) REFERENCES profissionais(id)
);

-- Usuário inicial para acessar o sistema
-- E-mail: admin@gmail.com
INSERT INTO usuarios (nome, email, senha_hash)
VALUES ('Administrador', 'admin@gmail.com', '$2y$10$zWEdHwUzT3fyl9hu/jg3P.SNBDlWHwWGW6LxT/sA.whCI0.O8B8Bu');
