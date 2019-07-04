-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jul-2019 às 13:51
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `andhub`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(10) UNSIGNED NOT NULL,
  `site` varchar(50) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `flgstatus` char(1) DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id`, `site`, `nome`, `flgstatus`) VALUES
(3, 'www.sansung.com', 'Sansung', 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rom`
--

CREATE TABLE `rom` (
  `id` int(10) UNSIGNED NOT NULL,
  `versao` varchar(10) DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `Sistema` int(11) NOT NULL,
  `Codnome` varchar(50) NOT NULL,
  `RomGit` varchar(50) DEFAULT NULL,
  `Smartphone` int(11) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `flgstatus` char(1) DEFAULT 'C',
  `atualizacao` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `desenvolvedor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rom`
--

INSERT INTO `rom` (`id`, `versao`, `site`, `Sistema`, `Codnome`, `RomGit`, `Smartphone`, `link`, `data`, `flgstatus`, `atualizacao`, `status`, `desenvolvedor`) VALUES
(2, '1.0', 'www.rom.com', 3, 'aicp', 'git.aicp.com', 1, 'www.thisrom.com', '0000-00-00', 'C', 'semanal', 'stable', 'John');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

CREATE TABLE `sistema` (
  `id` int(10) UNSIGNED NOT NULL,
  `versao` varchar(20) DEFAULT NULL,
  `Codnome` varchar(50) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `flgstatus` char(1) DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`id`, `versao`, `Codnome`, `nome`, `flgstatus`) VALUES
(3, '6.0', 'Marshmalow', 'Android', 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `smartphone`
--

CREATE TABLE `smartphone` (
  `id` int(10) UNSIGNED NOT NULL,
  `marca` int(11) NOT NULL,
  `modelo` varchar(10) NOT NULL,
  `codnome` varchar(20) DEFAULT NULL,
  `CPU` varchar(50) DEFAULT NULL,
  `GPU` varchar(50) DEFAULT NULL,
  `Ram` varchar(10) DEFAULT NULL,
  `Armazenamento` varchar(10) DEFAULT NULL,
  `Chipset` varchar(50) DEFAULT NULL,
  `Display` varchar(50) DEFAULT NULL,
  `Rede` varchar(10) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `flgstatus` char(1) DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `smartphone`
--

INSERT INTO `smartphone` (`id`, `marca`, `modelo`, `codnome`, `CPU`, `GPU`, `Ram`, `Armazenamento`, `Chipset`, `Display`, `Rede`, `nome`, `flgstatus`) VALUES
(1, 3, 'd', 'f', 'g', 'a', 's', 'd', 'f', 's', 's', 'a', 'C');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_Marca_id` (`id`),
  ADD UNIQUE KEY `idx_Marca_Nome` (`nome`);

--
-- Índices para tabela `rom`
--
ALTER TABLE `rom`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `smartphone`
--
ALTER TABLE `smartphone`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_Smartphone_smartphone_id` (`id`),
  ADD UNIQUE KEY `idx_Smartphone_modelo` (`modelo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `rom`
--
ALTER TABLE `rom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `sistema`
--
ALTER TABLE `sistema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `smartphone`
--
ALTER TABLE `smartphone`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
