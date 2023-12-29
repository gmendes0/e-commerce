-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Abr-2019 às 06:13
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

USE `tcc3`;

--
-- Database: `tcc2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idfornecedor` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  `site` varchar(50) DEFAULT NULL,
  `numero` varchar(4) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `datacadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idfornecedor`, `nome`, `endereco`, `telefone`, `email`, `cnpj`, `site`, `numero`, `bairro`, `uf`, `ativo`, `datacadastro`) VALUES
(1, 'nenhum', '0000', '0000', '0000', '0000', '0000', '00', '0000', 'SP', 1, '0000-00-00 00:00:00'),
(2, 'bosh', 'Rua Cravo Branco', '(27)3680-5530', 'iagobenjaminvitorbarbosa_@hmhabitacoesmoderna', '618.435.548-10', 'https://www.bosch.com.br/', '953', '953', 'ES', 1, '2019-04-08 05:44:16'),
(3, 'Esab', 'Rua Denise Marangoni', '(92)3898-5597', 'vitorthomasdarosa..vitorthomasdarosa@alway.co', '426.385.071-80', 'https://www.esab.com.br/br/pt/index.cfm', '241', '241', 'AM', 1, '2019-04-08 06:03:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idproduto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `detalhes_tecnicos` varchar(300) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `ativo` tinyint(4) NOT NULL,
  `fornecedor_idfornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idproduto`, `nome`, `valor`, `descricao`, `detalhes_tecnicos`, `foto`, `ativo`, `fornecedor_idfornecedor`) VALUES
(6, 'Inversora de Solda HandyArc 130i 110V', '846.23', '0000000', '0000000', 'fotage/handyarc130i.png', 1, 1),
(7, 'Lavadora Residencial K2', '299.90', '0000000', '0000000', 'fotage/19944600.jpg', 1, 1),
(8, 'Esmerilhadeira 4.1/2\" 670W GWS 6-115', '269.99', '0000000', '0000000', 'fotage/248776_new.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `usuariocol` varchar(50) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `nascimento` date NOT NULL,
  `datacadastro` datetime NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `idvenda` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `produto_idproduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idfornecedor`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idproduto`),
  ADD KEY `fk_produto_fornecedor1_idx` (`fornecedor_idfornecedor`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`idvenda`),
  ADD KEY `fk_venda_usuario_idx` (`usuario_idusuario`),
  ADD KEY `fk_venda_produto1_idx` (`produto_idproduto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idfornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `idvenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_fornecedor1` FOREIGN KEY (`fornecedor_idfornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_venda_produto1` FOREIGN KEY (`produto_idproduto`) REFERENCES `produto` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venda_usuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
