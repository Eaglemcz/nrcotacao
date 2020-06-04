-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jun-2020 às 20:48
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brparafu_nrcotacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `nrc_categoria_a`
--

CREATE TABLE `nrc_categoria_a` (
  `id` int(11) NOT NULL,
  `nrc_categoria_a_codigo` int(11) NOT NULL,
  `nrc_categoria_a_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nrc_cliente_a`
--

CREATE TABLE `nrc_cliente_a` (
  `id` int(11) NOT NULL,
  `nrc_cliente_a_codigo` varchar(255) NOT NULL,
  `nrc_cliente_a_nomeempresa` varchar(255) NOT NULL,
  `nrc_cliente_a_logo` varchar(255) NOT NULL,
  `nrc_cliente_a_cnpj` varchar(255) NOT NULL,
  `nrc_cliente_a_razaosocial` varchar(255) NOT NULL,
  `nrc_cliente_a_inscricaoestadual` varchar(255) NOT NULL,
  `nrc_cliente_a_nomecontato` varchar(255) NOT NULL,
  `nrc_cliente_a_telefone` varchar(255) NOT NULL,
  `nrc_cliente_a_fax` varchar(255) NOT NULL,
  `nrc_cliente_a_celular` varchar(255) NOT NULL,
  `nrc_cliente_a_comunicadorinstantaneo` varchar(255) NOT NULL,
  `nrc_cliente_a_email` varchar(255) NOT NULL,
  `nrc_cliente_a_site` varchar(255) NOT NULL,
  `nrc_cliente_a_endereco` varchar(255) NOT NULL,
  `nrc_cliente_a_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nrc_cliente_a`
--

INSERT INTO `nrc_cliente_a` (`id`, `nrc_cliente_a_codigo`, `nrc_cliente_a_nomeempresa`, `nrc_cliente_a_logo`, `nrc_cliente_a_cnpj`, `nrc_cliente_a_razaosocial`, `nrc_cliente_a_inscricaoestadual`, `nrc_cliente_a_nomecontato`, `nrc_cliente_a_telefone`, `nrc_cliente_a_fax`, `nrc_cliente_a_celular`, `nrc_cliente_a_comunicadorinstantaneo`, `nrc_cliente_a_email`, `nrc_cliente_a_site`, `nrc_cliente_a_endereco`, `nrc_cliente_a_usuario`) VALUES
(2, '20200001', 'BR PARAFUSOS', '', '02.556.423/0001-18', 'BR PARAFUSOS IMPORTADORA COMERCIAL LTDA.', '240941705', 'CLAUDIA', '(82) 3311-5404', '(82) 3311-5417', '(82) 9 9669-1819', 'WHATSAPP', 'COMPRAS02@BRPARAFUSOS.COM.BR', 'https://www.brparafusos.com.br', 'AVENIDA DEPUTADO SERZEDELO DE BARROS CORREIA, 600 - CLIMA BOM - MACEIO - AL', 'CLAUDIA'),
(3, '20200002', 'NR FERRAGENS', '', '11.627.035/0001-71', 'N. R. FERRAGENS EIRELI', '', 'Nadja', '(82) 3305-0005', '(82) 3305-0005', '(82) 9 9669-1881', 'Whatsapp', 'financeiro.arapiraca@brparafusos.com.br', 'https://www.brparafusos.com.br', 'R Marechal Deodoro da Fonseca, 519\r\nBrasilia - Arapiraca/AL\r\n57.313-010', 'nrferragens');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nrc_fornecedor_a`
--

CREATE TABLE `nrc_fornecedor_a` (
  `id` int(11) NOT NULL,
  `nrc_fornecedor_a_codigo` varchar(255) NOT NULL,
  `nrc_fornecedor_a_nomeempresa` varchar(255) NOT NULL,
  `nrc_fornecedor_a_cnpj` varchar(255) NOT NULL,
  `nrc_fornecedor_a_razaosocial` varchar(255) NOT NULL,
  `nrc_fornecedor_a_inscricaoestadual` varchar(255) NOT NULL,
  `nrc_fornecedor_a_nomecontato` varchar(255) NOT NULL,
  `nrc_fornecedor_a_telefone` varchar(255) NOT NULL,
  `nrc_fornecedor_a_fax` varchar(255) NOT NULL,
  `nrc_fornecedor_a_celular` varchar(255) NOT NULL,
  `nrc_fornecedor_a_comunicadorinstantaneo` varchar(255) NOT NULL,
  `nrc_fornecedor_a_email` varchar(255) NOT NULL,
  `nrc_fornecedor_a_site` varchar(255) NOT NULL,
  `nrc_fornecedor_a_endereco` varchar(255) NOT NULL,
  `nrc_fornecedor_a_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `nrc_fornecedor_a`
--

INSERT INTO `nrc_fornecedor_a` (`id`, `nrc_fornecedor_a_codigo`, `nrc_fornecedor_a_nomeempresa`, `nrc_fornecedor_a_cnpj`, `nrc_fornecedor_a_razaosocial`, `nrc_fornecedor_a_inscricaoestadual`, `nrc_fornecedor_a_nomecontato`, `nrc_fornecedor_a_telefone`, `nrc_fornecedor_a_fax`, `nrc_fornecedor_a_celular`, `nrc_fornecedor_a_comunicadorinstantaneo`, `nrc_fornecedor_a_email`, `nrc_fornecedor_a_site`, `nrc_fornecedor_a_endereco`, `nrc_fornecedor_a_usuario`) VALUES
(1, '260520201017', 'BukOne', '07.073.715/0001-13', 'Pontes e Soares InformÃ¡tica Ltda.', 'ISENTO', 'Sandra Soares', '(82) 2123-0805', '(82) 2123-0805', '(82) 9 8818-0240', 'Whatsapp', 'sandra.soares@bukone.com.br', 'https://www.bukone.com.br/', 'Rua Dr JosÃ© Milton Correia, 80 - MaceiÃ³-AL - 57025-100', 'bukone');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nrc_orcamento_a`
--

CREATE TABLE `nrc_orcamento_a` (
  `id` int(11) NOT NULL,
  `nrc_orcamento_a_codigo` varchar(255) NOT NULL,
  `nrc_orcamento_a_descricao` varchar(255) NOT NULL,
  `nrc_orcamento_a_situacao` varchar(255) NOT NULL,
  `nrc_orcamento_a_datainicio` date NOT NULL,
  `nrc_orcamento_a_datafechamento` date NOT NULL,
  `nrc_orcamento_a_observacao` varchar(255) NOT NULL,
  `nrc_orcamento_a_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nrc_orcamento_a`
--

INSERT INTO `nrc_orcamento_a` (`id`, `nrc_orcamento_a_codigo`, `nrc_orcamento_a_descricao`, `nrc_orcamento_a_situacao`, `nrc_orcamento_a_datainicio`, `nrc_orcamento_a_datafechamento`, `nrc_orcamento_a_observacao`, `nrc_orcamento_a_cliente`) VALUES
(2, '20200323001', 'Carros de mao', 'Em Pausa', '2020-03-25', '2020-03-30', '', 20200001),
(3, '250520201553', 'Botas', 'Em Pausa', '2020-06-01', '2020-06-12', 'Botas Fujiwara 40, 41, 42, 43 e 44', 20200002),
(4, '250520201204', 'Cordas', 'Em Pausa', '2020-06-01', '2020-06-12', 'Cordas', 20200002);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nrc_orcamento_produto_a`
--

CREATE TABLE `nrc_orcamento_produto_a` (
  `id` int(11) NOT NULL,
  `nrc_orcamento_produto_a_codigo` int(11) NOT NULL,
  `nrc_orcamento_produto_a_quantidade` int(11) NOT NULL,
  `nrc_orcamento_produto_a_unidade` varchar(255) NOT NULL,
  `nrc_orcamento_produto_a_prazoentrega` date NOT NULL,
  `nrc_orcamento_produto_a_observacao` text NOT NULL,
  `nrc_orcamento_produto_a_orcamento` int(11) NOT NULL,
  `nrc_orcamento_produto_a_produto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `nrc_orcamento_produto_a`
--

INSERT INTO `nrc_orcamento_produto_a` (`id`, `nrc_orcamento_produto_a_codigo`, `nrc_orcamento_produto_a_quantidade`, `nrc_orcamento_produto_a_unidade`, `nrc_orcamento_produto_a_prazoentrega`, `nrc_orcamento_produto_a_observacao`, `nrc_orcamento_produto_a_orcamento`, `nrc_orcamento_produto_a_produto`) VALUES
(1, 12715, 10, 'PÃ‡', '2020-06-12', '', 2, 'CARRO DE MAO SCHNEIDER CLASSIC - PNEU/CAMARA'),
(2, 21674, 100, 'PAR', '2020-06-12', '', 3, 'BOTA AMARELO PRETO FUJIWARA 4059HAPN6600LG N 40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nrc_produto_a`
--

CREATE TABLE `nrc_produto_a` (
  `id` int(11) NOT NULL,
  `nrc_produto_a_codigo` int(11) NOT NULL,
  `nrc_produto_a_nome` varchar(255) NOT NULL,
  `nrc_produto_a_subcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nrc_subcategoria_a`
--

CREATE TABLE `nrc_subcategoria_a` (
  `id` int(11) NOT NULL,
  `nrc_subcategoria_a_codigo` int(11) NOT NULL,
  `nrc_subcategoria_a_nome` varchar(255) NOT NULL,
  `nrc_subcategoria_a_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nrc_categoria_a`
--
ALTER TABLE `nrc_categoria_a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nrc_cliente_a`
--
ALTER TABLE `nrc_cliente_a`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nrc_cliente_a_codigo` (`nrc_cliente_a_codigo`);

--
-- Indexes for table `nrc_fornecedor_a`
--
ALTER TABLE `nrc_fornecedor_a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nrc_orcamento_a`
--
ALTER TABLE `nrc_orcamento_a`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nrc_orcamento_a_cliente` (`nrc_orcamento_a_cliente`),
  ADD KEY `nrc_orcamento_a_cliente_2` (`nrc_orcamento_a_cliente`);

--
-- Indexes for table `nrc_orcamento_produto_a`
--
ALTER TABLE `nrc_orcamento_produto_a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nrc_produto_a`
--
ALTER TABLE `nrc_produto_a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nrc_subcategoria_a`
--
ALTER TABLE `nrc_subcategoria_a`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nrc_categoria_a`
--
ALTER TABLE `nrc_categoria_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nrc_cliente_a`
--
ALTER TABLE `nrc_cliente_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nrc_fornecedor_a`
--
ALTER TABLE `nrc_fornecedor_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nrc_orcamento_a`
--
ALTER TABLE `nrc_orcamento_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nrc_orcamento_produto_a`
--
ALTER TABLE `nrc_orcamento_produto_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nrc_produto_a`
--
ALTER TABLE `nrc_produto_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nrc_subcategoria_a`
--
ALTER TABLE `nrc_subcategoria_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
