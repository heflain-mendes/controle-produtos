CREATE TABLE `usuarios` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf_cnpj` varchar(20) NOT NULL UNIQUE,
  `dt_nascimento` date NOT NULL,
  `email` varchar(50) NOT NULL UNIQUE,
  `senha` varchar(8) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `esta_deletado` tinyint(1) NOT NULL DEFAULT 0,
  `email_deletado` varchar(50),
  `cpf_cnpj_deletado` varchar(20)
);

CREATE TABLE `tipos` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(30) NOT NULL
);

CREATE TABLE `servicos` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `id_prestador` int NOT NULL,
  FOREIGN KEY (id_prestador) REFERENCES usuarios(id),
  `nome` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  FOREIGN KEY (id_tipo) REFERENCES tipos(id),
  `esta_deletado` tinyint(1) NOT NULL DEFAULT 0
);

CREATE TABLE `vendas` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `id_contratante` int(11) NOT NULL,
  FOREIGN KEY (id_contratante) REFERENCES usuarios(id)
);

CREATE TABLE `datas_disponiveis` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `id_servico` int,
  FOREIGN KEY (id_servico) REFERENCES servicos(id),
  `id_venda` int,
  FOREIGN KEY (id_venda) REFERENCES vendas(id),
  `data` date NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 1
);

