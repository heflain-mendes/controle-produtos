CREATE TABLE `usuarios` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(13) NOT NULL,
  `dt_nascimento` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `tipo` varchar(1) NOT NULL
);

INSERT INTO usuarios
VALUES (0, 'Heflain', 'Rua Major Quintino', '28999228213', '17887145696', '2000-08-09', 'heflain@email', '1234', 'A');

CREATE TABLE `tipos` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(30) NOT NULL
);

CREATE TABLE `servicos` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `descricao` text NOT NULL,
  `id_tipo` int(11) NOT NULL,
  FOREIGN KEY (id_tipo) REFERENCES tipos(id)
);

CREATE TABLE `datas_disponiveis` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `id_servico` int,
  FOREIGN KEY (id_servico) REFERENCES servicos(id),
  `data` date NOT NULL,
  `disponivel` tinyint(1) NOT NULL
);

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
  `id_servico` int(11) NOT NULL,
  FOREIGN KEY (id_servico) REFERENCES servicos(id),
  `valor_total` float NOT NULL,
  `qtd_itens` int(11) NOT NULL
);
