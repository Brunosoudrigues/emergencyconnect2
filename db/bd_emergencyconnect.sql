-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22/11/2024 às 23:16
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_emergencyconnect`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `first_aid_reports`
--

DROP TABLE IF EXISTS `first_aid_reports`;
CREATE TABLE IF NOT EXISTS `first_aid_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_incident` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pain_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breathing` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `consciousness` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `injuries` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `allergies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medications` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencias`
--

DROP TABLE IF EXISTS `ocorrencias`;
CREATE TABLE IF NOT EXISTS `ocorrencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero_ocorrencia` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamanho` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalhes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_id` int NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_types_idx` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `questions`
--

INSERT INTO `questions` (`id`, `type_id`, `question`, `answer`) VALUES
(1, 1, 'Como posso ativar o recurso de emergência no EmergencyConnect?', 'Para ativar o recurso de emergência, abra o aplicativo e pressione o botão de emergência na tela principal.'),
(2, 1, 'Quais informações são necessárias para a autenticação?', 'Você precisará fornecer um endereço de e-mail válido e uma senha segura para autenticação.'),
(3, 1, 'O que devo fazer em caso de uma emergência médica?', 'Em uma emergência médica, use o aplicativo para contatar rapidamente os serviços médicos locais através do recurso de emergência.'),
(4, 1, 'O aplicativo oferece treinamento em primeiros socorros?', 'Sim, o EmergencyConnect inclui recursos educativos sobre primeiros socorros e práticas de segurança.'),
(5, 1, 'Como posso atualizar minhas informações pessoais no aplicativo?', 'Para atualizar suas informações pessoais, vá para a seção de perfil no aplicativo e edite seus dados.'),
(6, 1, 'Quais serviços de assistência estão disponíveis através do EmergencyConnect?', 'O EmergencyConnect conecta os usuários a serviços médicos, de incêndio e polícia, além de suporte em saúde mental.'),
(7, 2, 'O uso do EmergencyConnect é seguro?', 'Sim, o aplicativo utiliza autenticação segura para garantir que apenas emergências legítimas sejam relatadas.'),
(8, 2, 'Posso acessar o conteúdo educativo offline?', 'Sim, os usuários podem baixar materiais educativos para acesso offline.'),
(9, 1, 'Como posso fornecer feedback sobre o aplicativo?', 'Você pode fornecer feedback através do menu de configurações no aplicativo, em \"Feedback\".'),
(10, 1, 'O que fazer se o serviço de emergência não responder?', 'Se o serviço de emergência não responder, tente contatá-los diretamente ou procure ajuda de pessoas ou estabelecimentos próximos.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `services_categories`
--

DROP TABLE IF EXISTS `services_categories`;
CREATE TABLE IF NOT EXISTS `services_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `services_categories`
--

INSERT INTO `services_categories` (`id`, `name`) VALUES
(1, 'Consultoria'),
(2, 'Projetos'),
(3, 'ExecuÃ§Ã£o de Obras'),
(4, 'ManutenÃ§Ã£o'),
(5, 'Gerenciamento de Projetos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `types`
--

INSERT INTO `types` (`id`, `description`) VALUES
(1, 'Vendas'),
(2, 'InscriÃ§Ãµes'),
(3, 'Sobre o Evento'),
(4, 'OrganizaÃ§Ã£o');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(4, 'Fabiana luisa santos de deus', 'fabiosantos@ifsul.edu.br', '$2y$10$7XD1Q0BVr0VlGSXCrbPOm.qDgQcYjPtwmL8jlYRVR9cjV3.eFRv2m'),
(12, 'fabiosantos@ifsul.edu.br', 'fabiosantos@ifsul.edu.brB', '$2y$10$hX1CMJPZMb1rlAqAiOGDhuhPCzeXJAkh2S8uX3lDbgORLcEMQpaBS'),
(32, 'laura leal', 'piranha@gmail.com', '$2y$10$ydz.FPcYE6f5T4DrcUAIe.8sCKpSX6xUYeBDwKNstI32VPrv95.ZC'),
(33, 'bruno', 'bruno@gmail.com', '$2y$10$jyKYpLdQnxC7XAcllkpAA.3tJvceg37vlLyKwf6pIbU7JaxDMonFi'),
(34, 'luana amiga', 'jogaprosd@gmail.com', '$2y$10$R1sFCOCCVBVNEswIwpP6.O64JAiANI4/bMuuZ7F7p4WHdB6Wbp05O'),
(35, 'fabi', 'fabu@gmail.com', '$2y$10$4mDSBYs2gXckXclIuc7iSuS2SpXwatjwdDgmw.FCt73/26FBtRjJC'),
(36, 'dfghjkl', 'amem@gmail.com', '$2y$10$n2BmYfwOIpH1GF6lS/WAoOv7Hk3xHxY6F2nKgnZlApbWYTSytzi0m'),
(37, 'TYEUTUIO', 'vgrh@gmail.com', '$2y$10$NNXT3PaVT1RQaTck4GxLD.CW9lUUpBZoNmuiGW6/sMTguRjKC2tN.'),
(38, 'fabio', 'amemdeus@gmail.com', '$2y$10$6ZrJ7PY2PqyE8l36W0ZNsuMmFxjKWRX.MqooBJLRPgFfHOcDLOc8i'),
(39, 'QW3RT6IO', 'GENE@gmail.COM', '$2y$10$.mTaGknpQWjapfQFnsqp8ORJytZyK4jRw2YciN0x4TKVTwpw//MYa'),
(40, 'AWERU', 'DE@gmail.COM', '$2y$10$gX4lbxHhugpFtiQ5oAlWFOySEN4RHSlatdgnXy1EFj6W2awj1g6Eq'),
(41, 'hhrbr', 'gab@gmail.com', '$2y$10$K.GVlvbBTz6osHfAmNAFF.3UQe7z3H55cWfH3PcbsCcJLTbcLg7UK'),
(42, 'WERTY', 'Hhgrn@gmail.cpm', '$2y$10$bd83y/SwoGSuDmeoJ.10suK3ZWGZVlOCx79Ou.h89g7wK4k6.O4MS'),
(43, 'WERTY', 'Hhgrn@gmail.cpmh', '$2y$10$OnIBRMMNzjizaLUXI0Pvueqp2cxQddalP6VvvJkacSVaXu7ruiQhW'),
(44, 'gabriel', 'gabriel@gmail.com', '$2y$10$7CjBuwbAd/gQum/Cgq1RFOeoMQR8VaUqQZte7kVg33f3SbA/hCZbC'),
(45, 'gabriel', 'gabriel@gmail.comd', '$2y$10$a5aMAQ8XE9oFdwE0tSKl3eTwDdiTfO1f93lGnexr0BV4vjF58Z8I2'),
(46, 'gabriel', 'gabriel@gmail.comdd', '$2y$10$xBnrf5AF3jzbVXEmPQgfnejgfBSWMezNx5WBlMS44ildD.hJ5pA0S'),
(47, 'bruno de aquino', 'brunoaquino@gmail.com', '$2y$10$O3tC2n8bbGEFSaiMnx7YbuEv2/r3mlPSJa5sZShGDGS/kXmyw7oZe');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_types` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
