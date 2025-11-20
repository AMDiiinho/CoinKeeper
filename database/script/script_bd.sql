CREATE TABLE tb_usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    DDD VARCHAR(3) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    nome VARCHAR(85) NOT NULL,
    email VARCHAR(85) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tb_contas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    titulo VARCHAR(25) NOT NULL,
    banco ENUM('carteira', 'mastercard', 'visa', 'elo', 'itau', 
                'bancodobrasil', 'caixa', 'santander', 'bradesco', 'nubank', 'inter') NOT NULL,
    saldo DECIMAL(10,2) DEFAULT 0,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_contas_usuario
        FOREIGN KEY (usuario_id) REFERENCES tb_usuarios(id)
        ON DELETE CASCADE
);

CREATE TABLE tb_categorias (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    nome VARCHAR(80) NOT NULL,
    cor CHAR(7) NOT NULL,
    icone VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_categorias_usuario
        FOREIGN KEY (usuario_id) REFERENCES tb_usuarios(id)
        ON DELETE CASCADE
);

CREATE TABLE tb_subcategorias (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT UNSIGNED NOT NULL,
    nome VARCHAR(80) NOT NULL,
    cor CHAR(7) NULL,
    icone VARCHAR(255) NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (categoria_id) REFERENCES tb_categorias(id)
        ON DELETE CASCADE
);

CREATE TABLE tb_transacoes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    conta_id INT UNSIGNED NOT NULL,
    categoria_id INT UNSIGNED   NULL,
    subcategoria_id INT UNSIGNED NULL,
    titulo VARCHAR(80) NOT NULL,
    tipo ENUM('receita','despesa','transferencia'),
    status ENUM('pendente', 'pago') NOT NULL DEFAULT 'pendente',
    lancamento ENUM('unico', 'recorrente'),
    recorrencia_periodo ENUM('mensal','bimestral','trimestral','semestral','anual','semanal','quinzenal') NULL,
    recorrencia_qtd INT UNSIGNED NULL,
    valor DECIMAL(10,2) NOT NULL,
    descricao VARCHAR(255) NULL,
    data DATE NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_transacoes_usuario
        FOREIGN KEY (usuario_id) REFERENCES tb_usuarios(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_transacoes_conta
        FOREIGN KEY (conta_id) REFERENCES tb_contas(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_transacoes_categoria
        FOREIGN KEY (categoria_id) REFERENCES tb_categorias(id)
        ON DELETE CASCADE,
    
    CONSTRAINT fk_transacoes_subcategoria
    FOREIGN KEY (subcategoria_id) REFERENCES tb_subcategorias(id)
    ON DELETE SET NULL
);
