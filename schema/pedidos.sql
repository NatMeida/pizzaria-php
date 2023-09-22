CREATE TABLE pedidos (
    id INT NOT NULL AUTO_INCREMENT,
    cliente VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    pagamento ENUM('cartao', 'dinheiro') NOT NULL,
    sabor VARCHAR(45) NOT NULL,
    adicionais VARCHAR(255) NOT NULL,
    rua VARCHAR(45) NOT NULL,
    numero INT NOT NULL,
    bairro VARCHAR(45) NOT NULL,
    complemento VARCHAR(45),
    cidade VARCHAR(45) NOT NULL,
    estado VARCHAR(45) NOT NULL,
    foto VARCHAR(255),

    PRIMARY KEY (id)
);

CREATE TABLE todos (
    id INT NOT NULL AUTO_INCREMENT,
    task TEXT,
    user VARCHAR(255) NOT NULL,

    PRIMARY KEY (id)
);
