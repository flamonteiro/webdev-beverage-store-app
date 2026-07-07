-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Maio-2017 às 01:27
-- Alteration Time: 07-Julho-2026
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distribuidora`
--
CREATE DATABASE IF NOT EXISTS `distribuidora` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `distribuidora`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bebidas`
--

CREATE TABLE `bebidas` (
  `id_bebida` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `volume` varchar(7) NOT NULL,
  `preco` float NOT NULL,
  `peso` float NOT NULL,
  `qde_estoque` int(11) NOT NULL,
  `fabricante` varchar(20) NOT NULL,
  `imagem` varchar(100) NOT NULL DEFAULT 'drinklogo.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bebidas`
-- volume deve casar com /^\d+([.,]\d+)?\s?(ml|L)$/i e qde_estoque deve ser inteiro (models/bebida.inc.php)
--

INSERT INTO `bebidas` (`id_bebida`, `nome`, `volume`, `preco`, `peso`, `qde_estoque`, `fabricante`, `imagem`) VALUES
(1, 'Cerveja Pilsen', '350ml', 4.5, 0.35, 197, 'Ambev', 'cerveja-pilsen.jpeg'),
(2, 'Cerveja IPA', '473ml', 9.9, 0.5, 0, 'Craft', 'cerveja-ipa.webp'),
(3, 'Refrigerante Cola', '2L', 8, 2.1, 144, 'CocaCola', 'refrigerante-cola.avif'),
(4, 'Agua Mineral Crystal', '500ml', 2.5, 0.5, 293, 'Crystal', 'agua-mineral.jpeg'),
(5, 'Energetico RedBull', '250ml', 7.5, 0.25, 91, 'RedBull', 'energetico.webp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `id_cidade` int(11) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `valorfrete_porPeso` float NOT NULL,
  `peso` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cidades`
-- estado deve ser uma UF valida e CEP deve casar com /^\d{5}-?\d{3}$/ (models/cidade.inc.php)
--

INSERT INTO `cidades` (`id_cidade`, `cidade`, `estado`, `CEP`, `valorfrete_porPeso`, `peso`) VALUES
(1, 'Alegre', 'ES', '29500-000', 0.05, 10),
(2, 'Vitoria', 'ES', '29010-000', 0.18, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `tipo` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes`
-- cnpj e sempre normalizado e gravado com mascara 00.000.000/0000-00 (models/cliente.inc.php)
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cnpj`, `endereco`, `id_cidade`, `email`, `senha`, `tipo`) VALUES
(1, 'Administrador', '00.000.000/0001-00', 'Rua Admin, 1', 1, 'admin@distribuidora.com', 'admin123', 'A'),
(2, 'Estabelecimento teste 1', '00.000.000/0000-01', 'rua teste, n 10', 1, 'cliente@teste.com', '1234567', 'C'),
(3, 'Distribuidora Vix Bebidas', '11.222.333/0001-81', 'Av. Central, 500', 2, 'contato@vixbebidas.com', 'senha123', 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_compra` date NOT NULL,
  `valor_total` float NOT NULL,
  `valortotal_frete` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_compra`
--

CREATE TABLE `itens_compra` (
  `id_item` int(11) NOT NULL,
  `id_bebida` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_item` float NOT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`id_bebida`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id_cidade`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indexes for table `itens_compra`
--
ALTER TABLE `itens_compra`
  ADD PRIMARY KEY (`id_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `id_bebida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `itens_compra`
--
ALTER TABLE `itens_compra`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
