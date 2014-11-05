
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 28 2014 г., 10:08
-- Версия сервера: 5.1.69
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u539090709_db`
--

-- --------------------------------------------------------

use taskmanager;
-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('032b9e876f68cc285fa5539f1452fbec', '91.215.121.164', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1397402879, ''),
('5766cf543a78a67465ec1cc82985ecb1', '89.223.39.166', 'Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mob', 1397403239, ''),
('ec855e82532c030045401adedc7c4be6', '89.223.39.166', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1397403238, ''),
('0c19487e79f7ea79cd04ead0515032c7', '91.215.121.164', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36', 1398770108, ''),
('869d620e32e886311cde0519a4c1e4a8', '91.215.121.164', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36', 1398771412, ''),
('d56be62c28d2f6ffc88983c664486c6a', '93.153.234.194', 'Apache-HttpClient/UNAVAILABLE (java 1.4)', 1398773629, ''),
('43f7268270b4798cd85cfa1208201b77', '93.153.234.194', 'Apache-HttpClient/UNAVAILABLE (java 1.4)', 1398773684, ''),
('ce2a114933308551408272e9103c2c1b', '93.153.234.194', 'Apache-HttpClient/UNAVAILABLE (java 1.4)', 1398774194, '');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `idcoment` int(11) unsigned NOT NULL,
  `idUser` int(11) unsigned NOT NULL,
  `idTask` int(11) unsigned NOT NULL,
  `commentary` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idcoment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`idcoment`, `idUser`, `idTask`, `commentary`) VALUES
(0, 0, 15, 'nikitalalka'),
(1, 0, 15, 'nikitalalka1'),
(2, 0, 15, 'nikitalalka2'),
(3, 1, 15, '+++ nikitalalka'),
(4, 1, 16, 'nikitalalka'),
(5, 0, 17, 'nikitalalka');

-- --------------------------------------------------------

--
-- Структура таблицы `deleted`
--

CREATE TABLE IF NOT EXISTS `deleted` (
  `idTask` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idTask`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `deleted`
--

INSERT INTO `deleted` (`idTask`) VALUES
(0),
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `idTask` int(11) NOT NULL AUTO_INCREMENT,
  `output` text,
  `parentTask` int(11) unsigned DEFAULT NULL,
  `progress` varchar(45) DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `taskTime` varchar(45) DEFAULT NULL,
  `theStartTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `specification` text,
  PRIMARY KEY (`idTask`),
  UNIQUE KEY `progress` (`progress`),
  UNIQUE KEY `progress_2` (`progress`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`idTask`, `output`, `parentTask`, `progress`, `done`, `taskTime`, `theStartTime`, `endTime`, `name`, `specification`) VALUES
(19, 'null', 12, '0', 0, '', '0000-00-00 00:00:00', '2014-05-16 14:28:00', 'yfcyfcyyfhf', 'ugcjg'),
(9, '1', 0, '7', 0, '12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sgsddfdfgsdgdagssdghvgcuggcg', 'fdbshsdhsgvbsdbgsdgasdfhhhhhhhhh'),
(17, '1', 1, '13', 0, '', '2014-05-01 00:00:00', '2014-06-11 00:00:00', 'lalka', 'sdgesag weg egewqgweg qew gweqg '),
(16, '1', 0, '12', 0, '', '2014-05-04 00:00:00', '2014-05-31 00:00:00', 'utcutf8yfuftxyfxyft', 'wgwegqwfwqd e giqgefiwyqgb iyfvbwqiy fbiuwyqvb fyuvbiuq wybvfdiwb dwhuqfuwehvcoub iwyvb fwqvfhv'),
(14, '1', 0, '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(15, 'null', 0, '11', 0, '', '2014-05-05 00:00:00', '2014-05-22 00:00:00', '4664212ugvguc', 'wdgfwed wergwegweg eqtgeqgdc qfweqf  wqf wfwfwfw'),
(18, 'null', 12, '10', 0, '', '2014-04-09 00:16:00', '0000-00-00 00:00:00', '2014-4-9 0:16:00', ' 13');

-- --------------------------------------------------------

--
-- Структура таблицы `taskuser`
--

CREATE TABLE IF NOT EXISTS `taskuser` (
  `idtask` int(11) unsigned NOT NULL,
  `iduser` int(11) unsigned NOT NULL,
  `owner` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`idtask`,`iduser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `taskuser`
--

INSERT INTO `taskuser` (`idtask`, `iduser`, `owner`) VALUES
(17, 0, 1),
(9, 0, 1),
(16, 1, 0),
(15, 1, 0),
(0, 0, 1),
(16, 0, 1),
(15, 0, 1),
(14, 0, 1),
(18, 0, 1),
(17, 1, 0),
(19, 0, 1),
(0, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) unsigned NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `email`, `nickname`, `password`) VALUES
(0, 'admin', 'admin', 'admin'),
(1, 'user', 'user', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
