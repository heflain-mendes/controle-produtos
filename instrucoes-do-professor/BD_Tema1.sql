-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Maio-2017 às 03:05
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empresa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `CodCli` decimal(4,0) DEFAULT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Endereco` varchar(50) DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `CPF` varchar(13) DEFAULT NULL,
  `DtNascimento` datetime DEFAULT NULL,
  `Email` varchar(20) DEFAULT NULL,
  `Senha` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`CodCli`, `Nome`, `Endereco`, `Telefone`, `CPF`, `DtNascimento`, `Email`, `Senha`) VALUES
('1234', 'Orígenes Lessa', NULL, '1234-5676', NULL, '1903-07-12 00:00:00', NULL, NULL),
('1235', 'Rachel de Queiroz', NULL, '1234-5679', NULL, '1910-11-17 00:00:00', NULL, NULL),
('1236', 'Dias Gomes', NULL, '1234-5671', NULL, '1922-10-19 00:00:00', NULL, NULL),
('1237', 'Raul Pompéia', NULL, '1234-5672', NULL, '1863-04-12 00:00:00', NULL, NULL),
('1238', 'Rui Barbosa', NULL, '1234-5673', NULL, '1849-11-05 00:00:00', NULL, NULL),
('1239', 'Ariano Suassuna', NULL, '1234-5677', NULL, '1927-06-16 00:00:00', NULL, NULL),
('1230', 'Aurélio Buarque de Holanda', NULL, '1234-5674', NULL, '1910-05-02 00:00:00', NULL, NULL),
('1231', 'Luis Fernando Veríssimo', NULL, '1234-5675', NULL, '1936-09-26 00:00:00', NULL, NULL),
('1232', 'Tobias Barreto', NULL, '1234-5680', NULL, '1839-06-07 00:00:00', NULL, NULL),
('1233', 'José de Alencar', NULL, '1234-5681', NULL, '1829-05-01 00:00:00', NULL, NULL),
('4321', 'Olavo Bilac', NULL, '1234-5682', NULL, '1865-12-16 00:00:00', NULL, NULL),
('4322', 'Lygia Fagundes Telles', NULL, '1234-5678', NULL, '1923-04-19 00:00:00', NULL, NULL),
('4323', 'Lima Barreto', NULL, '1234-5683', NULL, '1881-05-13 00:00:00', NULL, NULL),
('4324', 'Jorge Amado', NULL, '1234-5684', NULL, '1912-08-10 00:00:00', NULL, NULL),
('4325', 'Machado de Assis', NULL, '1234-5685', NULL, '1839-06-21 00:00:00', NULL, NULL),
('4326', 'Gregório de Matos Guerra', NULL, '1234-5686', NULL, '1623-04-07 00:00:00', NULL, NULL),
('4327', 'Euclides da Cunha', NULL, '1234-5687', NULL, '1866-01-20 00:00:00', NULL, NULL),
('4328', 'João Cabral de Melo Neto', NULL, '1234-5688', NULL, '1920-01-09 00:00:00', NULL, NULL),
('4329', 'João Ubaldo Ribeiro', NULL, '1234-5670', NULL, '1941-01-23 00:00:00', NULL, NULL),
('4330', 'Otto Lara Resende', NULL, '1234-5689', NULL, '1922-05-01 00:00:00', NULL, NULL),
('4331', 'Castro Alves', NULL, '1234-5690', NULL, '1847-03-14 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `datasdisponiveis`
--

CREATE TABLE `datasdisponiveis` (
  `id_servico` int(11) NOT NULL,
  `id_disponibilidade` int(11) NOT NULL,
  `data` date NOT NULL,
  `disponivel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `descricao` text NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `Cod_venda` int(11) NOT NULL,
  `Cod_cliente` int(11) DEFAULT NULL,
  `Cod_produto` int(11) DEFAULT NULL,
  `Valor_total` float DEFAULT NULL,
  `Quantidade_itens` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datasdisponiveis`
--
ALTER TABLE `datasdisponiveis`
  ADD PRIMARY KEY (`id_disponibilidade`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD UNIQUE KEY `Cod_venda` (`Cod_venda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `Cod_venda` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
