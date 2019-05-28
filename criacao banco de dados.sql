
CREATE DATABASE banco_de_dados_classificados;

USE banco_de_dados_classificados;

CREATE TABLE usuarios(
    id int unsigned not null AUTO_INCREMENT,
    nome varchar(100),
    email varchar(100),
    senha varchar(100),
    telefone varchar(100),
    PRIMARY KEY(id)
);

USE banco_de_dados_classificados;

CREATE TABLE categorias
(
    id int unsigned not null AUTO_INCREMENT,
    nome_categoria varchar(100),
    PRIMARY KEY(id)
);

USE banco_de_dados_classificados;

INSERT INTO categorias SET nome_categoria='roupas';
INSERT INTO categorias SET nome_categoria='relogios';
INSERT INTO categorias SET nome_categoria='eletronicos';
INSERT INTO categorias SET nome_categoria='eletrodomesticos';
INSERT INTO categorias SET nome_categoria='ferramentas';

USE banco_de_dados_classificados;

CREATE TABLE estado
(
    id int unsigned not null AUTO_INCREMENT,
    nome_estado varchar(100),
    PRIMARY KEY(id)
);

USE banco_de_dados_classificados;


INSERT INTO estado SET nome_estado='ruim';
INSERT INTO estado SET nome_estado='bom';
INSERT INTO estado SET nome_estado='excelente';

USE banco_de_dados_classificados;

CREATE TABLE anuncios
(
    id int unsigned not null AUTO_INCREMENT,
    id_usuario int(50),
    id_categoria int(50),
    titulo varchar(100),
    descricao text,
    valor float,
    id_estado int(50),
    foto_principal varchar(100),
    PRIMARY KEY(id)
);

USE banco_de_dados_classificados;

CREATE TABLE imagens
(
    id int unsigned not null AUTO_INCREMENT,
    id_usuarios int(50),
    id_anuncios int(50),
    url varchar(100),
    PRIMARY KEY(id)
);

