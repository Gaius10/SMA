-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 03/02/2018 às 23:31
-- Versão do servidor: 5.7.21-0ubuntu0.16.04.1
-- Versão do PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `SMA`
--
CREATE DATABASE IF NOT EXISTS `SMA` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SMA`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Almocar`
--

CREATE TABLE `Almocar` (
  `ALUNO_COD` int(11) NOT NULL,
  `ALMOCO_COD` int(11) NOT NULL,
  `REPETICOES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Almoco`
--

CREATE TABLE `Almoco` (
  `ALMOCO_COD` int(11) NOT NULL,
  `ALMOCO_CARDAPIO` varchar(255) NOT NULL,
  `ALMOCO_DATA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Aluno`
--

CREATE TABLE `Aluno` (
  `ALUNO_COD` int(11) NOT NULL,
  `ALUNO_NOME` varchar(255) NOT NULL,
  `ALUNO_TURMA` char(2) NOT NULL,
  `ALUNO_QRCODE` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gatilhos `Aluno`
--
DELIMITER $$
CREATE TRIGGER `UpdateUltimoAluno` AFTER INSERT ON `Aluno` FOR EACH ROW UPDATE UltimoAluno set COD = NEW.ALUNO_COD
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Autorizacao`
--

CREATE TABLE `Autorizacao` (
  `AUTORIZACAO_EMAIL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Monitor`
--

CREATE TABLE `Monitor` (
  `MONITOR_COD` int(11) NOT NULL,
  `MONITOR_NOME` varchar(255) NOT NULL,
  `MONITOR_EMAIL` varchar(255) NOT NULL,
  `MONITOR_LOGIN` varchar(255) NOT NULL,
  `MONITOR_SENHA` varchar(255) NOT NULL,
  `USER_PERMISSIONS` varchar(255) NOT NULL DEFAULT 'a:1:{i:0;s:3:"any";}',
  `SESSION_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `Monitor`
--

INSERT INTO `Monitor` (`MONITOR_COD`, `MONITOR_NOME`, `MONITOR_EMAIL`, `MONITOR_LOGIN`, `MONITOR_SENHA`, `USER_PERMISSIONS`, `SESSION_ID`) VALUES
(1, 'root', 'caio.chaves@etec.sp.gov.br', 'root', '$2a$10$tEIwh2Rk0i0MKft3hWjUmeBvOhFlCtrBh4Lz/ux0KeT6MG4rHXv2.', 'a:1:{i:0;s:4:"root";}', '16seibs98k31723816e1du3d01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Ocorrencia`
--

CREATE TABLE `Ocorrencia` (
  `OCORRENCIA_COD` int(11) NOT NULL AUTO_INCREMENT,
  `ALUNO_COD` int(11) NOT NULL,
  `ALUNO_OCORRENCIA` varchar(500) NOT NULL,

  PRIMARY KEY (`OCORRENCIA_COD`, `ALUNO_COD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estrutura para tabela `UltimoAluno`
--

CREATE TABLE `UltimoAluno` (
  `COD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `UltimoAluno`
--

INSERT INTO `UltimoAluno` (`COD`) VALUES
(7);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `Almocar`
--
ALTER TABLE `Almocar`
  ADD PRIMARY KEY (`ALUNO_COD`,`ALMOCO_COD`),
  ADD KEY `FK_ALMOCARxALMOCO` (`ALMOCO_COD`);

--
-- Índices de tabela `Almoco`
--
ALTER TABLE `Almoco`
  ADD PRIMARY KEY (`ALMOCO_COD`);

--
-- Índices de tabela `Aluno`
--
ALTER TABLE `Aluno`
  ADD PRIMARY KEY (`ALUNO_COD`);

--
-- Índices de tabela `Autorizacao`
--
ALTER TABLE `Autorizacao`
  ADD PRIMARY KEY (`AUTORIZACAO_EMAIL`);

--
-- Índices de tabela `Monitor`
--
ALTER TABLE `Monitor`
  ADD PRIMARY KEY (`MONITOR_COD`);

--
-- Índices de tabela `Ocorrencia`
--
-- ALTER TABLE `Ocorrencia`
--   ADD PRIMARY KEY (`OCORRENCIA_COD`, `ALUNO_COD`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `Almoco`
--
ALTER TABLE `Almoco`
  MODIFY `ALMOCO_COD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `Aluno`
--
ALTER TABLE `Aluno`
  MODIFY `ALUNO_COD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `Monitor`
--
ALTER TABLE `Monitor`
  MODIFY `MONITOR_COD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `Almocar`
--
ALTER TABLE `Almocar`
  ADD CONSTRAINT `FK_ALMOCARxALMOCO` FOREIGN KEY (`ALMOCO_COD`) REFERENCES `Almoco` (`ALMOCO_COD`),
  ADD CONSTRAINT `FK_ALMOCARxALUNO` FOREIGN KEY (`ALUNO_COD`) REFERENCES `Aluno` (`ALUNO_COD`);

--
-- Restrições para tabelas `Ocorrencia`
--
ALTER TABLE `Ocorrencia`
  ADD CONSTRAINT `FK_OCORRENCIAxALUNO` FOREIGN KEY (`ALUNO_COD`) REFERENCES `Aluno` (`ALUNO_COD`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
