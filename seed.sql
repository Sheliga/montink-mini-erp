USE `montink-mini-erp`;

-- Produtos
INSERT INTO produtos (nome, preco) VALUES
('Camiseta Básica', 49.90),
('Caneca Personalizada', 29.90),
('Boné Estilizado', 39.90);

-- Estoques (com variações)
INSERT INTO estoques (produto_id, variacao, quantidade) VALUES
(1, 'Tamanho P', 10),
(1, 'Tamanho M', 15),
(1, 'Tamanho G', 5),
(2, 'Branco', 20),
(2, 'Preto', 10),
(3, 'Azul Marinho', 7),
(3, 'Vermelho', 3);

-- Cupons
INSERT INTO cupons (codigo, validade, valor_minimo, desconto) VALUES
('DESCONTO10', '2025-12-31', 50.00, 10.00),
('FRETEGRATIS', '2025-12-31', 200.00, 20.00),
('PRIMEIRA10', '2025-12-31', 30.00, 5.00);

-- Pedido exemplo (opcional)
INSERT INTO pedidos (
    produtos_serializados,
    subtotal,
    frete,
    total,
    status,
    cep,
    endereco,
    email_cliente
) VALUES (
    '{"produtos":[{"id":1,"variacao":"Tamanho M","quantidade":1,"preco":49.90},{"id":2,"variacao":"Preto","quantidade":2,"preco":29.90}]}',
    109.70,
    15.00,
    124.70,
    'pendente',
    '01001-000',
    'Praça da Sé, São Paulo - SP',
    'cliente@teste.com'
);
