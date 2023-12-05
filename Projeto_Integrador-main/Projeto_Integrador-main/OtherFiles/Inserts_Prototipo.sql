INSERT INTO Usuario (nome, endereco, email, senha, confirmacaoDeSenha) 
VALUES ('Ana Abbud', 'Rua A, 123', 'ana.abbud@gmail.com', 'senha123', 'senha123');
INSERT INTO Usuario (nome, endereco, email, senha, confirmacaoDeSenha) 
VALUES ('Bruna Monteiro', 'Avenida B, 456', 'bruna.monteiro@gmail.com', 'abcd1234', 'abcd1234');
INSERT INTO Usuario (nome, endereco, email, senha, confirmacaoDeSenha) 
VALUES ('Felipe Alves', 'Rua C, 789', 'felipe.alves@gmail.com', 'blablabla', 'blablabla');
INSERT INTO Usuario (nome, endereco, email, senha, confirmacaoDeSenha) 
VALUES ('Gabriel Aguiar', 'Avenida D, 321', 'gabriel.aguiar@gmail.com', 'senha123', 'senha123');
INSERT INTO Usuario (nome, endereco, email, senha, confirmacaoDeSenha) 
VALUES ('Victor Pavanello', 'Rua E, 654', 'victor.pava@gmail.com', 'abcd1234', 'abcd1234');

INSERT INTO Marca (nome, descricao) 
VALUES ('Nike', 'Marca conhecida por sua inovação e qualidade em calçados esportivos.');
INSERT INTO Marca (nome, descricao) 
VALUES ('Adidas', 'Uma das marcas líderes em artigos esportivos, incluindo tênis de alto desempenho.');
INSERT INTO Marca (nome, descricao) 
VALUES ('Puma', 'Marca alemã reconhecida por seu estilo único e design diferenciado de calçados esportivos.');
INSERT INTO Marca (nome, descricao) 
VALUES ('Skechers', 'Marca especializada em calçados esportivos com ênfase em conforto e estilo moderno.');
INSERT INTO Marca (nome, descricao) 
VALUES ('Asics', 'Marca conhecida por sua tecnologia avançada em calçados esportivos, especialmente tênis de corrida.');

INSERT INTO Tenis (modelo, marca_id, preco, nome, tamanho, cor, caminho) 
VALUES ('Air Max 270', 1, 299.99, 'Nike Air Max 270', '42', 'Preto/Vermelho', '../Assets/ImageFiles/648762deecb4f.jpg');
INSERT INTO Tenis (modelo, marca_id, preco, nome, tamanho, cor, caminho) 
VALUES ('Ultraboost', 2, 249.99, 'Adidas Ultraboost', '41', 'Branco', '../Assets/ImageFiles/648762e7889h3.jpg');
INSERT INTO Tenis (modelo, marca_id, preco, nome, tamanho, cor, caminho) 
VALUES ('Ignite', 3, 149.99, 'Puma Ignite', '39', 'Azul', '../Assets/ImageFiles/648762e7889b9.jpg');
INSERT INTO Tenis (modelo, marca_id, preco, nome, tamanho, cor, caminho) 
VALUES ('Skech-Air Infinity', 4, 179.99, 'Skechers Skech-Air Infinity', '40', 'Rosa', '../Assets/ImageFiles/648762e78827i.jpg');
INSERT INTO Tenis (modelo, marca_id, preco, nome, tamanho, cor, caminho) 
VALUES ('Gel-Kayano 27', 5, 199.99, 'Asics Gel-Kayano 27', '43', 'Cinza/Laranja', '../Assets/ImageFiles/648762e788bo9.jpg');

INSERT INTO Pedido (usuario_id, total, status) VALUES (1, 799.95, 'Pendente');
INSERT INTO Pedido (usuario_id, total, status) VALUES (2, 399.96, 'Entregue');
INSERT INTO Pedido (usuario_id, total, status) VALUES (1, 299.97, 'Em andamento');
INSERT INTO Pedido (usuario_id, total, status) VALUES (3, 599.98, 'Pendente');
INSERT INTO Pedido (usuario_id, total, status) VALUES (2, 899.95, 'Concluído');

INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (1, 1, 2, 599.98);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (1, 3, 1, 149.99);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (2, 2, 1, 199.99);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (3, 5, 3, 599.97);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (4, 4, 1, 179.99);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (4, 1, 1, 299.99);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (5, 3, 2, 299.98);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (5, 2, 1, 199.99);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (5, 4, 2, 359.98);
INSERT INTO ItemPedido (pedido_id, tenis_id, quantidade, sub_total) VALUES (5, 5, 1, 199.99);