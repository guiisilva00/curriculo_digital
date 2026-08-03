CREATE DATABASE curriculo_digital;
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

    FOREIGN KEY (dados_pessoais_id)
        REFERENCES dados_pessoais(id)
        ON DELETE CASCADE
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

    FOREIGN KEY (dados_pessoais_id)
        REFERENCES dados_pessoais(id)
        ON DELETE CASCADE
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

    FOREIGN KEY (dados_pessoais_id)
        REFERENCES dados_pessoais(id)
        ON DELETE CASCADE
);

CREATE TABLE habilidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,

    habilidade VARCHAR(100) NOT NULL,
    nivel ENUM('Básico','Intermediário','Avançado') DEFAULT 'Intermediário',

    FOREIGN KEY (dados_pessoais_id)
        REFERENCES dados_pessoais(id)
        ON DELETE CASCADE
);

CREATE TABLE idiomas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,

    idioma VARCHAR(100) NOT NULL,
    nivel ENUM('Básico','Intermediário','Avançado','Fluente','Nativo') DEFAULT 'Básico',

    FOREIGN KEY (dados_pessoais_id)
        REFERENCES dados_pessoais(id)
        ON DELETE CASCADE
);

CREATE TABLE certificados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,

    nome VARCHAR(200) NOT NULL,
    instituicao VARCHAR(150),
    data_conclusao DATE,
    url_certificado VARCHAR(255),

    FOREIGN KEY (dados_pessoais_id)
        REFERENCES dados_pessoais(id)
        ON DELETE CASCADE
);

CREATE TABLE projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dados_pessoais_id INT NOT NULL,

    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    tecnologias VARCHAR(255),
    link VARCHAR(255),

    FOREIGN KEY (dados_pessoais_id)
        REFERENCES dados_pessoais(id)
        ON DELETE CASCADE
);

-- ==========================================================
-- DADOS DE EXEMPLO (EXEMPLO COMPLETO PARA VISUALIZAÇÃO)
-- ==========================================================

INSERT INTO dados_pessoais (id, nome, cargo, resumo, objetivo, nascimento, cidade, estado) VALUES 
(1, 'Guilherme Silva', 'Desenvolvedor Full Stack', 'Desenvolvedor apaixonado por criar soluções web modernas, limpas e eficientes. Experiência em desenvolvimento backend com PHP/MySQL e interfaces dinâmicas.', 'Atuar como Desenvolvedor Full Stack contribuindo para projetos desafiadores e de alto impacto.', '1998-05-15', 'São Paulo', 'SP');

INSERT INTO contatos (dados_pessoais_id, email, telefone, linkedin, github, site_pessoal) VALUES 
(1, 'guilherme@exemplo.com', '(11) 98765-4321', 'https://linkedin.com/in/gui-silva', 'https://github.com/guiisilva00', 'https://meusite.com.br');

INSERT INTO experiencias (dados_pessoais_id, empresa, funcao, periodo_inicio, periodo_fim, trabalho_atual, descricao) VALUES 
(1, 'Tech Solutions', 'Desenvolvedor Web', '2022-01-10', NULL, TRUE, 'Desenvolvimento de sistemas web e APIs em PHP. Criação de telas e refatoração de código legado para novas arquiteturas.');

INSERT INTO formacao (dados_pessoais_id, instituicao, curso, periodo_inicio, periodo_fim, cursando, descricao) VALUES 
(1, 'Universidade de Tecnologia', 'Análise e Desenvolvimento de Sistemas', '2020-02-01', '2023-12-15', FALSE, 'Foco em Engenharia de Software, Bancos de Dados Relacionais e Desenvolvimento Web.');

INSERT INTO habilidades (dados_pessoais_id, habilidade, nivel) VALUES 
(1, 'PHP / MySQL', 'Avançado'),
(1, 'JavaScript / HTML5 / CSS3', 'Avançado'),
(1, 'Git / GitHub', 'Intermediário');

INSERT INTO idiomas (dados_pessoais_id, idioma, nivel) VALUES 
(1, 'Português', 'Nativo'),
(1, 'Inglês', 'Intermediário');

INSERT INTO certificados (dados_pessoais_id, nome, instituicao, data_conclusao, url_certificado) VALUES 
(1, 'Desenvolvimento PHP Avançado', 'Alura', '2023-06-20', 'https://alura.com.br/certificado/exemplo');

INSERT INTO projetos (dados_pessoais_id, nome, descricao, tecnologias, link) VALUES 
(1, 'Currículo Digital PHP', 'Plataforma interativa para criação, gestão e visualização de currículos digitais modernos.', 'PHP, MySQL, HTML5, CSS3, JavaScript', 'https://github.com/guiisilva00/curriculo_digital');

