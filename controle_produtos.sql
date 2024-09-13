-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/09/2024 às 17:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controle_produtos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `datas_disponiveis`
--

CREATE TABLE `datas_disponiveis` (
  `id` int(11) NOT NULL,
  `id_servico` int(11) DEFAULT NULL,
  `id_venda` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 1,
  `prestado` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `datas_disponiveis`
--

INSERT INTO `datas_disponiveis` (`id`, `id_servico`, `id_venda`, `data`, `disponivel`, `prestado`) VALUES
(45, 8, NULL, '2024-10-14', 1, 0),
(46, 8, NULL, '2024-10-15', 1, 0),
(47, 8, NULL, '2024-10-16', 1, 0),
(48, 8, NULL, '2024-10-17', 1, 0),
(49, 8, NULL, '2024-09-19', 1, 0),
(56, 7, NULL, '2024-10-01', 1, 0),
(57, 7, NULL, '2024-10-02', 1, 0),
(58, 7, NULL, '2024-10-03', 1, 0),
(59, 7, NULL, '2024-10-04', 1, 0),
(60, 7, NULL, '2024-10-07', 1, 0),
(61, 7, NULL, '2024-10-08', 1, 0),
(62, 9, NULL, '2024-10-14', 1, 0),
(63, 9, NULL, '2024-10-15', 1, 0),
(64, 9, NULL, '2024-10-16', 1, 0),
(65, 9, NULL, '2024-10-17', 1, 0),
(66, 9, NULL, '2024-10-18', 1, 0),
(67, 10, NULL, '2024-11-11', 1, 0),
(68, 10, NULL, '2024-11-10', 1, 0),
(69, 11, NULL, '2024-10-26', 1, 0),
(70, 12, NULL, '2024-10-28', 1, 0),
(71, 12, NULL, '2024-10-29', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `id_prestador` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `esta_deletado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `id_prestador`, `nome`, `valor`, `descricao`, `cidade`, `id_tipo`, `esta_deletado`) VALUES
(7, 5, 'Acabamento de casa', 150, 'Reboco, massa corrida e azulejo', 'Alegre', 2, 0),
(8, 5, 'Pequena manutenções', 120, 'Instalação de portas, janelas e pedras de mármore', 'Alegre', 3, 0),
(9, 6, 'Limpeza de casa', 160, 'Casas, apartamento e pequenos escritórios', 'Alegre', 4, 0),
(10, 8, 'Montagem Móveis', 100, 'Guarda roupas, armários, multiusos e etc...', 'Alegre', 5, 0),
(11, 8, 'Jardinagem de campo de futebol', 200, 'Até 250 m²', 'Alegre', 6, 0),
(12, 6, 'Jardinagem', 100, 'Pequenos jardins', 'Alegre', 6, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos`
--

INSERT INTO `tipos` (`id`, `nome`) VALUES
(2, 'Construção'),
(3, 'Manutenção'),
(4, 'Limpeza'),
(5, 'montagem'),
(6, 'Jardinagem'),
(7, 'Reparos'),
(8, 'Geral');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `dt_nascimento` date NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(8) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `esta_deletado` tinyint(1) NOT NULL DEFAULT 0,
  `email_deletado` varchar(50) DEFAULT NULL,
  `cpf_cnpj_deletado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `endereco`, `telefone`, `cpf_cnpj`, `dt_nascimento`, `email`, `senha`, `tipo`, `esta_deletado`, `email_deletado`, `cpf_cnpj_deletado`) VALUES
(4, 'Admin', '', '', '', '2024-09-11', 'admin@email', '1234', 'A', 0, NULL, NULL),
(5, 'Sérgio Luís da Paz', 'Rua Major Clarindo Fundão, 250, Centro, Alegre, ES', '28 99944-9188', '371.727.930-05', '1992-09-07', 'sergioluisdapaz@email', '12345', 'P', 0, NULL, NULL),
(6, 'Lívia Carolina Aparício', 'Avenida Jerônimo Monteiro 133', '28 98260-9686', '513.473.357-06', '1992-02-22', 'liviacarolinaap@email.com', '12345', 'C', 0, NULL, NULL),
(7, 'Luzia Beatriz Allana Nogueira', 'Rodovia ES-185, s/n', '28 99104-9205', '622.742.667-94', '1990-02-18', 'luzia_beatriz_nogueira@email', '1234', 'C', 0, NULL, NULL),
(8, 'Diogo Erick Nelson Rezende', 'Rodovia ES-185, s/n', '28 99793-8384', '949.384.687-35', '1999-05-12', 'diogo-rezende82@cenavip.com.br', '1234', 'P', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_contratante` int(11) NOT NULL,
  `valor` float NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `datas_disponiveis`
--
ALTER TABLE `datas_disponiveis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_servico` (`id_servico`),
  ADD KEY `id_venda` (`id_venda`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestador` (`id_prestador`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Índices de tabela `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_cnpj` (`cpf_cnpj`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contratante` (`id_contratante`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `datas_disponiveis`
--
ALTER TABLE `datas_disponiveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `datas_disponiveis`
--
ALTER TABLE `datas_disponiveis`
  ADD CONSTRAINT `datas_disponiveis_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id`),
  ADD CONSTRAINT `datas_disponiveis_ibfk_2` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`);

--
-- Restrições para tabelas `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`id_prestador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `servicos_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_contratante`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
