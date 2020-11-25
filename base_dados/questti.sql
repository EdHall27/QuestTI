-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jun-2020 às 02:00
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `questti`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administracao`
--

CREATE TABLE `administracao` (
  `nome` longtext DEFAULT NULL,
  `cnpj` longtext DEFAULT NULL,
  `id` int(11) NOT NULL,
  `senha` longtext DEFAULT NULL,
  `tipo_user` int(11) DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `endereco` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administracao`
--

INSERT INTO `administracao` (`nome`, `cnpj`, `id`, `senha`, `tipo_user`, `email`, `endereco`) VALUES
('admin', '77778', 1, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0, 'admin@admin.com', 'Rua 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamado`
--

CREATE TABLE `chamado` (
  `id_chamado` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `descricao` longtext DEFAULT NULL,
  `tipo_chamado` longtext DEFAULT NULL,
  `cpf_cliente` int(11) DEFAULT NULL,
  `cpf_tecnico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_cli`
--

CREATE TABLE `cliente_cli` (
  `id_cli` int(11) NOT NULL,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `cpf_cli` int(11) NOT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `cep` longtext DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tipo_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente_cli`
--

INSERT INTO `cliente_cli` (`id_cli`, `nome`, `email`, `senha`, `cpf_cli`, `endereco`, `telefone`, `cep`, `celular`, `status`, `tipo_user`) VALUES
(1, 'joao pedro', 'joao-pedro-f@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 83050610, 'Rua Laura Nunes Fernandes', 413555885, '83050610', 11521515, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tecnico`
--

CREATE TABLE `tecnico` (
  `id_tec` int(11) NOT NULL,
  `area_atuacao` longtext DEFAULT NULL,
  `nome` longtext DEFAULT NULL,
  `cpf_tec` int(11) DEFAULT NULL,
  `certificado` longtext DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `endereco` longtext DEFAULT NULL,
  `cep` longtext DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `senha` longtext DEFAULT NULL,
  `tipo_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tecnico`
--

INSERT INTO `tecnico` (`id_tec`, `area_atuacao`, `nome`, `cpf_tec`, `certificado`, `telefone`, `email`, `endereco`, `cep`, `celular`, `status`, `senha`, `tipo_user`) VALUES
(1, 'Programação', 'João Técnico', 0, '../uploads/exemplo.pdf', 2147483647, 'joao_tecnico@gmail.com', 'rua 1', '830506584', 78458, 1, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2),
(2, 'Qualidade de Software', 'Roger Tecnico', 789, '../uploads/exemplo.pdf', 2147483647, 'roger_tecnico@hotmail.com', 'Rua Laura 3', '83050610', 184847848, 0, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2),
(3, 'Qualidade de Software', 'Maicon Tecnico', 789, '../uploads/exemplo.pdf', 2147483647, 'roger_tecnico@hotmail.com', 'Rua Laura 3', '83050610', 184847848, 0, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administracao`
--
ALTER TABLE `administracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`id_chamado`);

--
-- Índices para tabela `cliente_cli`
--
ALTER TABLE `cliente_cli`
  ADD PRIMARY KEY (`id_cli`);

--
-- Índices para tabela `tecnico`
--
ALTER TABLE `tecnico`
  ADD PRIMARY KEY (`id_tec`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamado`
--
ALTER TABLE `chamado`
  MODIFY `id_chamado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente_cli`
--
ALTER TABLE `cliente_cli`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tecnico`
--
ALTER TABLE `tecnico`
  MODIFY `id_tec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
