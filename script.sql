CREATE DATABASE IF NOT EXISTS curriculo_digital;
USE curriculo_digital;

CREATE TABLE dados_pessoais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cargo VARCHAR(120) NOT NULL,
    resumo TEXT,
    objetivo TEXT,
    nascimento DATE,
    cidade VARCHAR(100),
    estado VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,
    email VARCHAR(150),
    telefone VARCHAR(20),
    linkedin VARCHAR(255),
    github VARCHAR(255),
    site_pessoal VARCHAR(255),
    FOREIGN KEY (dados_pessoais_id) REFERENCES dados_pessoais(id) ON DELETE CASCADE
);

CREATE TABLE experiencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,
    empresa VARCHAR(150) NOT NULL,
    funcao VARCHAR(150) NOT NULL,
    periodo_inicio DATE,
    periodo_fim DATE,
    trabalho_atual BOOLEAN DEFAULT FALSE,
    descricao TEXT,
    FOREIGN KEY (dados_pessoais_id) REFERENCES dados_pessoais(id) ON DELETE CASCADE
);

CREATE TABLE formacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,
    instituicao VARCHAR(150) NOT NULL,
    curso VARCHAR(150) NOT NULL,
    periodo_inicio DATE,
    periodo_fim DATE,
    cursando BOOLEAN DEFAULT FALSE,
    descricao TEXT,
    FOREIGN KEY (dados_pessoais_id) REFERENCES dados_pessoais(id) ON DELETE CASCADE
);

CREATE TABLE projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    tecnologias VARCHAR(255),
    link VARCHAR(255),
    FOREIGN KEY (dados_pessoais_id) REFERENCES dados_pessoais(id) ON DELETE CASCADE
);


--Insert apenas para modelagem com base nas minhas especialidades.

INSERT INTO dados_pessoais (nome, cargo, resumo, objetivo) 
VALUES (
    'Guilherme de Paula Silva', 
    'Estagiário / Desenvolvedor Júnior', 
    'Estudante de Desenvolvimento de Sistemas no SENAI, em busca da primeira oportunidade profissional na área de tecnologia. Possui certificação de inglês B2 Upper Intermediate pela Pearson.', 
    'Atuar com desenvolvimento de sistemas, aplicando os conhecimentos adquiridos na formação técnica para colaborar com a equipe e evoluir profissionalmente.'
);

SET @last_id = LAST_INSERT_ID();

INSERT INTO contatos (dados_pessoais_id, email, telefone, linkedin, github) 
VALUES (
    @last_id, 
    'guilhermmesilva01@gmail.com', 
    '11 919453909', 
    'https://www.linkedin.com/in/guilhermesilvaa01/', 
    'https://github.com/guiisilva00'
);
INSERT INTO formacao (dados_pessoais_id, instituicao, curso, periodo_inicio, periodo_fim, cursando) 
VALUES (
    @last_id, 
    'SENAI ''Armando de Arruda Pereira''', 
    'Desenvolvimento de Sistemas', 
    '2025-07-27', 
    '2027-07-30', 
    TRUE
);