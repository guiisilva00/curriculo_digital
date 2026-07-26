CREATE TABLE dados_pessoais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cargo VARCHAR(120) NOT NULL,
    resumo TEXT,
    cidade VARCHAR(100),
    estado VARCHAR(100),
    foto_perfil VARCHAR(255),
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
    descricao TEXT,
    FOREIGN KEY (dados_pessoais_id) REFERENCES dados_pessoais(id) ON DELETE CASCADE
);