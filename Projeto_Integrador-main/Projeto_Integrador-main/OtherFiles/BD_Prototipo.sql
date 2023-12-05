CREATE TABLE Usuario (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    confirmacaoDeSenha VARCHAR(255) NOT NULL
);

CREATE TABLE Marca (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(100)
);

CREATE TABLE Tenis (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    modelo VARCHAR(20),
    marca_id INT(11),
    usuario_id int(11),
    preco DECIMAL(10, 2),
    nome VARCHAR(100),
    tamanho VARCHAR(100),
    cor VARCHAR(100),
    caminho VARCHAR(100) NOT NULL, 
    data_upload DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (marca_id) REFERENCES Marca(id)
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id)
);

CREATE TABLE Pedido (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT(11) NOT NULL,
    data_pedido DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2),
    status VARCHAR(100),
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id)
);

CREATE TABLE ItemPedido (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT(11) NOT NULL,
    tenis_id INT(11) NOT NULL,
    quantidade INT(11) NOT NULL,
    sub_total DECIMAL(10, 2),
    FOREIGN KEY (pedido_id) REFERENCES Pedido(id),
    FOREIGN KEY (tenis_id) REFERENCES Tenis(id)
);
