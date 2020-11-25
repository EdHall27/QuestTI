-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.11-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela questti.administracao
CREATE TABLE IF NOT EXISTS `administracao` (
  `nome` longtext DEFAULT NULL,
  `cnpj` longtext DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senha` longtext DEFAULT NULL,
  `tipo_user` int(11) DEFAULT NULL,
  `endereco` longtext DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `cep` longtext DEFAULT NULL,
  `telefone` text DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela questti.administracao: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `administracao` DISABLE KEYS */;
INSERT INTO `administracao` (`nome`, `cnpj`, `id`, `senha`, `tipo_user`, `endereco`, `email`, `cep`, `telefone`, `celular`, `status`) VALUES
	('admin2', '777789', 65, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0, 'Rua 2', 'admin@admin.com', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `administracao` ENABLE KEYS */;

-- Copiando estrutura para tabela questti.areaatuacao
CREATE TABLE IF NOT EXISTS `areaatuacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NomeArea` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela questti.areaatuacao: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `areaatuacao` DISABLE KEYS */;
INSERT INTO `areaatuacao` (`id`, `NomeArea`) VALUES
	(31, 'Suporte técnico'),
	(32, 'Segurança da Informação'),
	(33, 'Programação'),
	(34, 'Qualidade de Software'),
	(35, 'Administração de Redes'),
	(36, 'Programador mobile'),
	(37, 'Administração de banco de dados'),
	(38, 'Especialista em Cloud Computings'),
	(39, 'Especialista em e-commerce'),
	(40, 'Qualidade de software');
/*!40000 ALTER TABLE `areaatuacao` ENABLE KEYS */;

-- Copiando estrutura para tabela questti.chamado
CREATE TABLE IF NOT EXISTS `chamado` (
  `id_chamado` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `descricao` longtext DEFAULT NULL,
  `cpf_cliente` bigint(20) DEFAULT NULL,
  `cpf_tecnico` bigint(20) DEFAULT NULL,
  `categoria` longtext DEFAULT NULL,
  `assunto` longtext DEFAULT NULL,
  `arquivo` longtext DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `data_abertura` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id_chamado`) USING BTREE,
  KEY `cpf_cliente` (`cpf_cliente`),
  KEY `cpf_tecnico` (`cpf_tecnico`),
  CONSTRAINT `FK_chamado_cliente_cli` FOREIGN KEY (`cpf_cliente`) REFERENCES `cliente_cli` (`cpf_cli`),
  CONSTRAINT `FK_chamado_tecnico` FOREIGN KEY (`cpf_tecnico`) REFERENCES `tecnico` (`cpf_tec`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela questti.chamado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `chamado` DISABLE KEYS */;
INSERT INTO `chamado` (`id_chamado`, `status`, `descricao`, `cpf_cliente`, `cpf_tecnico`, `categoria`, `assunto`, `arquivo`, `avaliacao`, `data_abertura`, `data_fim`) VALUES
	(25, 4, 'TESTE', 15841884187, 15184174785, 'Segurança da Informação', ' 		   ORCAMENTO E FINANCAS 		   		  			 		      ', '5f8dd75e3771d.pdf', 5, '2020-10-19 15:13:50', NULL),
	(26, 1, 'TESTE', 10154848482, 6218484847, 'Segurança da Informação', ' 		   ORCAMENTO E FINANCAS 		   		  			 		      ', '5f8dd75e3771d.pdf', NULL, '2020-10-19 15:13:50', NULL),
	(27, 0, 'DSADA', 10154848482, 15184174785, 'Especialista em Cloud Computings', 'TESATE', NULL, NULL, '2020-10-19 17:15:19', NULL);
/*!40000 ALTER TABLE `chamado` ENABLE KEYS */;

-- Copiando estrutura para tabela questti.cliente_cli
CREATE TABLE IF NOT EXISTS `cliente_cli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `cpf_cli` bigint(20) NOT NULL DEFAULT 0,
  `endereco` varchar(45) DEFAULT NULL,
  `telefone` text DEFAULT NULL,
  `cep` longtext DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `tipo_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `cpf_cli` (`cpf_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela questti.cliente_cli: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente_cli` DISABLE KEYS */;
INSERT INTO `cliente_cli` (`id`, `nome`, `email`, `senha`, `cpf_cli`, `endereco`, `telefone`, `cep`, `celular`, `tipo_user`, `status`) VALUES
	(22, 'João Pedro Fernandes', 'joao-pedro-f@kk.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(23, 'João Pedro Fernandes', 'joao-pedro-f@kff.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(24, 'João Pedro Fernandes', 'joao-pedro-f@dd.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(25, 'João Pedro Fernandes', 'joao-pedro-f@sss.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(26, 'João Pedro Fernandes', 'joao-pedro-f@d.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(27, 'João Pedro Fernandes', 'joao-pedro-f@dazx.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(28, 'João Pedro Fernandes', 'joao-pedro-f@xxxxx.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(29, 'João Pedro Fernandes', 'joao-pedro-f@xxxxx.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848484, 'rua rocha', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(30, 'João Pedro Fernando', 'joao-pedro-f@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 10154848482, 'rua rocho', '(26)4184-1841', '41515-645', '(45)45485-4848', 1, NULL),
	(31, 'João Pedro Fernandes', 'joao-pedro-f@xx.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 15841884184, 'rua rocha', '(26)4184-1841', '41515-645', '(15)41778-4784', 1, 1),
	(32, 'João Pedro Fernandes', 'joao-pedro-f@gg.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 15841884187, 'rua rocha', '(26)4184-1841', '41515-645', '(15)41778-4784', 1, 1),
	(33, 'Joao Pedro Fernandes', 'joao-pedro-f@zzz.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5158418184, 'rua rocha', '(26)4184-1841', '41515-645', '(18)47848-4848', 1, NULL),
	(34, 'Joao Pedro Fernandes', 'joao-pedro-f@pp.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5158418189, 'rua rocha', '(26)4184-1841', '41515-645', '(18)47848-4848', 1, NULL),
	(35, 'Joao Pedro Fernandes', 'joao-pedro-f@ppz.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5158418190, 'rua rocha', '(26)4184-1841', '41515-645', '(18)47848-4848', 1, NULL),
	(36, 'Joao Pedro Fernandes', 'joao-pedro-f@dsadas.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5158418192, 'rua rocha', '(26)4184-1841', '41515-645', '(18)47848-4848', 1, NULL),
	(37, 'Joao Pedro Fernandes', 'joao-pedro-f@uu.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5158418188, 'rua rocha', '(26)4184-1841', '41515-645', '(18)47848-4848', 1, NULL),
	(38, 'Joao Pedro Fernandes', 'joao-pedro-f@pdsadp.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 5158418158, 'rua rocha', '(26)4184-1841', '41515-645', '(18)47848-4848', 1, NULL),
	(39, 'Novo Test', 'joaquim@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 11555555555, 'rua rocha', '(26)4184-1841', '41515-645', '(56)11841-8418', 1, NULL),
	(40, 'Novo Test', 'joaquim@x.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 11555555557, 'rua rocha', '(26)4184-1841', '41515-645', '(56)11841-8418', 1, 1);
/*!40000 ALTER TABLE `cliente_cli` ENABLE KEYS */;

-- Copiando estrutura para tabela questti.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tb` int(11) DEFAULT NULL,
  `NomeEntidade` text DEFAULT NULL,
  `TipoMov` int(11) DEFAULT NULL,
  `data_mod` datetime DEFAULT NULL,
  `responsavel` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_logs_movimentacao` (`TipoMov`),
  CONSTRAINT `FK_logs_movimentacao` FOREIGN KEY (`TipoMov`) REFERENCES `movimentacao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='Aqui é onde fica salvo todas ações executadas dentro do sistema';

-- Copiando dados para a tabela questti.logs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `id_tb`, `NomeEntidade`, `TipoMov`, `data_mod`, `responsavel`) VALUES
	(1, NULL, NULL, 1, NULL, NULL);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Copiando estrutura para tabela questti.movimentacao
CREATE TABLE IF NOT EXISTS `movimentacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NomeMov` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela questti.movimentacao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `movimentacao` DISABLE KEYS */;
INSERT INTO `movimentacao` (`id`, `NomeMov`) VALUES
	(1, 'exclusão'),
	(2, 'exclusão');
/*!40000 ALTER TABLE `movimentacao` ENABLE KEYS */;

-- Copiando estrutura para tabela questti.tecnico
CREATE TABLE IF NOT EXISTS `tecnico` (
  `id_tec` int(11) NOT NULL AUTO_INCREMENT,
  `area_atuacao` int(11) DEFAULT NULL,
  `nome` longtext DEFAULT NULL,
  `cpf_tec` bigint(11) NOT NULL DEFAULT 0,
  `certificado` longtext DEFAULT NULL,
  `telefone` text DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `endereco` longtext DEFAULT NULL,
  `cep` text DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `senha` longtext DEFAULT NULL,
  `tipo_user` int(11) DEFAULT NULL,
  `avaliacao` float DEFAULT NULL,
  PRIMARY KEY (`id_tec`) USING BTREE,
  KEY `cpf_tec` (`cpf_tec`),
  KEY `area_atuacao` (`area_atuacao`),
  CONSTRAINT `FK_tecnico_areaatuacao` FOREIGN KEY (`area_atuacao`) REFERENCES `areaatuacao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela questti.tecnico: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tecnico` DISABLE KEYS */;
INSERT INTO `tecnico` (`id_tec`, `area_atuacao`, `nome`, `cpf_tec`, `certificado`, `telefone`, `email`, `endereco`, `cep`, `celular`, `status`, `senha`, `tipo_user`, `avaliacao`) VALUES
	(77, 39, 'Josafá', 15184174785, NULL, '(26)4184-1841', 'josafaoreo@hotmail.com', 'rua rochaaa', '41515-645', '(41)85151-5815', 1, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2, 5),
	(106, 32, 'João Pedro Fernandes', 6218484847, '0', '(26)4184-1841', 'joao-pedro-f@hotmail.com', 'rua rocha', '41515-645', '(14)11891-7841', 1, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2, 1),
	(107, 32, 'Marcos', 6218484860, '0', '(26)4184-1841', 'marcos@gmail.com', 'rua rocha', '41515-645', '(14)11891-7841', 0, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2, 1),
	(108, 32, 'Vinicius Carlos', 6218484872, '0', '(26)4184-1841', 'vinicius@gmail.com', 'rua rocha', '41515-645', '(14)11891-7841', 0, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2, 1),
	(109, 34, 'Rogerio', 10561584184, '342d779e7a587de0fac35b6e649967e6.sql', '(26)4184-1841', 'rogerio@yahoo.com', 'Rua 1', '41515-645', '(48)41854-8484', 0, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 2, 3);
/*!40000 ALTER TABLE `tecnico` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
