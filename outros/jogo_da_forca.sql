-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12-Dez-2019 às 00:49
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jogo_da_forca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogador`
--

DROP TABLE IF EXISTS `jogador`;
CREATE TABLE IF NOT EXISTS `jogador` (
  `id_jogador` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `pontuacao` int(5) NOT NULL DEFAULT '0',
  `gameOver` tinyint(1) NOT NULL DEFAULT '1',
  `permissao` char(3) NOT NULL DEFAULT 'com',
  `nivel` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_jogador`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jogador`
--

INSERT INTO `jogador` (`id_jogador`, `nickname`, `pass`, `pontuacao`, `gameOver`, `permissao`, `nivel`) VALUES
(1, 'jonathan', '$2y$10$xaR1EEFX2WApd409fSYf4.uh.4t5q6zGPfHOCiV54i4HFtJ.onJPa', 20930, 0, 'adm', 6),
(10, 'admin', '$2y$10$FOplrqCKX9U02fQvFMWMCOC/FAXFB955s0S/i/5W1Hkq90KPb5B7O', 0, 1, 'adm', 1),
(8, 'comum', '$2y$10$gUMWf9kZeNAPDco9l7Qhuea4A4uW8nlNPEC4mLDRaMB7VVo19HKiS', 2330, 0, 'com', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `linguagem`
--

DROP TABLE IF EXISTS `linguagem`;
CREATE TABLE IF NOT EXISTS `linguagem` (
  `id_linguagem` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `linguagem` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_linguagem`),
  UNIQUE KEY `linguagem` (`linguagem`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `linguagem`
--

INSERT INTO `linguagem` (`id_linguagem`, `linguagem`, `descricao`) VALUES
(1, 'java', 'Linguagem Orientada a Objetos'),
(2, 'Carros', 'Coisas relacionadas a carros'),
(3, 'Animais', 'Coisas relacionadas a animais'),
(4, 'Livros', 'Titulos de livros'),
(6, 'Filmes', 'Titulos de filmes'),
(7, 'Pessoas da histÃ³ria', 'Pessoas que ficaram famosas na histÃ³ria do mundo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lingxpal`
--

DROP TABLE IF EXISTS `lingxpal`;
CREATE TABLE IF NOT EXISTS `lingxpal` (
  `id_palavra` int(8) NOT NULL,
  `id_linguagem` int(8) NOT NULL,
  KEY `fk_id_palavra` (`id_palavra`),
  KEY `fk_id_linguagem` (`id_linguagem`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lingxpal`
--

INSERT INTO `lingxpal` (`id_palavra`, `id_linguagem`) VALUES
(1, 2),
(21, 3),
(7, 2),
(31, 4),
(15, 3),
(4, 2),
(30, 2),
(16, 3),
(19, 3),
(32, 6),
(33, 7),
(34, 7),
(35, 7),
(36, 7),
(37, 7),
(38, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `palavras`
--

DROP TABLE IF EXISTS `palavras`;
CREATE TABLE IF NOT EXISTS `palavras` (
  `id_palavra` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `palavra` varchar(50) NOT NULL,
  `dificuldade` int(1) NOT NULL,
  `numeroCaracteres` int(2) NOT NULL,
  `dica` varchar(255) NOT NULL,
  PRIMARY KEY (`id_palavra`),
  UNIQUE KEY `palavra` (`palavra`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `palavras`
--

INSERT INTO `palavras` (`id_palavra`, `palavra`, `dificuldade`, `numeroCaracteres`, `dica`) VALUES
(1, 'vectra', 1, 6, 'Sedan produzido pela Opel'),
(2, 'voyage', 1, 6, 'Sedan derivado do Gol'),
(3, 'bugatti-veyron', 3, 14, '1001 cavalos de forÃ§a'),
(4, 'turbocharged-stratified-injection', 6, 33, 'TSI'),
(5, 'tipo', 3, 4, 'O primeiro modelo a ter o Air Bag para o motorista produzido no Brasil'),
(6, 'jetta', 2, 5, 'Modelo sedan derivado do Golf'),
(7, 'apolo', 2, 5, 'GÃªmeo do Verona'),
(33, 'marie-curie', 2, 11, 'Primeira pessoa a ganhar dois Nobels'),
(32, 'tempos-modernos', 4, 15, 'Ãšltima apariÃ§Ã£o de Carlitos'),
(14, 'calibra', 2, 7, 'Coupe baseado no Vectra \"A\"'),
(15, 'beija-flor', 1, 10, 'Ãšnica ave capaz de ficar parada no ar'),
(16, 'capivara', 1, 8, 'Maior roedor do planeta Terra'),
(17, 'krill', 2, 5, 'Principal alimento das baleias'),
(18, 'peixe-palhaco', 2, 13, 'Sua casa Ã© a anemona do mar'),
(19, 'cachorro', 1, 8, 'Melhor amigo do homem'),
(20, 'estrela-do-mar', 3, 14, 'Animal com extrema capacidade de regeneraÃ§Ã£o'),
(21, 'abelha', 2, 6, 'Principal polinizador'),
(24, 'var', 1, 3, 'Palavra reservada para criaÃ§Ã£o de variÃ¡veis'),
(23, 'reinacoes-de-narizinho', 2, 22, 'Primeiro Livro Infantil de Monteiro Lobato'),
(31, 'viagem-ao-centro-da-terra', 1, 25, 'Obra de JÃºlio Verne'),
(30, 'meriva', 5, 6, 'Minivan desenvolvida no Brasil e exportada para a Europa'),
(34, 'charles-chaplin', 2, 15, 'Grande nome do \"Cinema Mudo\"'),
(35, 'floriano-peixoto', 4, 16, 'Ficou conhecido como \"Marechal de Ferro\"'),
(36, 'iuri-gagarin', 3, 12, 'Primeiro homem a viajar para o espaÃ§o'),
(37, 'deodoro-da-fonseca', 2, 18, 'Primeiro presidente do Brasil'),
(38, 'irineu-evangelista-de-sousa', 5, 27, 'Visconde de MauÃ¡');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ranking`
--

DROP TABLE IF EXISTS `ranking`;
CREATE TABLE IF NOT EXISTS `ranking` (
  `id_ranking` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jogador` varchar(15) NOT NULL,
  `pontuacao` int(8) NOT NULL,
  PRIMARY KEY (`id_ranking`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ranking`
--

INSERT INTO `ranking` (`id_ranking`, `jogador`, `pontuacao`) VALUES
(9, 'jonathan', 3795),
(10, 'jonathan', 1000),
(11, 'jonathan', 2880),
(12, 'jonathan', 2000),
(13, 'jonathan', 8655),
(14, 'comum', 690),
(15, 'jonathan', 18685);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tentativas`
--

DROP TABLE IF EXISTS `tentativas`;
CREATE TABLE IF NOT EXISTS `tentativas` (
  `id_tentaiva` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_jogador` int(8) NOT NULL,
  `id_palavra` int(8) NOT NULL,
  `tentativas` int(8) NOT NULL DEFAULT '1',
  `data_jogada` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tentaiva`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
