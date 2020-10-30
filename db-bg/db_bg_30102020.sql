-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 30. Okt 2020 um 12:11
-- Server-Version: 10.3.25-MariaDB-0+deb10u1
-- PHP-Version: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_bg_db1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `userid` int(11) NOT NULL,
  `session` varchar(256) NOT NULL,
  `arank` int(20) NOT NULL,
  `team` int(255) NOT NULL DEFAULT 0,
  `canjoin` int(2) NOT NULL DEFAULT 0,
  `rank` int(10) NOT NULL,
  `race` varchar(15) NOT NULL,
  `planet` varchar(90) NOT NULL DEFAULT 'Erde',
  `place` varchar(90) NOT NULL DEFAULT 'Hütte',
  `zeni` int(255) NOT NULL DEFAULT 100,
  `stats` int(10) NOT NULL,
  `dailyfights` int(10) NOT NULL,
  `totalstatsfights` int(10) NOT NULL,
  `dailynpcfights` int(10) NOT NULL,
  `level` int(10) NOT NULL DEFAULT 1,
  `story` int(11) NOT NULL DEFAULT 1,
  `lp` varchar(255) NOT NULL DEFAULT '100',
  `mlp` varchar(255) NOT NULL DEFAULT '100',
  `kp` varchar(255) NOT NULL DEFAULT '100',
  `mkp` varchar(255) NOT NULL DEFAULT '100',
  `attack` varchar(255) NOT NULL DEFAULT '10',
  `defense` varchar(255) NOT NULL DEFAULT '10',
  `charimage` varchar(255) NOT NULL,
  `design` varchar(10) NOT NULL DEFAULT 'default',
  `titel` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `fight` int(11) NOT NULL,
  `attacks` longtext NOT NULL,
  `fightattacks` longtext NOT NULL,
  `statspopup` tinyint(1) NOT NULL,
  `chatactive` tinyint(1) NOT NULL DEFAULT 1,
  `chatchannel` varchar(30) NOT NULL,
  `lastaction` datetime NOT NULL,
  `action` int(11) NOT NULL,
  `actionstart` datetime NOT NULL,
  `actiontime` int(20) NOT NULL,
  `learningattack` varchar(90) NOT NULL,
  `travelplace` varchar(90) NOT NULL,
  `travelplanet` varchar(90) NOT NULL,
  `previousplace` varchar(90) NOT NULL,
  `statstraining` longtext NOT NULL,
  `deathplace` varchar(90) NOT NULL,
  `deathplanet` varchar(90) NOT NULL,
  `equippedstats` longtext NOT NULL,
  `travelbonus` int(3) NOT NULL,
  `challengefight` int(10) NOT NULL,
  `x` int(4) NOT NULL,
  `y` int(4) NOT NULL,
  `inranking` tinyint(1) NOT NULL DEFAULT 1,
  `group` longtext NOT NULL,
  `groupinvite` int(11) NOT NULL,
  `groupleader` tinyint(1) NOT NULL,
  `eventinvite` int(11) NOT NULL,
  `tournament` int(11) NOT NULL,
  `pendingtournament` int(11) NOT NULL,
  `npcwonitems` varchar(90) NOT NULL,
  `challengedtime` datetime NOT NULL,
  `rvguztime` int(10) NOT NULL,
  `clan` int(11) NOT NULL,
  `clanname` varchar(90) NOT NULL,
  `clanapplication` int(11) NOT NULL,
  `clanapplicationtext` longtext NOT NULL,
  `clickcount` int(3) NOT NULL,
  `captchatime` datetime NOT NULL,
  `banned` tinyint(1) NOT NULL,
  `banreason` longtext NOT NULL,
  `multis` int(255) NOT NULL DEFAULT 1,
  `multiaccounts` longtext NOT NULL,
  `fakeki` int(11) NOT NULL,
  `canfakeki` tinyint(4) NOT NULL,
  `chatban` int(3) NOT NULL DEFAULT 0,
  `warnung` int(3) NOT NULL DEFAULT 0,
  `sparringpartner` int(11) NOT NULL,
  `sparringrequest` int(11) NOT NULL,
  `sparringtime` int(11) NOT NULL,
  `sparringcancel` tinyint(1) NOT NULL,
  `trainingstats` int(4) NOT NULL,
  `loginlog` longtext NOT NULL,
  `visible` int(255) NOT NULL DEFAULT 0,
  `topfighter` varchar(255) NOT NULL,
  `havescouter` int(2) NOT NULL,
  `deathtime` datetime NOT NULL,
  `traveltimeleft` varchar(255) NOT NULL,
  `raceimage` varchar(60) NOT NULL,
  `powerupstart` int(11) NOT NULL,
  `skillpoints` int(11) NOT NULL,
  `skillpointlearn` int(3) NOT NULL,
  `apetail` int(2) NOT NULL,
  `apecontrol` int(1) NOT NULL,
  `wishes` longtext NOT NULL,
  `wishcounter` int(3) NOT NULL,
  `wishlastfight` datetime NOT NULL,
  `lasteventaction` datetime NOT NULL,
  `arenapoints` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `reflex` int(11) NOT NULL,
  `titels` longtext NOT NULL,
  `debuglog` longtext NOT NULL,
  `blocked` longtext NOT NULL,
  `friends` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `image` varchar(255) NOT NULL,
  `minutes` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `type` int(2) NOT NULL,
  `price` int(10) NOT NULL,
  `stats` int(11) NOT NULL,
  `lp` int(10) NOT NULL,
  `kp` int(10) NOT NULL,
  `attack` int(10) NOT NULL,
  `defense` int(10) NOT NULL,
  `item` int(11) NOT NULL,
  `earnitem` int(11) NOT NULL,
  `race` varchar(30) NOT NULL,
  `level` int(11) NOT NULL,
  `maxtimes` int(2) NOT NULL,
  `isstory` tinyint(1) NOT NULL,
  `place` varchar(90) NOT NULL,
  `planet` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `actions`
--

INSERT INTO `actions` (`id`, `name`, `image`, `minutes`, `description`, `type`, `price`, `stats`, `lp`, `kp`, `attack`, `defense`, `item`, `earnitem`, `race`, `level`, `maxtimes`, `isstory`, `place`, `planet`) VALUES
(1, 'Ausdauer Training', 'atrain', 60, 'Erhöht [b]LP[/b] um [b]10[/b].', 1, 0, 0, 10, 0, 0, 0, 0, 0, '', 0, 240, 0, '', ''),
(2, 'Energie Training', 'etrain', 60, 'Erhöht [b]KP[/b] um [b]10[/b].', 1, 0, 0, 0, 10, 0, 0, 0, 0, '', 0, 240, 0, '', ''),
(3, 'Angriff Training', 'attacktrain', 60, 'Erhöht [b]Angriff[/b] um [b]1[/b].', 1, 0, 0, 0, 0, 1, 0, 0, 0, '', 0, 240, 0, '', ''),
(4, 'Verteidigung Training', 'vtrain', 60, 'Erhöht [b]Verteidigung[/b] um [b]1[/b].', 1, 0, 0, 0, 0, 0, 1, 0, 0, '', 0, 240, 0, '', ''),
(5, 'Training', 'ntrain', 240, 'Erhöht [b]Alles[/b] um [b]1[/b].', 1, 0, 0, 10, 10, 1, 1, 0, 0, '', 0, 240, 0, '', ''),
(10, 'Wiederbelebung', 'beleben', 1440, 'Belebt den Spieler nach [b]einen Tag[/b] wieder.', 2, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', ''),
(11, 'Heilen', 'heilen', 60, 'Heilt [b]LP und KP[/b] um [b]10%[/b].', 3, 0, 0, 10, 10, 0, 0, 0, 0, '', 0, 10, 0, '', ''),
(12, 'Reisen', '', 0, '', 4, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', ''),
(13, 'Effektives Ausdauer Training', 'atrain', 60, 'Erhöht [b]LP[/b] um [b]20[/b].', 1, 50, 0, 20, 0, 0, 0, 0, 0, '', 0, 240, 0, '', ''),
(14, 'Effektives Energie Training', 'etrain', 60, 'Erhöht [b]KP[/b] um [b]20[/b].', 1, 50, 0, 0, 20, 0, 0, 0, 0, '', 0, 240, 0, '', ''),
(15, 'Effektives Angriff Training', 'attacktrain', 60, 'Erhöht [b]Angriff[/b] um [b]2[/b].', 1, 50, 0, 0, 0, 2, 0, 0, 0, '', 0, 240, 0, '', ''),
(16, 'Effektives Verteidigung Training', 'vtrain', 60, 'Erhöht [b]Verteidigung[/b] um [b]2[/b].', 1, 50, 0, 0, 0, 0, 2, 0, 0, '', 0, 240, 0, '', ''),
(17, 'Effektives Training', 'ntrain', 240, 'Erhöht [b]Alles[/b] um [b]2[/b].', 1, 50, 0, 20, 20, 2, 2, 0, 0, '', 0, 240, 0, '', ''),
(22, 'Schnelles Heilen', 'essen2', 60, 'Heilt [b]LP und KP[/b] um [b]100%[/b].', 3, 0, 0, 100, 100, 0, 0, 0, 0, '', 0, 1, 0, '', ''),
(23, 'Lernen', '', 60, '', 5, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', ''),
(27, 'Besteige den Turm', 'climbtower', 1440, 'Du besteigst den Turm von Meister Quitte.', 4, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', ''),
(28, 'Fliege zum Palast', 'flytopalace', 1440, 'Du fliegst mit einer Wolke zum Palast.', 4, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', ''),
(29, 'Betrete den Raum von Geist und Zeit', 'enterrvguz', 60, 'Du betrittst den Raum von Geist und Zeit für einen Tag.', 4, 1000000, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', ''),
(30, 'Ki Unterdrücken', 'kisuspress', 240, 'Der Spieler lernt seine KI zu unterdrücken.', 6, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', ''),
(31, 'Sparring', 'sparring', 60, 'Der Spieler trainiert mit jemand anderen zusammen.', 6, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', ''),
(32, 'Trainingsberg besteigen', 'climbmountain', 60, 'Du besteigst den Trainingberg', 4, 0, 0, 0, 0, 0, 0, 78, 0, '', 0, 1, 0, '', ''),
(33, 'Ausdauer Training', 'atrain', 60, 'Erhöht [b]LP[/b] um [b]150[/b].', 1, 0, 0, 150, 0, 0, 0, 0, 0, '', 0, 240, 0, '', ''),
(34, 'Energie Training', 'etrain', 60, 'Erhöht [b]KP[/b] um [b]150[/b].', 1, 0, 0, 0, 150, 0, 0, 0, 0, '', 0, 240, 0, '', ''),
(35, 'Angriff Training', 'attacktrain', 60, 'Erhöht [b]Angriff[/b] um [b]15[/b].', 1, 0, 0, 0, 0, 15, 0, 0, 0, '', 0, 240, 0, '', ''),
(36, 'Verteidigung Training', 'vtrain', 60, 'Erhöht [b]Verteidigung[/b] um [b]15[/b].', 1, 0, 0, 0, 0, 0, 15, 0, 0, '', 0, 240, 0, '', ''),
(37, 'Training', 'ntrain', 240, 'Erhöht [b]Alles[/b] um [b]15[/b].', 1, 0, 0, 150, 150, 15, 15, 0, 0, '', 0, 240, 0, '', ''),
(38, 'Schlafen', 'schlafen', 60, 'Heilt [b]LP[/b] um [b]20%[/b].', 3, 0, 0, 20, 0, 0, 0, 0, 0, '', 0, 5, 0, '', ''),
(39, 'Meditieren', 'meditate', 60, 'Heilt [b]KP[/b] um [b]20%[/b].', 3, 0, 0, 0, 20, 0, 0, 0, 0, '', 0, 5, 0, '', ''),
(40, 'Tiefer Schlaf', 'tieferschlaf', 60, 'Heilt [b]LP[/b] und [b]KP[/b] um [b]100%[/b].', 3, 0, 0, 100, 100, 0, 0, 0, 0, 'Majin', 0, 1, 0, '', ''),
(41, 'Upgrade', 'upgradechip', 0, 'Verbessert den Chip. Erhöht den Chip um 2 Stats. Die maximale Stärke ist dein Level x 2.', 6, 0, 0, 0, 0, 0, 0, 0, 0, 'Android', 0, 1, 0, '', ''),
(42, 'Verbranntes Fleisch herstellen', 'verbranntesfleisch', 60, 'Erzeugt verbranntes Fleisch.', 7, 0, 0, 0, 0, 0, 0, 0, 1, 'Kaioshin', 0, 100, 0, '', ''),
(43, 'Blatt mit Wasser herstellen', 'blattmitwasser', 60, 'Erzeugt Blatt mit Wasser', 7, 0, 0, 0, 0, 0, 0, 0, 2, 'Kaioshin', 0, 100, 0, '', ''),
(44, 'Hähnchenkeule herstellen', 'haehnchenkeule', 60, 'Erzeugt eine Hähnchenkeule.', 7, 0, 0, 0, 0, 0, 0, 0, 4, 'Kaioshin', 3, 100, 0, '', ''),
(45, 'Kleinen Becher herstellen', 'kleinerbecher', 60, 'Erzeugt einen kleinen Becher.', 7, 0, 0, 0, 0, 0, 0, 0, 5, 'Kaioshin', 3, 100, 0, '', ''),
(46, 'Dinosaurier-Keule herstellen', 'dinosaurierfleisch', 60, 'Erzeugt eine Dinosaurier-Keule.', 7, 0, 0, 0, 0, 0, 0, 0, 6, 'Kaioshin', 6, 100, 0, '', ''),
(47, 'Wasserflasche herstellen', 'wasserflasche', 60, 'Erzeugt eine Wasserflasche', 7, 0, 0, 0, 0, 0, 0, 0, 7, 'Kaioshin', 6, 100, 0, '', ''),
(48, 'Affenschwanz abtrainieren', 'apetrainoff', 0, 'Entfernt den Affenschwanz, so dass er nicht mehr nachwächst.', 6, 0, 0, 0, 0, 0, 0, 0, 0, 'Saiyajin', 0, 1, 0, '', ''),
(49, 'Affenschwanz antrainieren', 'apetrainon', 0, 'Trainiert den Affenschwanz wieder dran, sofern er ab ist.', 6, 0, 0, 0, 0, 0, 0, 0, 0, 'Saiyajin', 0, 1, 0, '', ''),
(50, 'Oozaru Kontrollieren', 'apecontrol', 1440, 'Trainiere den Oozaru zu kontrollieren.', 6, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 0, '', ''),
(51, 'Trainingsinsel-Training', 'trainingsinseltrain', 1440, 'Erhöht die Stats um 48.', 1, 0, 48, 0, 0, 0, 0, 0, 0, '', 13, 1, 1, '', ''),
(52, 'Gebratenen-Fisch herstellen', 'fisch', 60, 'Erzeugt einen gebratenen Fisch', 7, 0, 0, 0, 0, 0, 0, 0, 8, 'Kaioshin', 9, 100, 0, '', ''),
(53, 'Eimer mit Wasser herstellen', 'eimerwasser', 60, 'Erzeugt einen Eimer mit Wasser', 7, 0, 0, 0, 0, 0, 0, 0, 9, 'Kaioshin', 9, 100, 0, '', ''),
(54, 'Hamburger herstellen', 'hamburger', 60, 'Erzeugt einen Hamburger', 7, 0, 0, 0, 0, 0, 0, 0, 10, 'Kaioshin', 12, 100, 0, '', ''),
(55, 'Energydrink herstellen', 'energydrink', 60, 'Erzeugt einen Energydrink', 7, 0, 0, 0, 0, 0, 0, 0, 11, 'Kaioshin', 12, 100, 0, '', ''),
(56, 'Quittenturm besteigen', '', 1440, 'Erhöht die Stats um 100.', 1, 0, 100, 0, 0, 0, 0, 0, 0, '', 28, 1, 1, '', ''),
(57, 'Das göttliche Wasser trinken', '', 1440, 'Erhöht die Stats um 160.', 1, 0, 160, 0, 0, 0, 0, 0, 0, '', 45, 1, 1, '', ''),
(58, 'Training mit Mr. Popo', '', 720, 'Erhöht die Stats um 80.', 1, 0, 80, 0, 0, 0, 0, 0, 0, '', 47, 1, 1, '', ''),
(59, 'Training mit Gott', '', 720, 'Erhöht die Stats um 80.', 1, 0, 80, 0, 0, 0, 0, 0, 0, '', 47, 1, 1, '', ''),
(61, 'Schlangenpfad entlanglaufen ', 'schlangenpfad', 1440, 'Laufe den Schlangenpfad bis zu Meister Kaios Planeten.\r\n\r\n[Dies ist kein Training, sondern wird als normale Reise gewertet.]', 1, 0, 24, 0, 0, 0, 0, 0, 0, '', 54, 10, 0, 'Meister Kaios Planet', 'Jenseits'),
(62, 'Schlangenpfad bestreiten', '', 2880, 'Laufe den Schlangenpfad bis zu Meister Kaios Planet.', 1, 0, 200, 0, 0, 0, 0, 0, 0, '', 0, 1, 1, 'Meister Kaios Planet', 'Jenseits'),
(63, 'Sterben', '', 0, 'Der Spieler stirbt.', 1, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 1, 'Check-In Station', 'Jenseits'),
(64, 'Wiederbeleben', '', 0, 'Der Spieler wird wiederbelebt.', 1, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 1, 'Gottespalast', 'Erde'),
(65, 'Voller Teller herstellen', 'vollerteller', 60, 'Erzeugt einen Vollen Teller', 7, 0, 0, 0, 0, 0, 0, 0, 12, 'Kaioshin', 28, 100, 0, '', ''),
(66, 'Limonade herstellen', 'limonade', 60, 'Erzeugt eine Limonade', 7, 0, 0, 0, 0, 0, 0, 0, 13, 'Kaioshin', 28, 100, 0, '', ''),
(67, 'Raumschiff', '', 0, '', 4, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `ip` varchar(128) NOT NULL,
  `accounts` longtext NOT NULL,
  `log` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arenafighter`
--

CREATE TABLE `arenafighter` (
  `id` int(11) NOT NULL,
  `fighter` int(11) NOT NULL,
  `infight` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `attacks`
--

CREATE TABLE `attacks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(90) NOT NULL,
  `type` int(2) NOT NULL,
  `value` float NOT NULL,
  `epvalue` int(10) NOT NULL,
  `lpvalue` int(10) NOT NULL,
  `kpvalue` int(10) NOT NULL,
  `atkvalue` int(10) NOT NULL,
  `defvalue` int(10) NOT NULL,
  `tauntvalue` int(10) NOT NULL,
  `reflectvalue` int(10) NOT NULL,
  `kp` int(10) NOT NULL,
  `lp` int(10) NOT NULL,
  `energy` int(3) NOT NULL,
  `procentual` tinyint(1) NOT NULL,
  `procentualcost` tinyint(1) NOT NULL,
  `learnlp` int(10) NOT NULL,
  `learnki` int(10) NOT NULL,
  `learnkp` int(10) NOT NULL,
  `learnattack` int(10) NOT NULL,
  `learndefense` int(10) NOT NULL,
  `accuracy` int(10) NOT NULL,
  `text` longtext NOT NULL,
  `missText` longtext NOT NULL,
  `deadText` longtext NOT NULL,
  `loadtext` longtext NOT NULL,
  `description` longtext NOT NULL,
  `transformationid` int(2) NOT NULL,
  `race` longtext NOT NULL,
  `displayed` tinyint(1) NOT NULL,
  `loadattack` int(11) NOT NULL,
  `npcid` int(11) NOT NULL,
  `loadrounds` int(2) NOT NULL,
  `blockattack` int(11) NOT NULL,
  `blockedattack` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `minvalue` int(10) NOT NULL,
  `rounds` int(1) NOT NULL,
  `level` int(10) NOT NULL,
  `learntime` int(4) NOT NULL,
  `npcpickable` tinyint(1) NOT NULL,
  `costgenerated` tinyint(1) NOT NULL DEFAULT 1,
  `displaydied` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `attacks`
--

INSERT INTO `attacks` (`id`, `name`, `image`, `type`, `value`, `epvalue`, `lpvalue`, `kpvalue`, `atkvalue`, `defvalue`, `tauntvalue`, `reflectvalue`, `kp`, `lp`, `energy`, `procentual`, `procentualcost`, `learnlp`, `learnki`, `learnkp`, `learnattack`, `learndefense`, `accuracy`, `text`, `missText`, `deadText`, `loadtext`, `description`, `transformationid`, `race`, `displayed`, `loadattack`, `npcid`, `loadrounds`, `blockattack`, `blockedattack`, `item`, `minvalue`, `rounds`, `level`, `learntime`, `npcpickable`, `costgenerated`, `displaydied`) VALUES
(1, 'Schlag', 'schlag', 1, 1, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 90, '!source schlägt auf !target ein und verursacht !type !damage Schaden.', '!source will auf !target einschlagen, verfehlt jedoch.', '!source will auf !target einschlagen, !target ist jedoch bereits tot.', '', 'Der Spieler schlägt auf das Ziel ein.', 0, '', 1, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 1, 1, 1),
(2, 'Verteidigen', 'verteidigen', 2, 1.5, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, '!source geht in die Verteidigung.', '', '', '', 'Der Spieler geht in einer Haltung, in die er sich gut verteidigen kann.', 0, '', 1, 0, 0, 0, 0, 0, 0, 20, 0, 0, 0, 1, 0, 1),
(3, 'Haretsu Majutsu', 'haretsumajutsu', 3, 10, 0, 0, 0, 0, 0, 0, 0, 1000, 0, 50, 0, 0, 0, 0, 0, 0, 0, 10, '!source starrt !target an. !target erleidet plötzlich höllische Schmerzen und der Körper von !target wird größer. Daraufhin verbiegt sich !target und !target explodiert.', '!source starrt !target an, !target erleidet !damage Schaden.', '!source starrt !target an, !target ist jedoch bereits tot.', '', 'Der Spieler starrt den Gegner an wodurch der Gegner Schmerzen erleidert und explodiert.', 0, '', 1, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(4, 'Kaioken', 'kaioken', 4, 100, 0, 100, 100, 100, 100, 0, 0, 500, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert die Energy und eine rote Aura umgibt !source.', 'Die rote Aura um !source verschwindet wieder.', '', '', '', 1, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 59, 24, 1, 0, 1),
(5, 'Weak Heal', 'weakheal', 5, 2, 0, 100, 0, 0, 0, 0, 0, 400, 0, 8, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hände auf !target und heilt !target um !type !damage LP.', '!source hält die Hände auf !target und heilt !target um !type !damage.', '!source hält die Hände auf !target, !target ist jedoch tot.', '', 'Der Spieler heilt das Ziel etwas.', 0, '', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(6, 'Genkidama', 'genkidama', 6, 100, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 100, '!source feuert einen riesigen Energieball auf !target. !target versucht, den Energieball abzuwehren, wird jedoch von diesen verschlungen und erleidet !type !damage Schaden.', '!source feuert einen riesigen Energieball auf !target, !target kann diesem jedoch rechtzeitig ausweichen.', '!source feuert einen riesigen Energieball auf !target, !target ist jedoch bereits schon tot.', '!source hebt die Hände über den Kopf und sammelt Energie von allen Lebewesen auf dem Planeten.', 'Der Anwender sammelt Energie von allen Lebewesen auf dem Planeten und schleudert diese in Form einer riesigen Energiekugel auf den Gegner.', 0, '', 1, 7, 0, 0, 0, 0, 0, 10, 0, 56, 24, 1, 0, 1),
(7, 'Genkidama aufladen', 'genkidamaladen', 7, 35, 0, 0, 0, 100, 0, 0, 0, 15, 0, 10, 1, 1, 0, 0, 0, 0, 0, 100, '!source hält die Hände nach oben und lädt die Genkidama auf.', '!source versucht den Angriff von !target aufzuladen, jedoch lädt !target keinen Angriff auf.', '', '', 'Die Technik wird allen Gruppenmitgliedern zur Verfügung gestellt, sobald einer die Genkidama gestartet hat. ', 0, '', 1, 6, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(8, 'Diener beschwören', 'diener', 8, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 9, 0, 0, '!source bekommt plötzlich einen dicken Hals. Ein Ei kommt langsam aus dem Mund von !source. !source spuckt das Ei auf den Boden. Aus dem Ei entsteht ein Diener.', '!source muss sich erst ausruhen, bevor !source einen neuen Diener beschwören kann.', 'Der Spieler erzeugt ein Ei, aus dem ein Diener hervorsteigt.', '', '', 0, '', 0, 0, 20, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(9, 'Paralysieren', 'paralysieren', 9, 2, 0, 0, 0, 0, 0, 0, 0, 1100, 0, 11, 0, 0, 0, 0, 0, 0, 0, 90, '!source streckt beide Hände gegen !target aus und konzentriert sich. Eine gelbe Aura entsteht um !target herum, welche !target betäubt. ', '!source streckt beide Hände gegen !target aus und konzentriert sich, es passiert jedoch nichts.', '!source streckt beide Hände gegen !target aus und konzentriert sich. Eine gelbe Aura entsteht um !target herum, welche !target betäubt, !target ist jedoch bereits schon tot. ', '', 'Der Spieler paralysiert den Gegner für ein paar Runden.', 0, '', 1, 10, 0, 0, 0, 0, 0, 20, 0, 0, 24, 1, 0, 1),
(10, 'Paralysiert', 'paralysiert', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source ist paralysiert und kann sich nicht bewegen.', 'Die gelbe Aura um !source verschwindet.', '', '', '', 0, '', 0, 9, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(11, 'Regeneration', 'regenerieren', 11, 10, 0, 100, 0, 0, 0, 0, 0, 0, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, 'Die fehlenden Körperteile von !source wachsen plötzlich nach und !source heilt sich um !damage Schaden.', '', '', '', 'Der Spieler lässt verlorene Körperteile nachwachsen und heilt sich dadurch.', 0, '', 1, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(12, 'Weak Drain', 'weakdrain', 12, 10, 0, 100, 0, 0, 0, 0, 0, 400, 0, 8, 1, 0, 0, 0, 0, 0, 0, 100, '!source fasst mit einer Hand auf den Körper von !target. !source absorbiert daraufhin Energie von !target. !target erleidet !type !damage Schaden und !source heilt sich um einen Anteil des Schadens.', '!source fasst mit einer Hand auf den Körper von !target. !target springt jedoch noch rechtzeitig weg.', '!source fasst mit einer Hand auf den Körper von !target. !source absorbiert daraufhin Energie von !target. !target ist jedoch bereits tot.', '', 'Der Spieler absorbiert etwas Energie vom Gegner.', 0, '', 1, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(13, 'Fusiontanz', 'fusiontanz', 13, 130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 50, '!source führt synchron mit !target einen Tanz auf, wodrauf am Ende ihre Finger sich berühren und sie sich zu einer Person verwandeln.', '!source will mit !target einen Tanz aufführen, !target macht jedoch was anderes.', '!source führt synchron mit !target einen Tanz auf, wodrauf am Ende ihre Finger sich berühren, !source ballt jedoch eine Faust. !source und !target verschmelzen zu einer Person, die jedoch nicht besonders stark aussieht.', '', 'Der Spieler fusioniert mit dem Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 30, 0, 24, 1, 0, 1),
(14, 'Potara Fusion', 'potarafusion', 13, 110, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, '!source befestigt ein Potara am Ohr und wird daraufhin zu !target gezogen.', '!source befestigt ein Potara am Ohr, jedoch passiert nichts.', '!source befestigt ein Potara falsch am Ohr und wird daraufhin zu !target gezogen.', '', 'Der Spieler fusioniert mit dem Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 82, 0, -1, 0, 24, 1, 0, 1),
(15, 'Wiederbeleben', 'wiederbeleben', 17, 10, 0, 100, 100, 0, 0, 0, 0, 0, 0, 100, 1, 0, 0, 0, 0, 0, 0, 100, '!source belebt !target wieder.', '!source will !target wiederbeleben, scheitert jedoch.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 0, 1),
(16, 'Unlock Attack', 'unlockattack', 18, 50, 0, 0, 0, 100, 0, 0, 0, 500, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hand auf !target, wodurch Energie in !target frei wird und die Kraft von !target temporär steigt.', '!source konnte die innere Kraft von !target nicht erwachen.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 500, 2, 0, 24, 1, 0, 1),
(17, 'Manipulation Sorcery', 'manipulationsorcery', 18, -25, 0, 0, 0, 100, 0, 0, 0, 500, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Hände in kreisenden Bewegungen und reduziert die Kräfte von !target.', '!source kann die Kräfte von !target nicht reduzieren.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -500, 2, 0, 24, 1, 0, 1),
(18, 'Paralyse Entfernen', 'unparalyse', 19, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source löst die Paralyze von !target auf.', '!source konnte die Paralyze von !target nicht auflösen.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 20, 0, 0, 24, 1, 0, 1),
(19, 'Muscle Shield', 'muscleguard', 2, 2, 0, 0, 0, 0, 100, 0, 0, 400, 0, 8, 0, 0, 0, 0, 0, 0, 0, 100, '!source spannt die Muskeln an und verteidigt sich.', '', '', '', 'Der Spieler spannt die Muskeln an und verteidigt sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(20, 'Alle Verteidigen', 'defendall', 21, 100, 0, 0, 0, 0, 100, 100, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source stellt sich verteidigend vor alle im Team und zieht die Angriffe auf sich.', '', '', '', 'Der Spieler zieht die Angriffe auf sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 10, 0, 0, 24, 0, 0, 1),
(21, 'Weak Curse', 'curselife', 22, -15, 0, 100, 0, 0, 0, 0, 0, 200, 0, 25, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Arme in Kreisenden Bewegungen und belegt !target mit einen schwachen Fluch, der !target jede Runde schwächt.', '!source bewegt die Arme in Kreisenden Bewegungen, kann !target jedoch mit den schwachen Fluch nicht belegen.', '', '!target erleidet !type !damage Schaden durch den schwachen Fluch von !source.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -100, 2, 0, 24, 1, 0, 1),
(22, 'Oozaru', 'oozaru', 4, 100, 0, 100, 100, 100, 100, 0, 0, 500, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source erzeugt in der Hand einen Mond und schaut hinauf. !source wächst, die Haare auf den Körper werden viel größer und !source bekommt ein Affengesicht. !source wird zu einen riesigen Affen.', '!source wird wieder klein, das Affengesicht verschwindet und die Haare werden nicht mehr sichtbar.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 59, 24, 1, 0, 1),
(23, 'Super Saiyajin', 'ss', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine gelbe Aura bildet sich um !source und die Haare von !source färben sich gelb.', 'Die Haare von !source werden wieder normal.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(24, 'Super Saiyajin 2', 'ss2', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine gelbe Aura bildet sich um !source und die Haare von !source färben sich gelb. Zusätzlich werden die Haare sehr spitz und Blitze bilden sich um !source.', 'Die Haare von !source werden wieder normal und die Blitze verschwinden.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(25, 'Ultra Super Saiyajin', 'uss', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine gelbe Aura bildet sich um !source und die Haare von !source färben sich gelb. Zusätzlich werden die Haare sehr spitz und die Muskeln von !source werden größer.', 'Die Haare von !source werden wieder normal und die Muskeln werden wieder kleiner.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(26, 'Super Saiyajin 3', 'ss3', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine gelbe Aura bildet sich um !source und die Haare von !source färben sich gelb. Zusätzlich werden die Haare sehr lang und Blitze bilden sich um !source.', 'Die Haare von !source werden wieder normal und die Blitze verschwinden.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(27, 'Mystic', 'mystic', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine weiße Aura bildet sich um !source und die Haare von !source werden spitz. Zusätzlich bilden sich Blitze um !source.', 'Die Haare von !source werden wieder normal und die Blitze verschwinden.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(28, 'Ultra Super Saiyajin 2', 'uss2', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine gelbe Aura bildet sich um !source und die Haare werden gelb. Zusätzlich werden die Muskeln von !source extremst größer und die Haare werden extremst spitz. Viele Blitze umgeben !source.', 'Die Haare von !source werden wieder normal, die Muskeln kleiner und die Blitze verschwinden.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(29, 'Super Saiyajin God', 'ssg', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine brennende, rote Aura bildet sich um !source und die Haare von !source färben sich rot.', 'Die Haare von !source werden wieder normal.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(30, 'Super Saiyajin Rage', 'ssr', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, die Haare färben sich spitz gelb und die Augen werden weiß. Eine blaue Aura umgibt !source.', 'Die Haare und die Augen von !source werden wieder normal.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(31, 'Legendary Super Saiyajin', 'lss', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, die Haare färben sich spitz grün und die Augen werden weiß. Eine grüne Aura umgibt !source. Die Muskeln von !source werden extremst groß.', 'Die Haare und die Augen von !source werden wieder normal. Auch die Muskeln werden wieder kleiner.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(32, 'Super Saiyajin Blue', 'ssb', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine brennende blaue Aura bildet sich um !source und die Haare von !source färben sich blau.', 'Die Haare von !source werden wieder normal.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(33, 'Super Saiyajin Blue', 'ssbv', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine brennende blaue Aura bildet sich um !source und die Haare von !source färben sich blau.', 'Die Haare von !source werden wieder normal.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(34, 'Legendary Super Saiyajin 2', 'lss2', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, die Haare färben sich spitz grün. Eine grüne Aura umgibt !source. Die Muskeln von !source werden größer. !source kann die Kraft komplett kontrollieren.', 'Die Haare und die Muskeln von !source werden wieder normal.', '', '', '', 1, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(35, 'Ultra Instinct', 'uinst', 4, 1000, 0, 100, 100, 100, 100, 0, 0, 10000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, daraufhin wird !source von einer weißen brennenden Aura umgeben und wirkt sehr ruhig und fokusiert.', 'Die Aura um !source verschwindet und !source ist wieder normal.', '', '', '', 1, '', 1, 0, 0, 0, 0, 0, 0, 10000, 0, 0, 24, 1, 0, 1),
(36, 'KI Ball', 'kiball', 1, 5, 0, 100, 0, 0, 0, 0, 0, 50, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in der Hand und feuert einen KI Ball auf !target und verursacht !type !damage Schaden.', '!source sammelt Energie in der Hand und feuert einen KI Ball auf !target, verfehlt !target jedoch.', '!source sammelt Energie in der Hand und feuert einen KI Ball auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler feuert ein KI Ball auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 50, 0, 0, 8, 1, 1, 1),
(37, 'Energy Wave', 'energywave', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in der Hand und feuert einen Energiestrahl auf !target ab und verursacht !type !damage Schaden.', '!source sammelt Energie in der Hand und feuert einen Energiestrahl auf !target ab, verfehlt !target jedoch.', '!source sammelt Energie in der Hand und feuert einen Energiestrahl auf !target ab, !target ist jedoch bereits tot.', '', 'Der Spieler feuert ein Energiestrahl auf das Ziel ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 100, 0, 18, 12, 1, 1, 1),
(38, 'Eraser Cannon', 'erasercannon', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in der Hand die zu einen grünen Ball werden. !source wirft den Ball auf !target und verursacht !type !damage Schaden.', '!source sammelt Energie in der Hand die zu einen grünen Ball werden. !source wirft den Ball auf !target, !target weicht jedoch aus.', '!source sammelt Energie in der Hand die zu einen grünen Ball werden. !source wirft den Ball auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler feuert ein grünen Ball auf das Ziel.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(39, 'Double Eraser Cannon', 'doubleerasercannon', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in beiden Händen die zu grünen Bällen werden. !source wirft die Bälle auf !target und verursacht !type !damage Schaden.', '!source sammelt Energie in beiden Händen die zu grünen Bällen werden. !source wirft die Bälle auf !target, !target weicht jedoch aus.', '!source sammelt Energie in beiden Händen die zu grünen Bällen werden. !source wirft die Bälle auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler feuert zwei grüne Bälle auf das Ziel.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(40, 'Gigantic Impact', 'giganticimpact', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in der Hand und ein leuchtender grüner großer Ball entsteht. !source wirft den Ball auf !target und verursacht !type !damage Schaden.', '!source sammelt Energie in der Hand und ein leuchtender grüner großer Ball entsteht. !source wirft den Ball auf !target, !target weicht jedoch aus.', '!source sammelt Energie in der Hand und ein leuchtender grüner großer Ball entsteht. !source wirft den Ball auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler feuert einen großen grünen Ball auf das Ziel.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(41, 'Trap Shooter', 'trapshooter', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in der Hand und ein leuchtender grüner großer Ball entsteht. !source wirft den Ball auf !target, wodurch mehrere grüne Bälle entstehen und !type !damage Schaden verursachen.', '!source sammelt Energie in der Hand und ein leuchtender grüner großer Ball entsteht. !source wirft den Ball auf !target, wodurch mehrere grüne Bälle entstehen, die !target jedoch alle ausweicht.', '!source sammelt Energie in der Hand und ein leuchtender grüner großer Ball entsteht. !source wirft den Ball auf !target, wodurch mehrere grüne Bälle entstehen, jedoch ist !target bereits tot.', '', 'Der Spieler feuert einen großen grünen Ball auf das Ziel, der sich in kleinere aufteilt.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(42, 'Eraser Shot Volley', 'erasershotvolley', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt beim Werfen grüne KI Bälle in den Händen die !source auf !target kontinuierlich wirft und !type !damage Schaden verursacht.', '!source sammelt beim Werfen grüne KI Bälle in den Händen die !source auf !target kontinuierlich wirft. !target weicht jedoch allen aus.', '!source sammelt beim Werfen grüne KI Bälle in den Händen die !source auf !target kontinuierlich wirft. !target ist jedoch bereits tot.', '', 'Der Spieler feuert kontinuierlich grüne Bälle auf !target.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(43, 'Eraser Blow', 'eraserblow', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt einen grünen Energie Ball in der Hand, stellt sich direkt vor !target und schleudert !target mit der Explosion des Balles durch die Gegend. !target erleidet !type !damage Schaden.', '!source sammelt einen grünen Energie Ball in der Hand und stellt sich direkt vor !target, !target weicht jedoch aus.', '!source sammelt einen grünen Energie Ball in der Hand, stellt sich direkt vor !target und schleudert !target mit der Explosion des Balles durch die Gegend. !target ist jedoch schon tot.', '', 'Der Spieler schleudert den Gegner mit der Explosion eines KI Balles durch die Gegend.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(44, 'Blaster Meteor', 'blastermeteor', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt um sich viel Energie und schleudert daraufhin viele kleine grüne KI Bälle umher, die !target treffen und !type !damage Schaden verursachen.', '!source sammelt um sich viel Energie und schleudert daraufhin viele kleine grüne KI Bälle umher, die !target jedoch alle ausweicht.', '!source sammelt um sich viel Energie und schleudert daraufhin viele kleine grüne KI Bälle umher, !target ist jedoch bereits tot.', '', 'Der Spieler umgibt sich mit Energie und schleudert KI Bälle umher.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(45, 'Resistance Blast', 'resistanceblast', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in beiden Händen und schleudert einen grünen Energiestrahl auf !target und !target erleidet !type !damage Schaden.', '!source sammelt Energie in beiden Händen und schleudert einen grünen Energiestrahl auf !target, den !target jedoch ausweicht.', '!source sammelt Energie in beiden Händen und schleudert einen grünen Energiestrahl auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen grünen Energiestrahl auf das Ziel.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(46, 'Gigantic Eraser', 'giganticeraser', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt viel Energie in der Hand und wirft einen grünen KI Ball auf !target, wodurch !target in die Luft geschleudert wird und der Ball explodiert. !target erleidet !type !damage Schaden.', '!source sammelt viel Energie in der Hand und wirft einen grünen KI Ball auf !target, !target weicht jedoch aus.', '!source sammelt viel Energie in der Hand und wirft einen grünen KI Ball auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen grünen Energiestrahl auf das Ziel.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(47, 'Planet Geyser', 'planetgeyser', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt viel Energie in der Hand und wirft einen grünen Ki Ball auf !target. Der KI Ball kollidiert mit !target und lässt eine gewaltige Explosion entstehen wodurch !target !type !damage Schaden erleidet.', '!source sammelt viel Energie in der Hand und wirft einen grünen Ki Ball auf !target. Der KI Ball kollidiert jedoch nicht mit !target.', '!source sammelt viel Energie in der Hand und wirft einen grünen Ki Ball auf !target. Der KI Ball kollidiert mit !target und lässt eine gewaltige Explosion entstehen. !target ist jedoch bereits tot.', '', 'Der Spieler lässt eine gewaltige Explosion durch einen KI Ball entstehen.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(48, 'Omega Blaster', 'omegablaster', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand nach vorne und erzeugt viel Energie vor sich. Der grüne KI Ball wird riesig und !source schleudert den Ball auf !target. !target wird von den Ball getroffen und eine gewaltige Explosion entsteht. !target erleidet !type !damage Schaden.', '!source hält eine Hand nach vorne und erzeugt viel Energie vor sich. Der grüne KI Ball wird riesig und !source schleudert den Ball auf !target. !target weicht den Ball jedoch aus.', '!source hält eine Hand nach vorne und erzeugt viel Energie vor sich. Der grüne KI Ball wird riesig und !source schleudert den Ball auf !target. !target wird von den Ball getroffen und eine gewaltige Explosion entsteht. !target ist jedoch bereits tot.', '', 'Der Spieler lässt einen gewaltigen grünen KI Ball auf das Ziel los.', 0, 'Saiyajin', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(49, 'PowerUp', 'powerup', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine weiße Aura bildet sich um !source und die Muskeln spannen sich an.', 'Die Muskeln von !source werden wieder normal.', '', '', '', 1, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(50, 'PumpUp', 'pumpup', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine weiße Aura bildet sich um !source und die Muskeln im gesamten Körper spannen stark an.', 'Die Muskeln von !source werden wieder normal.', '', '', '', 1, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(51, 'Max Power', 'maxpower', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine weiße Aura bildet sich um !source und die Muskeln von !source spannen extremst an und weiten sich. Der Oberkörper von !source wird größer.', 'Der Körper von !source schrumpft wieder auf die normale Größe.', '', '', '', 1, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(52, 'Max Power 100%', 'maxpower100', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, eine weiße Aura bildet sich um !source und die Muskeln von !source spannen extremst an und weiten sich. Der gesamte Körper von !source wird kräftiger und größer.', 'Die Muskeln von !source schrumpfen wieder auf normaler Größe.', '', '', '', 1, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(53, 'No Ego Zone', 'noegozone', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source schließt die Augen. Daraufhin bündelt !source die innere Kraft. !source wird von einer brennenden weißen Aura umgeben. Es bildet sich zudem eine weiße Aura um die Hände.', 'Die weiße Aura um !source verschwindet.', '', '', '', 1, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(54, 'Ki Ball Thrust', 'kiballthrust', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in der Hand und schlägt damit auf !target ein, !target und verursacht !type !damage Schaden.', '!source sammelt Energie in der Hand und schlägt damit auf !target ein, !target weicht jedoch aus.', '!source sammelt Energie in der Hand und schlägt damit auf !target ein, !target ist jedoch bereits tot.', '', 'Der Spieler sammelt KI in der Hand und schlägt damit zu.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(55, 'Jumping Energy Wave', 'jumpingenergywave', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source springt über !target und lässt daraufhin eine KI Welle auf !target los. !target erleidet !type !damage Schaden.', '!source springt über !target und lässt daraufhin eine KI Welle auf !target los. !target weicht jedoch aus.', '!source springt über !target und lässt daraufhin eine KI Welle auf !target los. !target ist jedoch bereits tot.', '', 'Der Spieler springt über den Gegner und lässt eine KI Ansammlung auf den Gegner.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(56, 'Double Tsuibikidan', 'doubletsuibikidan', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände nach vorne und entlässt eine orangen-rote Energiewelle die !target verfolgt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände nach vorne und entlässt eine orangen-rote Energiewelle die !target verfolgt. !target kann der Welle jedoch ausweichen.', '!source tut beide Hände nach vorne und entlässt eine orangen-rote Energiewelle die !target verfolgt. !target ist jedoch bereits tot.', '', 'Der Spieler entlässt eine orange-rotene Energiewelle die das Ziel verfolgt.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(57, 'Scattering Bullet', 'scatteringbullet', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände nach vorne und entlässt mehrere Energiebälle die !target verfolgen. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände nach vorne und entlässt mehrere Energiebälle die !target verfolgen. !target kann jedoch erfolgreich entkommen.', '!source tut beide Hände nach vorne und entlässt mehrere Energiebälle die !target verfolgen. !target ist jedoch bereits tot.', '', 'Der Spieler feuert mehrere Energiebälle die den Gegner verfolgen.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(58, 'Wolf Fang Fist', 'wolffangfist', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source nimmt seine Haltung an, die einen Wolf ähnelt und schlägt daraufhin mit mehreren Fausthieben auf !target ein. !target erleidet !type !damage Schaden.', '!source nimmt seine Haltung an, die einen Wolf ähnelt und schlägt daraufhin mit mehreren Fausthieben auf !target ein. !target kann jedoch jeden Schlag ausweichen.', '!source nimmt seine Haltung an, die einen Wolf ähnelt und schlägt daraufhin mit mehreren Fausthieben auf !target ein. !target ist jedoch bereits tot.', '', 'Der Spieler nimmt eine Wolfshaltung an und schlägt mehrmals auf den Gegner ein.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(59, 'Destructo Disc', 'destructodisc', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut eine Hand über den Kopf und bewegt sie in Kreise. Es bildet sich eine drehende Energiescheibe. !source wirft die Scheibe auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut eine Hand über den Kopf und bewegt sie in Kreise. Es bildet sich eine drehende Energiescheibe. !source wirft die Scheibe auf !target. !target weicht jedoch aus.', '!source tut eine Hand über den Kopf und bewegt sie in Kreise. Es bildet sich eine drehende Energiescheibe. !source wirft die Scheibe auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert eine drehende Energiescheibe auf das Ziel.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(60, 'Spirit Ball', 'spiritball', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source stützt eine Hand mit der anderen und erzeugt viel Energie. Eine kleine Kugel bildet sich. !source steuert die Kugel mehrfach gegen !target. !target erleidet !type !damage Schaden.', '!source stützt eine Hand mit der anderen und erzeugt viel Energie. Eine kleine Kugel bildet sich. !source steuert die Kugel mehrfach gegen !target. !target weicht der Kugel jedoch immer aus.', '!source stützt eine Hand mit der anderen und erzeugt viel Energie. Eine kleine Kugel bildet sich. !source steuert die Kugel mehrfach gegen !target. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt eine steuerbare Energiekugel.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(61, 'Neo Wolf Fang Fist', 'neowolffangfist', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source nimmt seine Haltung an, die einen Wolf ähnelt und schlägt daraufhin mit schnellen und kräftigen Fausthieben auf !target ein. !target erleidet !type !damage Schaden.', '!source nimmt seine Haltung an, die einen Wolf ähnelt und schlägt daraufhin mit schnellen und kräftigen Fausthieben auf !target ein. !target kann jedoch jeden Schlag ausweichen.', '!source nimmt seine Haltung an, die einen Wolf ähnelt und schlägt daraufhin mit schnellen und kräftigen Fausthieben auf !target ein. !target ist jedoch bereits tot.', '', 'Der Spieler nimmt eine Wolfshaltung an und schlägt sehr oft und stark auf den Gegner ein.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(62, 'Chain Destructo Disc', 'chaindestructodisc', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut die Hände über den Kopf und bewegt sie in Kreise. Es bildet sich mehrere drehende Energiescheiben. !source wirft die Scheiben auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut die Hände über den Kopf und bewegt sie in Kreise. Es bildet sich mehrere drehende Energiescheiben. !source wirft die Scheiben auf !target. !target weicht jedoch aus.', '!source tut die Hände über den Kopf und bewegt sie in Kreise. Es bildet sich mehrere drehende Energiescheiben. !source wirft die Scheiben auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert mehrere drehende Energiescheiben auf das Ziel.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(63, 'Super Spirit Ball', 'superspiritball', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source stützt eine Hand mit der anderen und erzeugt viel Energie. Eine große Kugel bildet sich. !source steuert die Kugel mehrfach gegen !target, bevor !source die Kugel explodieren lässt. !target erleidet !type !damage Schaden.', '!source stützt eine Hand mit der anderen und erzeugt viel Energie. Eine große Kugel bildet sich. !source steuert die Kugel mehrfach gegen !target, bevor !source die Kugel explodieren lässt. !target weicht der Kugel jedoch immer aus.', '!source stützt eine Hand mit der anderen und erzeugt viel Energie. Eine große Kugel bildet sich. !source steuert die Kugel mehrfach gegen !target, bevor !source die Kugel explodieren lässt !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt eine steuerbare große Energiekugel.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(64, 'Destructo Disc Triple Blade', 'destructodisctripleblade', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut eine Hand über den Kopf und bewegt sie in Kreise. Es bildet sich eine drehende Energiescheiben. !source wirft die Scheiben auf !target, wodurch die Energiescheibe im letzten Moment zu drei weitere Energiescheiben wird. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut eine Hand über den Kopf und bewegt sie in Kreise. Es bildet sich eine drehende Energiescheiben. !source wirft die Scheiben auf !target, wodurch die Energiescheibe im letzten Moment zu drei weitere Energiescheiben wird. !target weicht jedoch aus.', '!source tut eine Hand über den Kopf und bewegt sie in Kreise. Es bildet sich eine drehende Energiescheiben. !source wirft die Scheiben auf !target, wodurch die Energiescheibe im letzten Moment zu drei weitere Energiescheiben wird. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert eine Energiescheibe auf das Ziel, die sich in drei weitere aufteilt.', 0, 'Mensch', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(65, 'Second Form', 'secondform', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, der Körper wächst in die Höhe und nimmt eine erwachsene Gestalt an.', '!source schrumpft wieder zurück.', '', '', '', 1, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(66, 'Third Form', 'thirdform', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, wächst in der Höhe, der Hinterkopf wächst in die Länge und Hörner bilden sich.', '!source schrumpft wieder zu der normalen Form.', '', '', '', 1, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(67, 'Final Form', 'finalform', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, daraufhin wird der Körper von !source weiß, die Hörner verschwinden und !source wächst ein bisschen.', 'Der Körper von !source schrumpft wieder auf die normale Größe.', '', '', '', 1, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(68, 'Final Form 100%', 'finalform100', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, !source färbt sich weiß und wächst etwas in der Höhe, zusätzlich spannen die Muskeln von !source extremst an.', 'Die Muskeln und der gesamte Körper von !source schrumpfen wieder auf normaler Größe.', '', '', '', 1, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(69, 'Golden Form', 'goldenform', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source schließt die Augen, daraufhin wird !source von einer goldenen Aura umgeben und der Körper färbt sich golden, zudem wächst !source ein wenig.', 'der Körper von !source färbt sich wieder normal.', '', '', '', 1, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(70, 'Telekinesis', 'telekinesis', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt mit den Gedanken Steine und wirft sie auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source bewegt mit den Gedanken Steine und wirft sie auf !target. !target weicht jedoch aus.', '!source bewegt mit den Gedanken Steine und wirft sie auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler wirft per Gedanken Steine auf den Gegner.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(71, 'Death Cannon', 'deathcannon', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie vor sich und erzeugt einen lilanen Ball. !source wirft den Ball auf !target und verursacht !type !damage Schaden.', '!source sammelt Energie vor sich und erzeugt einen lilanen Ball. !source wirft den Ball auf !target, !target weicht jedoch aus.', '!source sammelt Energie vor sich und erzeugt einen lilanen Ball. !source wirft den Ball auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler feuert einen lilanen Energieball auf das Ziel.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(72, 'Red Energy Blast', 'redenergyblast', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source richtet eine Hand auf !target und entlässt einen roten Energiestrahl. !target wird getroffen und erleidet !type !damage Schaden.', '!source richtet eine Hand auf !target und entlässt einen roten Energiestrahl. !target weicht jedoch aus.', '!source richtet eine Hand auf !target und entlässt einen roten Energiestrahl. !target ist jedoch bereits tot.', '', 'Der Spieler feuert einen roten Energiestrahl auf das Ziel.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(73, 'Killer Ball', 'killerball', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hände in der Richtung von !target und schießt kontinuierlich mehrere rote Energiebälle auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält die Hände in der Richtung von !target und schießt kontinuierlich mehrere rote Energiebälle auf !target. !target weicht jedoch allen aus.', '!source hält die Hände in der Richtung von !target und schießt kontinuierlich mehrere rote Energiebälle auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler feuert kontinuierlich mehrere rote Energiebälle auf das Ziel.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(74, 'Nova Strike', 'novastrike', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source umgibt sich mit lilaner Energie und fliegt schnell auf !target zu. !target wird von !source getroffen und erleidet !type !damage Schaden.', '!source umgibt sich mit lilaner Energie und fliegt schnell auf !target zu. !target weicht jedoch im letzten Moment aus.', '!source umgibt sich mit lilaner Energie und fliegt schnell auf !target zu. !target wird von !source getroffen, ist jedoch bereits tot.', '', 'Der Spieler umgibt sich mit lilaner Energie und fliegt auf das Ziel zu.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(75, 'Last Emperor', 'lastemperor', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand in Richtung von !target, sammelt Energie und entlässt einen lilanen Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält eine Hand in Richtung von !target, sammelt Energie und entlässt einen lilanen Energiestrahl auf !target. !target weicht jedoch aus.', '!source hält eine Hand in Richtung von !target, sammelt Energie und entlässt einen lilanen Energiestrahl auf !target. !target ist jedoch schon tot.', '', 'Der Spieler schleudert einen lilanen Energiestrahl auf das Ziel.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(76, 'Death Blaster', 'deathblaster', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source zielt mit einer Hand auf !target und erzeugt einen hellen gelben Energieball. !source wirft den Energieball auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source zielt mit einer Hand auf !target und erzeugt einen hellen gelben Energieball. !source wirft den Energieball auf !target. !target weicht jedoch aus.', '!source zielt mit einer Hand auf !target und erzeugt einen hellen gelben Energieball. !source wirft den Energieball auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt einen hellen gelben Energieball und wirft ihn auf das Ziel.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(77, 'Death Wave', 'deathwave', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source schlägt diagonal in die Richtung von !target und erzeugt dabei eine lilane Energiewelle. Die Energiewelle rast auf !target zu und verursacht !type !damage Schaden.', '!source schlägt diagonal in die Richtung von !target und erzeugt dabei eine lilane Energiewelle. Die Energiewelle rast auf !target zu, !target weicht jedoch aus.', '!source schlägt diagonal in die Richtung von !target und erzeugt dabei eine lilane Energiewelle. Die Energiewelle rast auf !target zu, !target ist jedoch bereits tot.', '', 'Der Spieler schlägt in die Luft und erzeugt eine Energiewelle.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(78, 'Death Saucer', 'deathsaucer', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält zwei Hände nach oben und erzeugt drehende Scheiben, die !source auf !target wirft und !target verfolgen. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält zwei Hände nach oben und erzeugt drehende Scheiben, die !source auf !target wirft und !target verfolgen. !target weicht jedoch aus.', '!source hält zwei Hände nach oben und erzeugt drehende Scheiben, die !source auf !target wirft und !target verfolgen. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt zwei drehende Scheiben die das Ziel verfolgen.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(79, 'Emperors Edge', 'emperorsedge', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source schlägt in der Richtung von !target und erzeugt eine lilane Energiewelle. Die Energiewelle rast auf !target zu und verursacht eine große Explosion. !target erleidet !type !damage Schaden.', '!source schlägt in der Richtung von !target und erzeugt eine lilane Energiewelle. Die Energiewelle rast auf !target zu und verursacht eine große Explosion. !target konnte jedoch ausweichen.', '!source schlägt in der Richtung von !target und erzeugt eine lilane Energiewelle. Die Energiewelle rast auf !target zu und verursacht eine große Explosion. !target ist jedoch bereits tot.', '', 'Der Spieler schlägt in der Richtung des Zieles und erzeugt eine lilane Energiewelle.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(80, 'Earth Breaker', 'earthbreaker', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände auf den Boden und entlässt eine gewaltige Energie. Es entsteht eine riesige Energieexplosion die !target trifft und !type !damage Schaden verursacht.', '!source tut beide Hände auf den Boden und entlässt eine gewaltige Energie. Es entsteht eine riesige Energieexplosion. !target wird jedoch nicht von der Explosion getroffen.', '!source tut beide Hände auf den Boden und entlässt eine gewaltige Energie. Es entsteht eine riesige Energieexplosion die !target trifft, jedoch ist !target bereits tot.', '', 'Der Spieler entlässt eine gewaltige Energieexplosion in den Boden.', 0, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(81, 'PowerUp', 'powerupkai', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, wodurch !source von einer weißen Aura umgeben wird.', 'Die Aura um !source verschwindet wieder.', '', '', '', 1, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(82, 'Power Unlocked', 'unlockpowerkai', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, wodurch eine brennende weiße Aura !source umgibt.', 'Die brennende weiße Aura um !source verschwindet.', '', '', '', 1, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(83, 'Barrier of Light', 'barrieroflight', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus und weiße Kreise entstehen hinter !source. !source erhält eine Menge Energie.', 'Die weißen Kreise hinter !source verschwinden wieder.', '', '', '', 1, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(84, 'Wall of Light', 'walloflight', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arma aus und entlässt eine gewaltige Menge KI in die Luft die !source umgibt und einen Vogel bilden.', 'Die gewaltige Menge KI um !source verschwindet wieder.', '', '', '', 1, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(85, 'Light of Divine Justice', 'lightofjustice', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus und rote Blitze schlägen in !source und die Umgebung ein. !source wird von den roten Blitzen umgeben.', 'Die Blitze um !source verschwinden wieder.', '', '', '', 1, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(86, 'Energy Blade', 'energyblade', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source umgibt eine Hand mit Energie und schlägt damit auf !target ein. !target erleidet !type !damage Schaden.', '!source umgibt eine Hand mit Energie und schlägt damit auf !target ein. !target weicht jedoch aus.', '!source umgibt eine Hand mit Energie und schlägt damit auf !target ein. !target ist jedoch bereits tot.', '', 'Der Spieler umgibt die Hand mit Energie und schlägt damit auf den Gegner ein.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(87, 'Violent Fierce God Slicer', 'violentfierce', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source umgibt die Hand mit Energie wodurch eine Klinge entsteht. !source greift mit der Klinge !target an. !target erleidet !type !damage Schaden.', '!source umgibt die Hand mit Energie wodurch eine Klinge entsteht. !source greift mit der Klinge !target an. !target weicht jedoch aus.', '!source umgibt die Hand mit Energie wodurch eine Klinge entsteht. !source greift mit der Klinge !target an. !target ist jedoch bereits tot.', '', 'Der Spieler erschafft um die Hand eine Klinge.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(88, 'Azure Dragon Sword', 'azuredragonsword', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source umgibt die Hand mit Energie und ein großes lilanes Schwert aus Energie entsteht. !source zielt mit dem Schwert auf !target und durchbohrt !target. !target erleidet !type !damage Schaden.', '!source umgibt die Hand mit Energie und ein großes lilanes Schwert aus Energie entsteht. !source zielt mit dem Schwert auf !target, !target weicht jedoch aus.', '!source umgibt die Hand mit Energie und ein großes lilanes Schwert aus Energie entsteht. !source zielt mit dem Schwert auf !target und durchbohrt !target. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt aus Energie ein großes Energieschwert.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(89, 'Flame of Retribution', 'flameofretribution', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie im Auge und schießt vom gesamten Körper einen Energiestrahl auf !target. !target erleidet !type !damage Schaden.', '!source sammelt Energie im Auge und schießt vom gesamten Körper einen Energiestrahl auf !target. !target konnte den Energiestrahl jedoch ausweichen.', '!source sammelt Energie im Auge und schießt vom gesamten Körper einen Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler feuert aus dem gesamten Körper einen Energiestrahl.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(90, 'Divine Lasso', 'divinelasso', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source erzeugt eine Energieklinge und zielt mit der Spitze in einen Schlag auf !target. Kleine Energielassos entstehen die !target durchbohren und !type !damage Schaden verursachen.', '!source erzeugt eine Energieklinge und zielt mit der Spitze in einen Schlag auf !target. Kleine Energielassos entstehen die !target jedoch ausweichen kann.', '!source erzeugt eine Energieklinge und zielt mit der Spitze in einen Schlag auf !target. Kleine Energielassos entstehen die !target durchbohren, jedoch ist !target bereits tot.', '', 'Der Spieler erzeugt Energielassos die den Gegner durchbohren.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1);
INSERT INTO `attacks` (`id`, `name`, `image`, `type`, `value`, `epvalue`, `lpvalue`, `kpvalue`, `atkvalue`, `defvalue`, `tauntvalue`, `reflectvalue`, `kp`, `lp`, `energy`, `procentual`, `procentualcost`, `learnlp`, `learnki`, `learnkp`, `learnattack`, `learndefense`, `accuracy`, `text`, `missText`, `deadText`, `loadtext`, `description`, `transformationid`, `race`, `displayed`, `loadattack`, `npcid`, `loadrounds`, `blockattack`, `blockedattack`, `item`, `minvalue`, `rounds`, `level`, `learntime`, `npcpickable`, `costgenerated`, `displaydied`) VALUES
(91, 'Black Power Ball', 'blackpowerball', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source erzeugt einen gelben Energieball mit einen schwarzen Kern in der Hand. !source wirft den Ball auf !target und der Ball explodiert. !target erleidet !type !damage Schaden.', '!source erzeugt einen gelben Energieball mit einen schwarzen Kern in der Hand. !source wirft den Ball auf !target und der Ball explodiert. !target weicht jedoch aus.', '!source erzeugt einen gelben Energieball mit einen schwarzen Kern in der Hand. !source wirft den Ball auf !target und der Ball explodiert. !target ist jedoch schon tot.', '', 'Der Spieler erzeugt einen gelben Energieball mit einen schwarzen Kern in der Hand', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(92, 'Holy Light Grenade', 'holylightgrenade', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand in die Luft und erzeugt einen großen lilanen Energieball. !source wirft den Energieball auf !target und der Ball explodiert. !target erleidet !type !damage Schaden.', '!source hält eine Hand in die Luft und erzeugt einen großen lilanen Energieball. !source wirft den Energieball auf !target und der Ball explodiert. !target weicht jedoch aus.', '!source hält eine Hand in die Luft und erzeugt einen großen lilanen Energieball. !source wirft den Energieball auf !target und der Ball explodiert. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt einen großen lilanen Energieball.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(93, 'Absolute Lightning', 'absolutelightning', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus und lilane Blitze entstehen hinter !source die auf !target zurasen. !target wird von den Blitzen getroffen und erleidet !type !damage Schaden.', '!source breitet die Arme aus und lilane Blitze entstehen hinter !source die auf !target zurasen. !target weicht jeden Blitz einzelnd aus.', '!source breitet die Arme aus und lilane Blitze entstehen hinter !source die auf !target zurasen. !target wird von den Blitzen getroffen, ist jedoch bereits tot.', '', 'Der Spieler erzeugt Blitze die auf den Gegner zurasen.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(94, 'Blades of Judgement', 'bladesofjudgement', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus, wodurch hinter !source viele rote Energieklingen entstehen die auf !target zurasen. !target wird von jeder einzelnen Klinge getroffen und erleidet !type !damage Schaden.', '!source breitet die Arme aus, wodurch hinter !source viele rote Energieklingen entstehen die auf !target zurasen. !target weicht jedoch jeder Klinge aus.', '!source breitet die Arme aus, wodurch hinter !source viele rote Energieklingen entstehen die auf !target zurasen. !target wird von jeder einzelnen Klinge getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt rote Energieklingen die auf den Gegner zurasen.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(95, 'Divine Wrath', 'divinewrath', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source erzeugt einen lilanen Energieball in einer Hand. !source schleudert den Arm nach vorne und der Energieball wird zu einen gewaltigen Energiestrahl der auf !target zurast. !target wird getroffen und erleidet !type !damage Schaden.', '!source erzeugt einen lilanen Energieball in einer Hand. !source schleudert den Arm nach vorne und der Energieball wird zu einen gewaltigen Energiestrahl der auf !target zurast, !target weicht jedoch aus.', '!source erzeugt einen lilanen Energieball in einer Hand. !source schleudert den Arm nach vorne und der Energieball wird zu einen gewaltigen Energiestrahl der auf !target zurast. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler verwandelt einen Energieball in einen Energiestrahl.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(96, 'Holy Wrath', 'holywrath', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit einen Finger in die Luft, wodurch ein brennender Sonnen-ähnlicher Energieball entsteht, der immer größer wird. !source wirft den Energieball auf !target und der Energieball explodiert. !target erleidet !type !damage Schaden.', '!source zeigt mit einen Finger in die Luft, wodurch ein brennender Sonnen-ähnlicher Energieball entsteht, der immer größer wird. !source wirft den Energieball auf !target und der Energieball explodiert. !target wird jedoch nicht von der Explosion getroffen.', '!source zeigt mit einen Finger in die Luft, wodurch ein brennender Sonnen-ähnlicher Energieball entsteht, der immer größer wird. !source wirft den Energieball auf !target und der Energieball explodiert. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler erzeugt eine Sonnen-ähnlichen Energieball und schleudert ihn auf das Ziel.', 0, 'Kaioshin', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(97, 'PowerUp', 'powerupandroid', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie Energie und wird von einer Aura umgeben.', 'Die Aura um !source verschwindet wieder.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(98, 'PowerUp', 'powerupandroid2', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie Energie und wird von einer Aura umgeben.', 'Die Aura um !source verschwindet wieder.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(99, 'Semi Perfect', 'semiperfect', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und beginnt zu leuchten. Daraufhin verändert sich die Form von !source, die Flügel verschwindet und der Körper ändert sich.', 'Der Körper von !source wird wieder normal.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(100, 'Upgrade Memory', 'upgradememory', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source absorbiert einen Speicherchip und die Energie von !source steigt an.', 'Der Speicherchip von !source erhält einen Kurzschluss.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(101, 'Perfect Form', 'perfectform', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und beginnt zu leuchten. Daraufhin verändern sich die Flügel von !source und der Schweif von !source wird viel kürzer. Der Körper von !source ändert sich ebenfalls und das Gesicht wird menschlicher.', 'Der Körper von !source wird wieder normal.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(102, 'Upgrade Battery', 'upgradebattery', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source verleibt sich zwei Energiezellen ein, wodurch die Energie von !source extremst steigt.', 'Die Energiezellen von !source erhalten einen Kurzschluss.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(103, 'Power Stressed', 'powerstressed', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und der Körper von !source wächst, die Muskeln spannen an und Blitze entstehen um !source.', 'Der Körper von !source wird wieder normal.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(104, 'Semi Upgrade', 'semiupgrade', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source absorbiert zusätzliche Chips und der Körper von !source wird blau, wächst und verändert sich. Die Haare färben sich silbernd.', 'Die Chips von !source erhalten einen Kurzschluss und !source verwandelt sich zurück.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(105, 'Super Perfect', 'superperfect', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, wodurch eine gelbe Aura entsteht, der Körper von !source sich verändert und !source von Blitzen umgeben wird.', 'Die Aura und die Blitze um !source verschwinden.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(106, 'Full Upgrade', 'fullupgrade', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source absorbiert mehrere Chips und Energiezellen, wodurch sich der Körper von !source blau färbt, die Haare werden orange und die Muskeln werden größer.', 'Die Chips und Energiezellen von !source erhalten einen Kurzschluss, wodurch der Körper von !source wieder normal wird.', '', '', '', 1, 'Android', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(107, 'Fourth Form', 'fourthform', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, wodurch !source wächst und die Rüstung am Körper von !souce sich verbreitet.', 'Die Rüstung von !source wird wieder normal und !source schrumpft wieder.', '', '', '', 1, 'Freezer', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(108, 'Quick Blast', 'quickblast', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt sich direkt vor !target und lässt Energie explodieren. !target erleidet !type !damage Schaden.', '!source bewegt sich direkt vor !target und lässt Energie explodieren. !target weicht jedoch aus.', '!source bewegt sich direkt vor !target und lässt Energie explodieren. !target ist jedoch bereits tot.', '', 'Der Spieler lässt Energie direkt vor dem Gegner explodieren.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(109, 'Power Blitz', 'powerblitz', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit einer Hand auf !target und entlässt eine rote Energiewelle auf !target. !target erleidet !type !damage Schaden.', '!source zeigt mit einer Hand auf !target und entlässt eine rote Energiewelle auf !target. !target weicht jedoch aus.', '!source zeigt mit einer Hand auf !target und entlässt eine rote Energiewelle auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler lässt eine rote Energiewelle auf den Gegner los.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(110, 'Photon Flash', 'photonflash', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit einer Hand auf !target und entlässt einen gelben Energiestrahl. Der Energiestrahl durchbohrt !target und !target erleidet !type !damage Schaden.', '!source zeigt mit einer Hand auf !target und entlässt einen gelben Energiestrahl. !target weicht den Energiestrahl jedoch aus.', '!source zeigt mit einer Hand auf !target und entlässt einen gelben Energiestrahl. Der Energiestrahl durchbohrt !target, !target ist jedoch bereits tot.', '', 'Der Spieler durchbohrt den Gegner mit einen gelben Energiestrahl.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(111, 'Perfect Barrier', 'perfectbarrier', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie und entlässt eine riesige Energiebarriere. !target wird mit der Barriere mitgerissen und erleidet !type !damage Schaden.', '!source sammelt Energie und entlässt eine riesige Energiebarriere. !target kann jedoch noch der Barriere entkommen.', '!source sammelt Energie und entlässt eine riesige Energiebarriere. !target wird mit der Barriere mitgerissen, ist jedoch bereits tot.', '', 'Der Spieler entlässt eine riesige Energiebarriere.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(112, 'Grappling KI Blast', 'grapplingkiblast', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt sich schnell zu !target und hält !target fest. Daraufhin entlässt !source eine rote Energiewelle direkt auf !target und !target erleidet !type !damage Schaden.', '!source bewegt sich schnell zu !target und hält !target fest. Daraufhin entlässt !source eine rote Energiewelle direkt auf !target, !target kann sich in diesen Moment jedoch befreien.', '!source bewegt sich schnell zu !target und hält !target fest. Daraufhin entlässt !source eine rote Energiewelle direkt auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler greift den Gegner und entlässt eine rote Energiewelle.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(113, 'High Pressure Energy Wave', 'highpressureenergywave', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt sich schnell auf !target zu, hält beide Hände auf !target und entlässt einen starken gelben Energiestrahl. !target wird durchbohrt und erleidet !type !damage Schaden.', '!source bewegt sich schnell auf !target zu, hält beide Hände auf !target und entlässt einen starken gelben Energiestrahl. !target weicht jedoch aus.', '!source bewegt sich schnell auf !target zu, hält beide Hände auf !target und entlässt einen starken gelben Energiestrahl. !target wird durchbohrt, !target ist jedoch schon tot.', '', 'Der Spieler durchbohrt den Gegner mit einen gelben Energiestrahl.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(114, 'Infinity Bullet', 'infinitybullet', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält beide Hände auf !target und entlässt kontinuierlich für eine lange Zeit Energiekugeln, die auf !target einschlagen und exploderen. !target erleidet !type !damage Schaden.', '!source hält beide Hände auf !target und entlässt kontinuierlich für eine lange Zeit Energiekugeln, die !target jedoch alle ausweichen kann.', '!source hält beide Hände auf !target und entlässt kontinuierlich für eine lange Zeit Energiekugeln, die auf !target einschlagen und exploderen. !target ist jedoch bereits tot.', '', 'Der Spieler schießt für eine lange Zeit Energiekugeln auf den Gegner.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(115, 'Electric Shot', 'electricshot', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält beide Hände in Richtung von !target und erzeugt eine lilane Kugel die von Blitzen umgeben ist. !source schießt die Kugel auf !target, die !target trifft und explodiert. !target erleidet !type !damage Schaden.', '!source hält beide Hände in Richtung von !target und erzeugt eine lilane Kugel die von Blitzen umgeben ist. !source schießt die Kugel auf !target, !target weicht jedoch aus.', '!source hält beide Hände in Richtung von !target und erzeugt eine lilane Kugel die von Blitzen umgeben ist. !source schießt die Kugel auf !target, die !target trifft und explodiert. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt eine blitzende lilane Kugel und schießt sie auf den Gegner.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(116, 'Grand Explode', 'grandexplode', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt sich direkt neben !target und sperrt !target in einer Barriere ein. Daraufhin konzentriert !source die Energie in der Batterie und entlässt die komplette Energie, wodurch eine gewaltige Explosion entsteht. !target wird getroffen und erleidet !type !damage Schaden.', '!source bewegt sich direkt neben !target und sperrt !target in einer Barriere ein. Daraufhin konzentriert !source die Energie in der Batterie und entlässt die komplette Energie, wodurch eine gewaltige Explosion entsteht. !target kann jedoch der Barriere noch im letzten Moment entkommen.', '!source bewegt sich direkt neben !target und sperrt !target in einer Barriere ein. Daraufhin konzentriert !source die Energie in der Batterie und entlässt die komplette Energie, wodurch eine gewaltige Explosion entsteht. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler lässt die innere Energie aus der Batterie frei wodurch eine riesige Explosion entsteht.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(117, 'S.S Deadly Bomber', 'ssdeadlybomber', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus und ein roter Energieball entsteht. Der Energieball wird daraufhin von einer roten Barriere umgeben und fängt an zu glitzern. !source schießt die Kugel auf !target und die Kugel reißt !target mit sich und explodiert. !target erleidet !type !damage Schaden.', '!source breitet die Arme aus und ein roter Energieball entsteht. Der Energieball wird daraufhin von einer roten Barriere umgeben und fängt an zu glitzern. !source schießt die Kugel auf !target und die Kugel reißt !target mit sich und explodiert. !target konnte jedoch im letzten Moment entkommen.', '!source breitet die Arme aus und ein roter Energieball entsteht. Der Energieball wird daraufhin von einer roten Barriere umgeben und fängt an zu glitzern. !source schießt die Kugel auf !target und die Kugel reißt !target mit sich und explodiert. !target ist jedoch bereits tot.', '', 'Der Spieler schießt eine rote Energiekugel mit einer roten Barriere auf den Gegner die explodiert.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(118, 'Full Power S.S Deadly Bomber', 'fullssdeadlybomber', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus und ein roter Energieball entsteht. Der Energieball wird daraufhin von einer roten Barriere umgeben und fängt an zu glitzern. Die Kugel beginnt daraufhin gewaltig zu wachsen. !source schießt die Kugel auf !target und die Kugel reißt !target mit sich und explodiert. !target erleidet !type !damage Schaden.', '!source breitet die Arme aus und ein roter Energieball entsteht. Der Energieball wird daraufhin von einer roten Barriere umgeben und fängt an zu glitzern. Die Kugel beginnt daraufhin gewaltig zu wachsen. !source schießt die Kugel auf !target und die Kugel reißt !target mit sich und explodiert. !target konnte jedoch im letzten Moment entkommen.', '!source breitet die Arme aus und ein roter Energieball entsteht. Der Energieball wird daraufhin von einer roten Barriere umgeben und fängt an zu glitzern. Die Kugel beginnt daraufhin gewaltig zu wachsen. !source schießt die Kugel auf !target und die Kugel reißt !target mit sich und explodiert. !target ist jedoch bereits tot.', '', 'Der Spieler schießt eine gewaltige rote Energiekugel mit einer roten Barriere auf den Gegner die explodiert.', 0, 'Android', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(119, 'Angry Mode', 'angrymode', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird wütend und Dampf entsteht aus den Löchern am Kopf von !source.', '!source beruhigt sich wieder.', '', '', '', 1, 'Majin', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(120, 'Thin Mode', 'thinmode', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird wütend, Dampf entsteht um !source der !source komplett umgibt. Als der Dampf verschwunden ist, ist !source plötzlich viel dünner und grau.', '!source beruhigt sich wieder und wird wieder dicker und pink.', '', '', '', 1, 'Majin', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(121, 'Super Mode', 'supermode', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird wütend und Dampf kommt aus den Löchern von !source und umgibt !source komplett. Als der Dampf wieder verschwunden ist, ist !source plötzlich viel dünner, maskuliner und schaut böse.', '!source beruhigt sich wieder und der Körper wird wieder dicker.', '', '', '', 1, 'Majin', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(122, 'Angry Super Mode', 'angrysupermode', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird wütend und Dampf kommt aus den Löchern von !source und umgibt !source komplett. Als der Dampf wieder verschwunden ist, ist !source plötzlich viel dünner, maskuliner und der Körper ist von Adern umzogen. !source ist sehr wütend.', '!source beruhigt sich wieder und der Körper wird wieder dicker.', '', '', '', 1, 'Majin', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(123, 'Kid Mode', 'kidmode', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird wütend und Dampf kommt aus den Löchern von !source und umgibt !source komplett. Als der Dampf wieder verschwunden ist, ist !source plötzlich viel dünner und sieht aus wie ein Kind.', '!source beruhigt sich wieder und wird dicker und größer.', '', '', '', 1, 'Majin', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(124, 'Slim Mode', 'slimmode', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, wodurch !source plötzlich viel dünner wird und muskulöser. !source lächelt und ist plötzlich viel stärker und schneller.', '!source entspannt sich und wird wieder dicker.', '', '', '', 1, 'Majin', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(125, 'Wrap Attack', 'wrapattack', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird länger und fesselt !target mit den Körper und drückt zu. !target erleidet !type !damage Schaden.', '!source wird länger und fesselt !target mit den Körper und drückt zu. !target kann sich jedoch noch herauswinden.', '!source wird länger und fesselt !target mit den Körper und drückt zu. !target ist jedoch bereits tot.', '', 'Der Spieler umgibt den Gegner mit den Körper.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(126, 'Antenna Beam', 'antennabeam', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source feuert einen pinken Energiestrahl von den Antennen auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source feuert einen pinken Energiestrahl von den Antennen auf !target. !target weicht jedoch aus.', '!source feuert einen pinken Energiestrahl von den Antennen auf !target. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler feuert einen pinken Energiestrahl auf das Ziel.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(127, 'Mouth Blast', 'mouthblast', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source öffnet den Mund und feuert einen pinken Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source öffnet den Mund und feuert einen pinken Energiestrahl auf !target. !target weicht den Energiestrahl jedoch aus.', '!source öffnet den Mund und feuert einen pinken Energiestrahl auf !target. Der Energiestrahl trifft !target, !target ist jedoch bereits tot.', '', 'Der Spieler feuert einen pinken Energiestrahl aus den Mund.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(128, 'Vanishing Beam', 'vanishingbeam', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand in der Richtung von !target und feuert einen pinken Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält eine Hand in der Richtung von !target und feuert einen pinken Energiestrahl auf !target. !target weicht jedoch aus.', '!source hält eine Hand in der Richtung von !target und feuert einen pinken Energiestrahl auf !target. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler entlässt eine pinken Energiestrahl von der Hand aus.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(129, 'III Flash', '3flash', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source öffnet den Mund und nutzt den ganzen Körper um einen großen pinken Energiestrahl auf !target zu schießen. !target wird getroffen und eine Explosion entsteht. !target erleidet !type !damage Schaden.', '!source öffnet den Mund und nutzt den ganzen Körper um einen großen pinken Energiestrahl auf !target zu schießen. !target weicht den Strahl jedoch aus.', '!source öffnet den Mund und nutzt den ganzen Körper um einen großen pinken Energiestrahl auf !target zu schießen. !target wird getroffen und eine Explosion entsteht. !target ist jedoch bereits tot.', '', 'Der Spieler feuert aus den Mund einen großen pinken Energiestrahl.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(130, 'Vaporize', 'vaporize', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält beide Hände in der Richtung von !target und feuert einen Energiestrahl bestehend aus mehreren Wellen auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält beide Hände in der Richtung von !target und feuert einen Energiestrahl bestehend aus mehreren Wellen auf !target. !target weicht jedoch aus.', '!source hält beide Hände in der Richtung von !target und feuert einen Energiestrahl bestehend aus mehreren Wellen auf !target. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler feuert einen Energiestrahl aus mehreren Wellen auf den Gegner.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(131, 'Angry Explosion', 'angryexplosion', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert die Energie und leuchtet pink. Daraufhin entsteht eine riesige Explosion von !source aus und bewegt sich auf !target zu. !target wird von der Explosion getroffen und erleidet !type !damage Schaden.', '!source konzentriert die Energie und leuchtet pink. Daraufhin entsteht eine riesige Explosion von !source aus und bewegt sich auf !target zu. !target kann der Explosion jedoch entkommen.', '!source konzentriert die Energie und leuchtet pink. Daraufhin entsteht eine riesige Explosion von !source aus und bewegt sich auf !target zu. !target ist jedoch bereits tot.', '', 'Der Spieler explodiert und verursacht viel Schaden.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(132, 'Revenge Death Bomber', 'revengedeathbomber', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert die Energie, !source und die Umgebung leuchten pink auf. Daraufhin entsteht eine gewaltige Explosion von !source aus und bewegt sich auf !target zu. !target wird von der Explosion getroffen und erleidet !type !damage Schaden.', '!source konzentriert die Energie, !source und die Umgebung leuchten pink auf. Daraufhin entsteht eine gewaltige Explosion von !source aus und bewegt sich auf !target zu. !target kann der Explosion jedoch entkommen.', '!source konzentriert die Energie, !source und die Umgebung leuchten pink auf. Daraufhin entsteht eine gewaltige Explosion von !source aus und bewegt sich auf !target zu. !target ist jedoch bereits tot.', '', 'Der Spieler explodiert und verursacht extremst viel Schaden.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(133, 'Assault Rain', 'assaultrain', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand in der Luft und entlässt für eine lange Zeit sehr viele Energiekugeln. Die Energiekugeln rasen auf !target zu. !target wir daraufhin für eine lange Zeit von vielen Energiekugeln getroffen. !target erleidet !type !damage Schaden.', '!source hält eine Hand in der Luft und entlässt für eine lange Zeit sehr viele Energiekugeln. Die Energiekugeln rasen auf !target zu. !target kann jedoch jeder Kugel entkommen.', '!source hält eine Hand in der Luft und entlässt für eine lange Zeit sehr viele Energiekugeln. Die Energiekugeln rasen auf !target zu. !target wir daraufhin für eine lange Zeit von vielen Energiekugeln getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler entlässt kontiniuerlich über eine lange Zeit pinke Energiekugeln.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(134, 'Shocking Ball', 'shockingball', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand in die Luft und ein pinker Ball der  von Blitzen umgeben ist entsteht. !source lacht und wirft den Ball auf !target. !target wird von den Ball getroffen wodrauf der Ball explodiert. !target erleidet !type !damage Schaden.', '!source hält eine Hand in die Luft und ein pinker Ball der  von Blitzen umgeben ist entsteht. !source lacht und wirft den Ball auf !target. !target weicht den Ball jedoch aus, bevor dieser explodiert.', '!source hält eine Hand in die Luft und ein pinker Ball der  von Blitzen umgeben ist entsteht. !source lacht und wirft den Ball auf !target. !target wird von den Ball getroffen wodrauf der Ball explodiert. !target ist jedoch bereits tot.', '', 'Der Spieler wirft einen geladenen pinken Energieball auf das Ziel.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(135, 'Planet Burst', 'planetburst', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand in die Luft und ein pinker Energieball entsteht, der immer größer wird. Daraufhin lacht !source und wirft den Energieball auf !target. Eine gewaltige Explosion entsteht. !target erleidet !type !damage Schaden.', '!source hält eine Hand in die Luft und ein pinker Energieball entsteht, der immer größer wird. Daraufhin lacht !source und wirft den Energieball auf !target. Eine gewaltige Explosion entsteht. !target konnte jedoch im letzten Moment entkommen.', '!source hält eine Hand in die Luft und ein pinker Energieball entsteht, der immer größer wird. Daraufhin lacht !source und wirft den Energieball auf !target. Eine gewaltige Explosion entsteht. !target ist jedoch bereits tot.', '', 'Der Spieler schießt eine gewaltige pinke Energiekugel den Gegner die explodiert.', 0, 'Majin', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(136, 'Concentrate', 'concentrate', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source schließt die Augen und konzentriert die innere Energie.', '!source hört mit der Konzentration auf.', '', '', '', 1, 'Demon', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(137, 'Demonic Will', 'demonicwill', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und Blitze umgeben !source, wodurch !source um einiges stärker wird.', '!source hört auf sich zu konzentrieren und die Blitze verschwinden.', '', '', '', 1, 'Demon', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(138, 'Evil Energy', 'evilenergy', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source ruft böse Energie aus der Hölle und atmet sie ein. Daraufhin verändert sich die Form von !source und !source wird kindlicher.', '!source verwandelt sich wieder zurück in die normale Form.', '', '', '', 1, 'Demon', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(139, 'Super Evil', 'superevil', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source ruft böse Energie aus der Hölle und atmet sie ein. Daraufhin verändert sich die Form von !source und !source wird muskulöser und nimmt eine mehr Dämonenhafte Gestalt an.', '!source verwandelt sich wieder zurück in die normale Form.', '', '', '', 1, 'Demon', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(140, 'Demon God', 'demongod', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source ruft böse Energie aus der Hölle und atmet sie ein. Daraufhin schreit !source auf, die Form von !source verändert sich, !source erhält einen Schweif und die Haare werden spiter. Böse Energie umgibt !source.', '!source verwandelt sich wieder zurück in die normale Form und die böse Energie verschwindet.', '', '', '', 1, 'Demon', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(141, 'Evil Spear', 'evilspear', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source erzeugt einen Speer und wirft den Speer auf !target. !target wird durchbohrt und erleidet !type !damage Schaden.', '!source erzeugt einen Speer und wirft den Speer auf !target. !target weicht jedoch aus.', '!source erzeugt einen Speer und wirft den Speer auf !target. !target wird durchbohrt, ist jedoch bereits tot.', '', 'Der Spieler wirft einen Speer.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(142, 'Hate Ray Cannon', 'hateraycannon', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand nach vorne und erzeugt mehrere Energiebälle die auf !target zufliegen. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält eine Hand nach vorne und erzeugt mehrere Energiebälle die auf !target zufliegen. !target weicht jedoch aus.', '!source hält eine Hand nach vorne und erzeugt mehrere Energiebälle die auf !target zufliegen. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler feuert mehrere Energiebälle auf den Gegner.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(143, 'Evil Flame', 'evilflame', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source spuckt Flammen aus den Mund, welche !target umschlingen. !target wird getroffen, brennt und erleidet !type !damage Schaden.', '!source spuckt Flammen aus den Mund, welche !target umschlingen. !target konnte den Flammen jedoch entkommen.', '!source spuckt Flammen aus den Mund, welche !target umschlingen. !target wird getroffen, ist jedoch bereits schon tot. ', '', 'Der Spieler spuckt Flammen aus den Mund, welche ihr Ziel umschlingen. ', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(144, 'Evil Impulse', 'evilimpulse', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand in der Richtung von !target und feuert einen pinke Energiekugel auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält eine Hand in der Richtung von !target und feuert einen pinke Energiekugel auf !target. !target weicht jedoch aus.', '!source hält eine Hand in der Richtung von !target und feuert einen pinke Energiekugel auf !target. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler entlässt eine pinke Energiekugel von der Hand aus.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(145, 'Illusion Smash', 'illusionsmash', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source schlägt in der Luft, wodurch sich ein Portal öffnet durch das !source hindurchschlägt. Weitere Portale öffnen sich um !target und !target wird mehrfach geschlagen. !target erleidet !type !damage Schaden.', '!source schlägt in der Luft, wodurch sich ein Portal öffnet durch das !source hindurchschlägt. Weitere Portale öffnen sich um !target, jedoch kann !target den Schlägen immer ausweichen.', '!source schlägt in der Luft, wodurch sich ein Portal öffnet durch das !source hindurchschlägt. Weitere Portale öffnen sich um !target und !target wird mehrfach geschlagen. !target ist jedoch bereits tot.', '', 'Der Spieler schlägt durch mehrere Portale.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(146, 'Darkness Sword Attack', 'darknessswordattack', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source beschwört ein Schwert und schlägt damit mehrmals auf !target und schießt abschließend einen Energiestrahl auf !target. !target erleidet !type !damage Schaden.', '!source beschwört ein Schwert und schlägt damit mehrmals auf !target und schießt abschließend einen Energiestrahl auf !target. !target konnte jedoch jeden einzelnen Schlag ausweichen.', '!source beschwört ein Schwert und schlägt damit mehrmals auf !target und schießt abschließend einen Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler schlägt mit einen Schwert mehrfach auf das Ziel ein.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(147, 'Rapid Cannon', 'rapidcannon', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source wirft sehr viele Energiekugeln in die Luft und in die Gegend herum. !target kann nicht alle Energiekugeln ausweichen, wodurch !target getroffen wird und die Kugeln explodieren. !target erleidet !type !damage Schaden.', '!source wirft sehr viele Energiekugeln in die Luft und in die Gegend herum. !target kann jedoch alle Energiekugeln ausweichen.', '!source wirft sehr viele Energiekugeln in die Luft und in die Gegend herum. !target kann nicht alle Energiekugeln ausweichen, wodurch !target getroffen wird und die Kugeln explodieren. !target ist jedoch bereits tot.', '', 'Der Spieler schießt viele Energiekugeln in die Gegend.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(148, 'Dimension Sword Attack', 'dimensionswordattack', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source beschwört ein Schwert und schlägt damit mehrere Male in die Luft, wodurch Energiewellen entstehen die auf !target zurasen. !target wird getroffen und erleidet !type !damage Schaden.', '!source beschwört ein Schwert und schlägt damit mehrere Male in die Luft, wodurch Energiewellen entstehen die auf !target zurasen. !target weicht jedoch jeder Welle aus.', '!source beschwört ein Schwert und schlägt damit mehrere Male in die Luft, wodurch Energiewellen entstehen die auf !target zurasen. !target ist jedoch bereits tot.', '', 'Der Spieler schlägt mit einem Schwert in der Luft und erzeugt viele Energiewellen.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(149, 'Dimension Sword Rush', 'dimensionswordrush', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt sich schnell vor !target, beschwört ein Schwert und schlägt damit mehrere Male auf !target wodurch zusätzlich Energiewellen entstehen. !target wird getroffen und erleidet !type !damage Schaden.', '!source bewegt sich schnell vor !target, beschwört ein Schwert und schlägt damit mehrere Male auf !target wodurch zusätzlich Energiewellen entstehen. !target weicht jedoch jeden Schlag aus.', '!source bewegt sich schnell vor !target, beschwört ein Schwert und schlägt damit mehrere Male auf !target wodurch zusätzlich Energiewellen entstehen. !target ist jedoch bereits tot.', '', 'Der Spieler bewegt sich vor !target, beschwört ein Schwert und greift viele Male an.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(150, 'Lightning Shower Rain', 'lightningshowerrain', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source schlägt einmal horizontal in der Luft, wodurch Lichter vor !source entstehen. Aus den Lichtern kommen sehr viele Lichtstrahlen die auf !target zurasen. !target wird von sehr vielen Strahlen durchbohrt und erleidet !type !damage.', '!source schlägt einmal horizontal in der Luft, wodurch Lichter vor !source entstehen. Aus den Lichtern kommen sehr viele Lichtstrahlen die auf !target zurasen. !target weicht jedoch jeden Lichtstrahl aus.', '!source schlägt einmal horizontal in der Luft, wodurch Lichter vor !source entstehen. Aus den Lichtern kommen sehr viele Lichtstrahlen die auf !target zurasen. !target wird von sehr vielen Strahlen durchbohrt, !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt Lichtstrahlen die auf den Gegner zurasen.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(151, 'Spike Hell', 'spikehell', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source sperrt !target in einen roten Blutkristall ein. Daraufhin beschwört !source ein Schwert und schwingt damit viele Male auf den Blutkristall ein. Der Blutkristall explodiert daraufhin und !target erleidet !type !damage Schaden.', '!source sperrt !target in einen roten Blutkristall ein. Daraufhin beschwört !source ein Schwert und schwingt damit viele Male auf den Blutkristall ein. Der Blutkristall explodiert daraufhin, !target konnte jedoch vorher aus dem Blutkristall entkommen.', '!source sperrt !target in einen roten Blutkristall ein. Daraufhin beschwört !source ein Schwert und schwingt damit viele Male auf den Blutkristall ein. Der Blutkristall explodiert daraufhin, !target ist jedoch bereits tot.', '', 'Der Spieler schließt den Gegner in einem Kristall ein und schlägt mit dem Schwert darauf ein.', 0, 'Demon', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(152, 'PowerUp', 'powerupnamek', 4, 200, 0, 100, 100, 100, 100, 0, 0, 2000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und eine Aura umgibt !source.', 'Die Aura um !source verschwindet.', '', '', '', 1, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 24, 1, 0, 1),
(153, 'Great Namekian', 'greatnamekian', 4, 400, 0, 100, 100, 100, 100, 0, 0, 4000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und beginnt zu wachsen. !source ist nun viel größer.', '!source schrumpft wieder.', '', '', '', 1, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 4000, 0, 0, 24, 1, 0, 1),
(154, 'Super Giant', 'supergiant', 4, 500, 0, 100, 100, 100, 100, 0, 0, 5000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und wächst plötzlich zu einen Riesen heran. !source ist extremst groß.', '!source schrumpft wieder.', '', '', '', 1, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 24, 1, 0, 1),
(155, 'Super Namekian', 'supernamekian', 4, 600, 0, 100, 100, 100, 100, 0, 0, 6000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie, wodurch !source von einer weißen Aura umgeben wird und die Kraft enorm steigt.', 'Die Aura um !source verschwindet.', '', '', '', 1, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 24, 1, 0, 1),
(156, 'Red Eyed Form', 'redeyedform', 4, 800, 0, 100, 100, 100, 100, 0, 0, 8000, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und schreit. Daraufhin wird !source von einer brennenden Aura umgeben und die Augen färben sich brennend rot.', 'Die Aura um !source verschwindet und die Augen werden wieder normal.', '', '', '', 1, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 8000, 0, 0, 24, 1, 0, 1),
(157, 'Demon Hand', 'demonhand', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source verlängert den Arm und würgt !target. !target erleidet !type !damage Schaden.', '!source verlängert den Arm und würgt !target, !target entkommt jedoch.', '!source verlängert den Arm und würgt !target. !target ist jedoch bereits tot.', '', 'Der Spieler verlängert den Arm und würgt das Ziel.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(158, 'Dust Attack', 'dustattack', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source richtet den Arm auf !target, wodurch eine Explosion am Körper von !target entsteht. !target erleidet !type !damage Schaden.', '!source richtet den Arm auf !target, es passiert jedoch nichts.', '!source richtet den Arm auf !target, wodurch eine Explosion am Körper von !target entsteht. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler lässt eine Explosion beim Ziel entstehen.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(159, 'Scatter Shot', 'scattershot', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source schießt mehrere Energiekugeln auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source schießt mehrere Energiekugeln auf !target. !target weicht jedoch jeder Kugel aus.', '!source schießt mehrere Energiekugeln auf !target. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler schießt mehrere Kugeln auf den Gegner.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(160, 'Makosen', 'makosen', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Arme zusammen und sammelt Energie. !source schleudert daraufhin einen gelben Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält die Arme zusammen und sammelt Energie. !source schleudert daraufhin einen gelben Energiestrahl auf !target. !target weicht jedoch aus.', '!source hält die Arme zusammen und sammelt Energie. !source schleudert daraufhin einen gelben Energiestrahl auf !target. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler schießt einen gelben Energiestrahl auf das Ziel.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(161, 'Big Masher', 'bigmasher', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source richtet eine Hand nach vorne und entlässt einen großen gelben Energiestrahl auf !target. Der Energiestrahl explodiert und !target erleidet !type !damage Schaden.', '!source richtet eine Hand nach vorne und entlässt einen großen gelben Energiestrahl auf !target. Der Energiestrahl explodiert, !target konnte jedoch noch rechtzeitig ausweichen.', '!source richtet eine Hand nach vorne und entlässt einen großen gelben Energiestrahl auf !target. Der Energiestrahl explodiert, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen großen Energiestrahl auf das Ziel.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(162, 'Explosive Demon Wave', 'explosivedemonwave', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält beide Hände nach vorne und erzeugt eine Energekugel. Die Energiekugel wird von Blitzen umgeben. !source schleudert daraufhin eine Energiewelle auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält beide Hände nach vorne und erzeugt eine Energekugel. Die Energiekugel wird von Blitzen umgeben. !source schleudert daraufhin eine Energiewelle auf !target. !target weicht der Energiewelle noch rechtzeitig aus.', '!source hält beide Hände nach vorne und erzeugt eine Energekugel. Die Energiekugel wird von Blitzen umgeben. !source schleudert daraufhin eine Energiewelle auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt eine Energiekugel und schleudert damit eine Energiewelle auf den Gegner.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(163, 'Special Beam Cannon', 'specialbeamcannon', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält zwei Finger an die Stirn und sammelt an der Spitze Energie. Daraufhin bewegt er die Finger nach vorne und schleudert einen rotierenden Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hält zwei Finger an die Stirn und sammelt an der Spitze Energie. Daraufhin bewegt er die Finger nach vorne und schleudert einen rotierenden Energiestrahl auf !target. !target weicht dem Strahl noch rechtzeitig aus.', '!source hält zwei Finger an die Stirn und sammelt an der Spitze Energie. Daraufhin bewegt er die Finger nach vorne und schleudert einen rotierenden Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler sammelt mit zwei Finger Energie und feuert einen rotierenden Energiestrahl ab.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(164, 'Hyper Explosive Demon Wave', 'hyperexplosivedemonwave', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie und breitet daraufhin die Arme aus. Eine riesige Explosion geht von !source aus und rast auf !target zu. !target wird von der Explosion getroffen und erleidet !type !damage Schaden.', '!source konzentriert Energie und breitet daraufhin die Arme aus. Eine riesige Explosion geht von !source aus und rast auf !target zu. !target entkommt der Explosion noch rechtzeitig.', '!source konzentriert Energie und breitet daraufhin die Arme aus. Eine riesige Explosion geht von !source aus und rast auf !target zu. !target wird von der Explosion getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler entlässt eine riesige Explosion von sich aus.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(165, 'Full-Nelson Special Beam Cannon', 'fullnelsonspecialbeamcannon', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält zwei Finger an die Stirn und sammelt an der Spitze Energie. Es bilden sich Blitze und !source schreit auf. Daraufhin bewegt er die Finger nach vorne und schleudert einen schnell rotierenden Energiestrahl auf !target. !target wird durchbohrt und erleidet !type !damage Schaden.', '!source hält zwei Finger an die Stirn und sammelt an der Spitze Energie. Es bilden sich Blitze und !source schreit auf. Daraufhin bewegt er die Finger nach vorne und schleudert einen schnell rotierenden Energiestrahl auf !target. !target weicht dem Strahl noch rechtzeitig aus.', '!source hält zwei Finger an die Stirn und sammelt an der Spitze Energie. Es bilden sich Blitze und !source schreit auf. Daraufhin bewegt er die Finger nach vorne und schleudert einen schnell rotierenden Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Spieler sammelt mit zwei Finger sehr viel Energie und feuert einen rotierenden Energiestrahl ab.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(166, 'Light Grenade', 'lightgrenade', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt zwischen den Händen Energie, wodurch eine sehr helle Kugel entsteht. !source schreit auf und wirft die Kugel auf !target. Es entsteht eine gewaltige Explosion und !target erleidet !type !damage Schaden.', '!source sammelt zwischen den Händen Energie, wodurch eine sehr helle Kugel entsteht. !source schreit auf und wirft die Kugel auf !target. Es entsteht eine gewaltige Explosion die !target jedoch noch rechtzeitig entkommen kann.', '!source sammelt zwischen den Händen Energie, wodurch eine sehr helle Kugel entsteht. !source schreit auf und wirft die Kugel auf !target. Es entsteht eine gewaltige Explosion, !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt eine helle Kugel und wirft sie auf den Gegner.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1);
INSERT INTO `attacks` (`id`, `name`, `image`, `type`, `value`, `epvalue`, `lpvalue`, `kpvalue`, `atkvalue`, `defvalue`, `tauntvalue`, `reflectvalue`, `kp`, `lp`, `energy`, `procentual`, `procentualcost`, `learnlp`, `learnki`, `learnkp`, `learnattack`, `learndefense`, `accuracy`, `text`, `missText`, `deadText`, `loadtext`, `description`, `transformationid`, `race`, `displayed`, `loadattack`, `npcid`, `loadrounds`, `blockattack`, `blockedattack`, `item`, `minvalue`, `rounds`, `level`, `learntime`, `npcpickable`, `costgenerated`, `displaydied`) VALUES
(167, 'Hellzone Grenade', 'hellzonegrenade', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie und wirft sehr viele Energiekugel in der Luft und breitet die Arme aus. Daraufhin tut !source die Arme zusammen und richtet sie auf !target. Die Energiekugeln bewegen sich auf !target zu und explodieren wodurch die Explosion immer größer wird. !target erleidet !type !damage schaden.', '!source sammelt Energie und wirft sehr viele Energiekugel in der Luft und breitet die Arme aus. Daraufhin tut !source die Arme zusammen und richtet sie auf !target. Die Energiekugeln bewegen sich auf !target zu und explodieren wodurch die Explosion immer größer wird, !target kann der Explosion jedoch noch entkommen.', '!source sammelt Energie und wirft sehr viele Energiekugel in der Luft und breitet die Arme aus. Daraufhin tut !source die Arme zusammen und richtet sie auf !target. Die Energiekugeln bewegen sich auf !target zu und explodieren wodurch die Explosion immer größer wird. !target ist jedoch bereits tot.', '', 'Der Spieler schießt viele Energiekugeln in die Luft und lässt sie auf den Gegner zufliegen.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(168, 'Death Beam', 'deathbeam', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source zielt auf !target und feuert einen dünnen roten Energiestrahl ab. Der Energiestrahl trifft !target und !target erleidet !type !damage Schaden.', '!source zielt auf !target und feuert einen dünnen roten Energiestrahl ab. !target weicht den Strahl leicht aus.', '!source zielt auf !target und feuert einen dünnen roten Energiestrahl ab. Der Energiestrahl trifft !target, !target ist jedoch bereits tot.', '', 'Der Spieler schießt einen dünnen Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(169, 'Death Bullet', 'deathbullet', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source zielt mit einen Finger auf !target und schießt kleine rote Energiekugeln auf !target, !target wird getroffen und erleidet !type !damage Schaden.', '!source zielt mit einen Finger auf !target und schießt kleine rote Energiekugeln auf !target, !target weicht jedoch aus.', '!source zielt mit einen Finger auf !target und schießt kleine rote Energiekugeln auf !target, !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler schießt rote Energiekugeln auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(170, 'Death Laser', 'deathlaser', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source zielt mit einen Finger auf !target und schießt einen roten elektrischen Strahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source zielt mit einen Finger auf !target und schießt einen roten elektrischen Strahl auf !target. !target weicht den Strahl jedoch aus.', '!source zielt mit einen Finger auf !target und schießt einen roten elektrischen Strahl auf !target. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Spieler schießt einen elektrischen Strahl auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(171, 'Eye Laser', 'eyelaser', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source fokusiert !target mit den Augen und schießt zwei Laser aus den Augen auf !target. !target wird von den Lasern getroffen und erleidet !type !damage Schaden.', '!source fokusiert !target mit den Augen und schießt zwei Laser aus den Augen auf !target. !target weicht den Lasern jedoch aus.', '!source fokusiert !target mit den Augen und schießt zwei Laser aus den Augen auf !target. !target wird von den Lasern getroffen, ist jedoch bereits tot.', '', 'Der Spieler schießt Laser aus den Augen.', 0, '', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(172, 'Finger Beam', 'fingerbeam', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source richtet beide Finger auf !target und schießt zwei Energiestrahle von den Fingerspitzen auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source richtet beide Finger auf !target und schießt zwei Energiestrahle von den Fingerspitzen auf !target. !target konnte jedoch noch rechtzeitig ausweichen.', '!source richtet beide Finger auf !target und schießt zwei Energiestrahle von den Fingerspitzen auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt zwei Energiestrahlen auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(173, 'Full Power Death Bullet', 'fullpowerdeathbullet', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source visiert !target an und schießt ununterbrochen viele kleine Energiekugeln auf !target. !target wird von einer getroffen, wodurch !target langsamer wird und von den restlichen Kugeln getroffen wird. !target erleidet !type !damage Schaden.', '!source visiert !target an und schießt ununterbrochen viele kleine Energiekugeln auf !target. !target kann jedoch jeder einzelnen Kugel leicht ausweichen.', '!source visiert !target an und schießt ununterbrochen viele kleine Energiekugeln auf !target. !target wird von einer getroffen, wodurch !target langsamer wird und von den restlichen Kugeln getroffen wird. !target ist jedoch bereits tot.', '', 'Der Spieler schießt ununterbrochen kleine Energiekugeln ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(174, 'Barrage Death Beam', 'barragedeathbeam', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit einem Finger auf !target und schießt daraufhin sehr viele dünne rote Energiestrahlen ab. Die Energiestrahlen rasen auf !target zu und !target erleidet !type !damage Schaden.', '!source zeigt mit einem Finger auf !target und schießt daraufhin sehr viele dünne rote Energiestrahlen ab. Die Energiestrahlen rasen auf !target zu, !target weicht jedoch allen aus.', '!source zeigt mit einem Finger auf !target und schießt daraufhin sehr viele dünne rote Energiestrahlen ab. Die Energiestrahlen rasen auf !target zu, !target ist jedoch bereits tot.', '', 'Der Spieler schießt viele dünne rote Energiestrahlen ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(175, 'Golden Death Beam', 'goldendeathbeam', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source zielt mit einen Finger auf !target und konzentriert viel Energie in der Fingerspitze. Daraufhin schießt !source einen rasend schnellen Energiestrahl auf !target ab. !target wird getroffen und erleidet !type !damage Schaden.', '!source zielt mit einen Finger auf !target und konzentriert viel Energie in der Fingerspitze. Daraufhin schießt !source einen rasend schnellen Energiestrahl auf !target ab. !target weicht den Strahl jedoch aus.', '!source zielt mit einen Finger auf !target und konzentriert viel Energie in der Fingerspitze. Daraufhin schießt !source einen rasend schnellen Energiestrahl auf !target ab. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert Energie in der Fingerspitze und schießt einen Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(176, 'Emperor Death Beam', 'emperordeathbeam', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source zielt mit einen Finger auf !target und konzentriert Energie in der Fingerspitze. Daraufhin schießt !source sehr viele Energiestrahlen auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source zielt mit einen Finger auf !target und konzentriert Energie in der Fingerspitze. Daraufhin schießt !source sehr viele Energiestrahlen auf !target. !target weicht den Strahlen noch rechtzeitig aus.', '!source zielt mit einen Finger auf !target und konzentriert Energie in der Fingerspitze. Daraufhin schießt !source sehr viele Energiestrahlen auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt aus der Fingerspitze viele starke rote Energiestrahlen ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(177, 'Grand Death Beam', 'granddeathbeam', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus und konzentriert Energie in der Fingerspitze. Daraufhin schießt !source viele Energiestrahlen aus den Fingerspitzen ab, die !target verfolgen. Die Strahlen durchbohren !target und !target erleidet !type !damage Schaden.', '!source breitet die Arme aus und konzentriert Energie in der Fingerspitze. Daraufhin schießt !source viele Energiestrahlen aus den Fingerspitzen ab, die !target verfolgen. !target weicht den Strahlen jedoch aus.', '!source breitet die Arme aus und konzentriert Energie in der Fingerspitze. Daraufhin schießt !source viele Energiestrahlen aus den Fingerspitzen ab, die !target verfolgen. Die Strahlen durchbohren !target, !target ist jedoch bereits tot.', '', 'Der Spieler schießt viele Energiestrahlen aus den Fingerspitzen ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(178, 'Cage of Light', 'cageoflight', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme und Finger aus und schießt aus jedem Finger einen roten Energiestrahl. Daraufhin entsteht um !target ein Käfig. !source lässt den Käfig immer kleiner werden bis !target von den Energiestrahlen getroffen wird. !target erleidet !type !damage Schaden.', '!source breitet die Arme und Finger aus und schießt aus jedem Finger einen roten Energiestrahl. Daraufhin entsteht um !target ein Käfig. !source lässt den Käfig immer kleiner werden bis !target von den Energiestrahlen getroffen wird. !target kann sich jedoch noch aus den Käfig befreien.', '!source breitet die Arme und Finger aus und schießt aus jedem Finger einen roten Energiestrahl. Daraufhin entsteht um !target ein Käfig. !source lässt den Käfig immer kleiner werden bis !target von den Energiestrahlen getroffen wird. !target ist jedoch bereits tot.', '', 'Der Spieler erzeugt aus Fingerstrahlen einen Käfig wodurch das Ziel eingesperrt wird.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(179, 'Kamehameha', 'kamehameha', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und bündelt Energie zwischen seinen Händen. Eine kleine Energiekugel entsteht, welche als Energiestrahl auf !target abgefeuert wird. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert sich und bündelt Energie zwischen seinen Händen. Eine kleine Energiekugel entsteht, welche als Energiestrahl auf !target abgefeuert wird. !target konnte jedoch ausweichen. ', '!source konzentriert sich und bündelt Energie zwischen seinen Händen. Eine kleine Energiekugel entsteht, welche als Energiestrahl auf !target abgefeuert wird. !target wird getroffen, ist jedoch bereits schon tot.', '', 'Der Anwender feuert einen kleinen gebündelten Energiestrahl auf das Ziel ab. ', 0, '', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(180, 'Original Kamehameha', 'originalkamehameha', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und bündelt eine Menge Energie zwischen beiden Händen. Eine Energiekugel entsteht, welche als Energiestrahl auf !target abgefeuert wird. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert sich und bündelt eine Menge Energie zwischen beiden Händen. Eine Energiekugel entsteht, welche als Energiestrahl auf !target abgefeuert wird. !target konnte jedoch ausweichen. ', '!source konzentriert sich und bündelt eine Menge Energie zwischen beiden Händen. Eine Energiekugel entsteht, welche als Energiestrahl auf !target abgefeuert wird. !target wird getroffen, ist jedoch bereits schon tot.', '', 'Der Anwender feuert einen gebündelten Energiestrahl auf das Ziel ab. ', 0, '', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(181, 'True Kamehameha', 'truekamehameha', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und zusammen und konzentriert viel Energie. Eine leuchtende Energiekugel bildet sich zwischen den Händen und !source tut die Hände nach vorne wodrauf ein Energiestrahl auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und zusammen und konzentriert viel Energie. Eine leuchtende Energiekugel bildet sich zwischen den Händen und !source tut die Hände nach vorne wodrauf ein Energiestrahl auf !target zu fliegt. !target weicht den Strahl leicht aus.', '!source tut beide Hände zur Seite und zusammen und konzentriert viel Energie. Eine leuchtende Energiekugel bildet sich zwischen den Händen und !source tut die Hände nach vorne wodrauf ein Energiestrahl auf !target zu fliegt. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen hellen  Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(182, 'Super Kamehameha', 'superkamehameha', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und bündelt eine enorme Menge an Energie zwischen beiden Händen. Eine große Energiekugel entsteht, welche als kraftvoller Energiestrahl auf !target abgefeuert wird. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert sich und bündelt eine enorme Menge an Energie zwischen beiden Händen. Eine große Energiekugel entsteht, welche als kraftvoller Energiestrahl auf !target abgefeuert wird. !target weicht den Strahl leicht aus.', '!source konzentriert sich und bündelt eine enorme Menge an Energie zwischen beiden Händen. Eine große Energiekugel entsteht, welche als kraftvoller Energiestrahl auf !target abgefeuert wird. !target ist jedoch bereits tot.', '', 'Der Anwender feuert einen großen gebündelten Energiestrahl auf das Ziel ab. ', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(183, 'Ultimate Kamehameha', 'ultimatekamehameha', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut eine Hand zur Seite und zusammen und konzentriert sehr viel Energie. Eine Energiekugel bildet sich zwischen bei der Hand und !source tut die Hand nach vorne wodrauf ein gewaltiger Energiestrahl auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut eine Hand zur Seite und zusammen und konzentriert sehr viel Energie. Eine Energiekugel bildet sich zwischen bei der Hand und !source tut die Hand nach vorne wodrauf ein gewaltiger Energiestrahl auf !target zu fliegt. !target weicht den Strahl leicht aus.', '!source tut eine Hand zur Seite und zusammen und konzentriert sehr viel Energie. Eine Energiekugel bildet sich zwischen bei der Hand und !source tut die Hand nach vorne wodrauf ein gewaltiger Energiestrahl auf !target zu fliegt. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen Energiestrahl, der mit einer Hand geladen worden ist, auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(184, 'God Kamehameha', 'godkamehameha', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger Energiestrahl fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger Energiestrahl fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger Energiestrahl fliegt auf !target zu. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(185, '10x God Kamehameha', '10godkamehameha', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine große blaue Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl der von Blitzen umgeben ist fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine große blaue Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl der von Blitzen umgeben ist fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine große blaue Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl der von Blitzen umgeben ist fliegt auf !target zu, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden von Blitzen umgebender Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(186, 'Transcendent God Kamehameha', 'transcendentgodkamehameha', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger blauer und gelber Energiestrahl fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger blauer und gelber Energiestrahl fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel. !source wirft beide Hände nach vorne und ein gewaltiger blauer und gelber Energiestrahl fliegt auf !target zu. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden gelben und blauen Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(187, 'Full-Force Kamehameha', 'fullforcekamehameha', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein blauer Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein blauer Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein blauer Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden blauen Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(188, 'Supreme Kamehameha', 'supremekamehameha', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden blauen Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(189, 'Ultimate Instinct Kamehameha', 'ultimateinstinctkamehameha', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender weißer Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Weiß erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger weißer Energiestrahl fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender weißer Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Weiß erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger weißer Energiestrahl fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender weißer Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Weiß erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger weißer Energiestrahl fliegt auf !target zu. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden weißen Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(190, 'Big Bang Attack', 'bigbangattack', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Handfläche nach vorne und konzentriert einen Energieball. Der Energieball wird größer und leuchtet. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert und !target erleidet !type !damage Schaden.', '!source hält eine Handfläche nach vorne und konzentriert einen Energieball. Der Energieball wird größer und leuchtet. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert, !target konnte jedoch noch ausweichen.', '!source hält eine Handfläche nach vorne und konzentriert einen Energieball. Der Energieball wird größer und leuchtet. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen Energieball auf den Gegner, wodrauf der Ball explodiert.', 0, '', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(191, 'Big Bang Kamehameha', 'bigbangkamehameha', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände vor sich und konzentriert Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel und ein Energiering. !source feuert von der Kugel aus einen großen Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände vor sich und konzentriert Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel und ein Energiering. !source feuert von der Kugel aus einen großen Energiestrahl auf !target. !target weicht den Strahl jedoch aus.', '!source tut beide Hände vor sich und konzentriert Energie. Die Energie leuchtet und brennt und bildet eine Energiekugel und ein Energiering. !source feuert von der Kugel aus einen großen Energiestrahl auf !target. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert vor sich einen Energieball und feuert einen großen Energiestrahl auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(192, 'Imperfect Instinct Kamehameha', 'imperfectinstinctkamehameha', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender leicht weiß leuchtender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau-weiß erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender leicht weiß leuchtender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau-weiß erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Ein brennender leicht weiß leuchtender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die Blau-weiß erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blauer Energiestrahl fliegt auf !target zu. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden blauen Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(193, '100x Big Bang Kamehameha', '100bigbangkamehameha', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände vor sich und konzentriert Energie. Die Energie leuchtet und brennt und bildet eine große Energiekugel und einen großen Energiering. !source feuert von der Kugel aus einen gewaltigen Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände vor sich und konzentriert Energie. Die Energie leuchtet und brennt und bildet eine große Energiekugel und einen großen Energiering. !source feuert von der Kugel aus einen gewaltigen Energiestrahl auf !target. !target weicht den Strahl jedoch aus.', '!source tut beide Hände vor sich und konzentriert Energie. Die Energie leuchtet und brennt und bildet eine große Energiekugel und einen großen Energiering. !source feuert von der Kugel aus einen gewaltigen Energiestrahl auf !target. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert vor sich einen großen Energieball und feuert einen gewaltigen Energiestrahl auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(194, 'Final Kamehameha', 'finalkamehameha', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet die Arme aus, Blitze entstehen und !source lädt Energie. Daraufhin tut !source die Hände zusammen und dreht sie, wodurch eine Energiekugel entsteht. !source schießt von der Energiekugel einen gewaltigen blauen Energiestrahl der von gelber Energie umrundet wird auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source breitet die Arme aus, Blitze entstehen und !source lädt Energie. Daraufhin tut !source die Hände zusammen und dreht sie, wodurch eine Energiekugel entsteht. !source schießt von der Energiekugel einen gewaltigen blauen Energiestrahl der von gelber Energie umrundet wird auf !target. !target weicht den Strahl jedoch aus.', '!source breitet die Arme aus, Blitze entstehen und !source lädt Energie. Daraufhin tut !source die Hände zusammen und dreht sie, wodurch eine Energiekugel entsteht. !source schießt von der Energiekugel einen gewaltigen blauen Energiestrahl der von gelber Energie umrundet wird auf !target. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler breitet die Arme aus, sammelt Energie und schießt einen blau-gelben Energiestrahl auf den Feind.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(195, 'Garlick Kamehameha', 'garlickkamehameha', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet abwechselnd gelb und blau. Ein brennender blau-gelb farbender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blau-gelber Energiestrahl fliegt auf !target zu. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet abwechselnd gelb und blau. Ein brennender blau-gelb farbender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blau-gelber Energiestrahl fliegt auf !target zu. !target weicht den Strahl jedoch aus.', '!source tut beide Hände zur Seite und konzentriert viel Energie. Die Energie leuchtet abwechselnd gelb und blau. Ein brennender blau-gelb farbender Energiekreis umsteht um !source. Die Energie leuchtet, brennt und bildet eine Energiekugel die blau erstrahlt zwischen den Händen. !source wirft beide Hände nach vorne und ein gewaltiger blau-gelber Energiestrahl fliegt auf !target zu. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen brennenden blau-gelben Energiestrahl der zwischen den Händen konzentriert wurde auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(196, 'Death Ball', 'deathball', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält ein Finger nach oben wodrauf über den Finger ein pinker Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target erleidet !type !damage Schaden.', '!source hält ein Finger nach oben wodrauf über den Finger ein pinker Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target kann dem Ball jedoch noch rechtzeitig entkommen.', '!source hält ein Finger nach oben wodrauf über den Finger ein pinker Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert Energie in die Fingerkuppel und ein gewaltiger Energieball entsteht.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(197, 'Black Hole Death Ball', 'blackholedeathball', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält ein Finger nach oben wodrauf über den Finger ein schwarzer, mit pinken Blitzen umzogener ,Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target erleidet !type !damage Schaden.', '!source hält ein Finger nach oben wodrauf über den Finger ein schwarzer, mit pinken Blitzen umzogener ,Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target kann dem Ball jedoch noch rechtzeitig entkommen.', '!source hält ein Finger nach oben wodrauf über den Finger ein schwarzer, mit pinken Blitzen umzogener ,Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert Energie in die Fingerkuppel und ein gewaltiger schwarzer Energieball entsteht.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(198, 'Supernova', 'supernova', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält ein Finger nach oben wodrauf über den Finger rot-gelb brennender Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target erleidet !type !damage Schaden.', '!source hält ein Finger nach oben wodrauf über den Finger rot-gelb brennender Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target kann dem Ball jedoch noch rechtzeitig entkommen.', '!source hält ein Finger nach oben wodrauf über den Finger rot-gelb brennender Energieball entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert Energie in die Fingerkuppel und ein gewaltiger rot-gelber Energieball entsteht.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(199, 'Golden Death Ball', 'goldendeathball', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält ein Finger nach oben wodrauf über den Finger gewaltiger pinker Energieball ,der von pink brennenden Ringen umzogen ist, entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target erleidet !type !damage Schaden.', '!source hält ein Finger nach oben wodrauf über den Finger gewaltiger pinker Energieball ,der von pink brennenden Ringen umzogen ist, entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target kann dem Ball jedoch noch rechtzeitig entkommen.', '!source hält ein Finger nach oben wodrauf über den Finger gewaltiger pinker Energieball ,der von pink brennenden Ringen umzogen ist, entsteht. Der Ball wird immer größer, bis er die Größe eines kleinen Mondes eingenommen hat. !source lacht und wirft den Ball auf !target. Der Ball explodiert in einer gewaltigen Explosion. !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert Energie in die Fingerkuppel und ein gewaltiger pinker Energieball entsteht.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(200, 'Galick Gun', 'galickgun', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände neben seinen Kopf und sammelt Energie zwischen den Händen. Daraufhin wirft !source die Hände nach vorne und entlässt einen lilanen Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände neben seinen Kopf und sammelt Energie zwischen den Händen. Daraufhin wirft !source die Hände nach vorne und entlässt einen lilanen Energiestrahl auf !target. !target weicht den Strahl leicht aus.', '!source tut beide Hände neben seinen Kopf und sammelt Energie zwischen den Händen. Daraufhin wirft !source die Hände nach vorne und entlässt einen lilanen Energiestrahl auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen lilanen Energiestrahl auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(201, 'Double Galick Gun', 'doublegalickgun', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie in beiden Händen, wodrauf sie beginnen lila zu leuchten. Daraufhin wirft !source beide Hände nach vorne und erzeugt einen großen lilanen Energiestrahl der auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert Energie in beiden Händen, wodrauf sie beginnen lila zu leuchten. Daraufhin wirft !source beide Hände nach vorne und erzeugt einen großen lilanen Energiestrahl der auf !target zu fliegt. !target weicht den Strahl leicht aus.', '!source konzentriert Energie in beiden Händen, wodrauf sie beginnen lila zu leuchten. Daraufhin wirft !source beide Hände nach vorne und erzeugt einen großen lilanen Energiestrahl der auf !target zu fliegt. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert in beiden Händen Energie und wirft einen Energiestrahl auf den Feind.', 0, '', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(202, 'Maximum Flasher', 'maximumflasher', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie in einer Hand wodrauf die Hand beginnt gelb zu leuchten. !source wirft die Hand daraufhin nach vorne und ein gelber großer Energiestrahl entsteht der auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert Energie in einer Hand wodrauf die Hand beginnt gelb zu leuchten. !source wirft die Hand daraufhin nach vorne und ein gelber großer Energiestrahl entsteht der auf !target zu fliegt. !target weicht den Strahl leicht aus.', '!source konzentriert Energie in einer Hand wodrauf die Hand beginnt gelb zu leuchten. !source wirft die Hand daraufhin nach vorne und ein gelber großer Energiestrahl entsteht der auf !target zu fliegt. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler konzentriert Energie in einer Hand und wirft einen Energiestrahl auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(203, 'Heat Dome Attack', 'heatdomeattack', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source schleudert !target in die Luft und konzentriert Energie. Daraufhin hebt !source die Arme nach oben und schleudert einen großen gelben Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source schleudert !target in die Luft und konzentriert Energie. Daraufhin hebt !source die Arme nach oben und schleudert einen großen gelben Energiestrahl auf !target. !target weicht den Strahl leicht aus.', '!source schleudert !target in die Luft und konzentriert Energie. Daraufhin hebt !source die Arme nach oben und schleudert einen großen gelben Energiestrahl auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler wirft den Gegner in die Luft und schleudert einen Energiestrahl nach oben.', 0, '', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(204, 'Final Flash', 'finalflash', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet beide Arme aus. Blitze entstehen um die Arme von !source. Daraufhin sammelt !source Energie in beiden Händen. Nun tut !source beide Hände zusammen und entlässt einen gewaltigen gelben Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source breitet beide Arme aus. Blitze entstehen um die Arme von !source. Daraufhin sammelt !source Energie in beiden Händen. Nun tut !source beide Hände zusammen und entlässt einen gewaltigen gelben Energiestrahl auf !target. !target weicht den Strahl jedoch aus.', '!source breitet beide Arme aus. Blitze entstehen um die Arme von !source. Daraufhin sammelt !source Energie in beiden Händen. Nun tut !source beide Hände zusammen und entlässt einen gewaltigen gelben Energiestrahl auf !target. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler breitet die Arme aus und sammelt Energie, die er dann in Form eines Energiestrahles auf den Gegner wirft.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(205, 'Super Big Bang Attack', 'superbigbang', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Handfläche nach vorne und Blitze entstehen um die Hand. !source erzeugt einen von Blitzen umgebenen Energieball vor sich. Der Energieball wird größer und leuchtet. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert und !target erleidet !type !damage Schaden.', '!source hält eine Handfläche nach vorne und Blitze entstehen um die Hand. !source erzeugt einen von Blitzen umgebenen Energieball vor sich. Der Energieball wird größer und leuchtet. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert, !target konnte jedoch noch ausweichen.', '!source hält eine Handfläche nach vorne und Blitze entstehen um die Hand. !source erzeugt einen von Blitzen umgebenen Energieball vor sich. Der Energieball wird größer und leuchtet. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen großen Energieball auf den Gegner, wodrauf der Ball explodiert.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(206, 'Super Galick Gun', 'supergalickgun', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände neben seinen Kopf und sammelt Energie zwischen den Händen. Blitze entstehen um !source und besonders um den Händen von !source. Daraufhin wirft !source die Hände nach vorne und entlässt einen gewaltigen lilanen Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände neben seinen Kopf und sammelt Energie zwischen den Händen. Blitze entstehen um !source und besonders um den Händen von !source. Daraufhin wirft !source die Hände nach vorne und entlässt einen gewaltigen lilanen Energiestrahl auf !target. !target weicht den Strahl leicht aus.', '!source tut beide Hände neben seinen Kopf und sammelt Energie zwischen den Händen. Blitze entstehen um !source und besonders um den Händen von !source. Daraufhin wirft !source die Hände nach vorne und entlässt einen gewaltigen lilanen Energiestrahl auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen gewaltigen lilanen Energiestrahl auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(207, 'God Big Bang', 'godbigbang', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Handfläche nach vorne und brennende Blitze entstehen um die Hand. !source erzeugt einen brennenden, von Blitzen umgebenden, Energieball vor sich. Der Energieball wird größer und leuchtet stark. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert in einer gewaltigen Explosion und !target erleidet !type !damage Schaden.', '!source hält eine Handfläche nach vorne und brennende Blitze entstehen um die Hand. !source erzeugt einen brennenden, von Blitzen umgebenden, Energieball vor sich. Der Energieball wird größer und leuchtet stark. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert in einer gewaltigen Explosion, !target konnte jedoch noch ausweichen.', '!source hält eine Handfläche nach vorne und brennende Blitze entstehen um die Hand. !source erzeugt einen brennenden, von Blitzen umgebenden, Energieball vor sich. Der Energieball wird größer und leuchtet stark. !source wirft daraufhin mit einen Schlag den Energieball auf !target. Der Energieball explodiert in einer gewaltigen Explosion, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert einen gewaltigen brennenden Energieball auf den Gegner, wodrauf der Ball explodiert.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(208, 'God Final Flash', 'godfinalflash', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source breitet beide Arme aus. Brennende Blitze entstehen um die Arme von !source und eine brennende Aura umgibt !source. Daraufhin sammelt !source Energie in beiden Händen. Nun tut !source beide Hände zusammen und entlässt einen gewaltigen brennenden gelben Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source breitet beide Arme aus. Brennende Blitze entstehen um die Arme von !source und eine brennende Aura umgibt !source. Daraufhin sammelt !source Energie in beiden Händen. Nun tut !source beide Hände zusammen und entlässt einen gewaltigen brennenden gelben Energiestrahl auf !target. !target weicht den Strahl jedoch aus.', '!source breitet beide Arme aus. Brennende Blitze entstehen um die Arme von !source und eine brennende Aura umgibt !source. Daraufhin sammelt !source Energie in beiden Händen. Nun tut !source beide Hände zusammen und entlässt einen gewaltigen brennenden gelben Energiestrahl auf !target. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler breitet die Arme aus und sammelt Energie, die er dann in Form eines brennenden gewaltigen Energiestrahl auf den Gegner wirft.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(209, 'Gamma Burst Flash', 'gammaburstflash', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie in beiden Händen. Brennende Blitze entstehen um beide Hände und !source wird von einer brennenden Aura umgeben. Die Hände leuchten stark. Daraufhin wirft !source die Hände nach vorne und die Energien vereinen sich zu. !source entlässt nun einen gewaltigen brennenden Energiestrahl auf !target. Der Energiestrahl explodiert in einer gewaltigen Explosion. !target erleidet !type !damage Schaden.', '!source sammelt Energie in beiden Händen. Brennende Blitze entstehen um beide Hände und !source wird von einer brennenden Aura umgeben. Die Hände leuchten stark. Daraufhin wirft !source die Hände nach vorne und die Energien vereinen sich zu. !source entlässt nun einen gewaltigen brennenden Energiestrahl auf !target. Der Energiestrahl explodiert in einer gewaltigen Explosion. !target weicht den Strahl jedoch aus.', '!source sammelt Energie in beiden Händen. Brennende Blitze entstehen um beide Hände und !source wird von einer brennenden Aura umgeben. Die Hände leuchten stark. Daraufhin wirft !source die Hände nach vorne und die Energien vereinen sich zu. !source entlässt nun einen gewaltigen brennenden Energiestrahl auf !target. Der Energiestrahl explodiert in einer gewaltigen Explosion. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler sammelt brennende Energie in beiden Händen und wirft einen gewaltigen brennenden Energiestrahl auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(210, 'Burning Storm', 'burningstorm', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie in einer Hand und richtet sie auf !target. Eine blaue Energiekugel bildet sich um die hand. !source schleudert daraufhin mehrere Energiebälle auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert Energie in einer Hand und richtet sie auf !target. Eine blaue Energiekugel bildet sich um die hand. !source schleudert daraufhin mehrere Energiebälle auf !target. !target weicht jeder Kugel aus.', '!source konzentriert Energie in einer Hand und richtet sie auf !target. Eine blaue Energiekugel bildet sich um die hand. !source schleudert daraufhin mehrere Energiebälle auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schleudert aus einer Energiekugel mehrere Energiebälle auf das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(211, 'Finish Buster', 'finishbuster', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source formt eine riesige Energiekugel mit beiden Händen und entlässt diese mit einer schwungvollen Bewegung auf !target los. !target wird getroffen und erleidet !type !damage Schaden.', '!source formt eine riesige Energiekugel mit beiden Händen und entlässt diese mit einer schwungvollen Bewegung auf !target los. !target konnte der Attacke jedoch rechtzeitig ausweichen. ', '!source formt eine riesige Energiekugel mit beiden Händen und entlässt diese mit einer schwungvollen Bewegung auf !target los. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Anwender formt eine riesige Energiekugel mit beiden Händen und entlässt diese mit einer schwungvollen Bewegung auf sein Ziel los.', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1);
INSERT INTO `attacks` (`id`, `name`, `image`, `type`, `value`, `epvalue`, `lpvalue`, `kpvalue`, `atkvalue`, `defvalue`, `tauntvalue`, `reflectvalue`, `kp`, `lp`, `energy`, `procentual`, `procentualcost`, `learnlp`, `learnki`, `learnkp`, `learnattack`, `learndefense`, `accuracy`, `text`, `missText`, `deadText`, `loadtext`, `description`, `transformationid`, `race`, `displayed`, `loadattack`, `npcid`, `loadrounds`, `blockattack`, `blockedattack`, `item`, `minvalue`, `rounds`, `level`, `learntime`, `npcpickable`, `costgenerated`, `displaydied`) VALUES
(212, 'Burning Attack', 'burningattack', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt seine Hände schnell wild umher und sammelt dabei Energie. Daraufhin platziert !source die Hände nahe beieinander und bilder mit den Fingern eine Diamantenform. Daraufhin bildet sich eine gelb leuchtende Energiekugel vor !source. !source wirft mit einen Schlag die Energiekugel auf !target. Die Energiekugel explodiert und !target erleidet !type !damage Schaden.', '!source bewegt seine Hände schnell wild umher und sammelt dabei Energie. Daraufhin platziert !source die Hände nahe beieinander und bilder mit den Fingern eine Diamantenform. Daraufhin bildet sich eine gelb leuchtende Energiekugel vor !source. !source wirft mit einen Schlag die Energiekugel auf !target. Die Energiekugel explodiert , !target konnte jedoch noch ausweichen.', '!source bewegt seine Hände schnell wild umher und sammelt dabei Energie. Daraufhin platziert !source die Hände nahe beieinander und bilder mit den Fingern eine Diamantenform. Daraufhin bildet sich eine gelb leuchtende Energiekugel vor !source. !source wirft mit einen Schlag die Energiekugel auf !target. Die Energiekugel explodiert, !target ist jedoch bereits tot.', '', 'Der Spieler bewegt die Hände schnell hin und her und schleudert dann eine Energiekugelauf den Gegner, wodrauf die Kugel explodiert.', 0, '', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(213, 'Charging Volley Ball', 'chargingvolleyball', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source wirft mehrere Energieringe auf !target wodurch !target in einer Kugel eingesperrt wird. Daraufhin spielt !source mit der Kugel Volleyball und schmeißt sie in der Gegend rum. Am Ende wirft !source den Ball hart gegen den Boden und !target wird befreit. !target erleidet !type !damage Schaden.', '!source wirft mehrere Energieringe auf !target wodrauf !target in einer Kugel eingesperrt wird. Daraufhin will !source die Kugel schlagen, !target befreit sich jedoch noch rechtzeitig.', '!source wirft mehrere Energieringe auf !target wodurch !target in einer Kugel eingesperrt wird. Daraufhin spielt !source mit der Kugel Volleyball und schmeißt sie in der Gegend rum. Am Ende wirft !source den Ball hart gegen den Boden und !target wird befreit. !target ist jedoch bereits tot.', '', 'Der Spieler sperrt den Gegner in einer Energiekugel ein und spielt Volleyball.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(214, 'Super Ghost Kamikaze Attack', 'superghostkamikazeattack', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source atmet tief ein und entlässt beim Ausatmen einen Geist, der den gleichen Kopf hat wie !source. !source und der Geist stellen sich nebeneinander und machen die selbe Bewegung. Daraufhin rast der Geist auf !target zu und !target greift den Geist an. Der Geist grinst und explodiert. !target erleidet !type !damage Schaden.', '!source atmet tief ein und entlässt beim Ausatmen einen Geist, der den gleichen Kopf hat wie !source. !source und der Geist stellen sich nebeneinander und machen die selbe Bewegung. Daraufhin rast der Geist auf !target zu, fliegt jedoch gegen einen Stein und explodiert.', '!source atmet tief ein und entlässt beim Ausatmen einen Geist, der den gleichen Kopf hat wie !source. !source und der Geist stellen sich nebeneinander und machen die selbe Bewegung. Daraufhin rast der Geist auf !target zu, !target ist jedoch bereits tot und der Geist explodiert auf !target.', '', 'Der Spieler entlässt einen Geist der bei Kontakt explodiert.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(215, 'Balloon Flash Bomber', 'balloonflashbomber', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source atmet tief ein und entlässt einen golden Ballon hinter !target. Der Ballon beginnt extremst hell zu leuchten und um !target stehen plötzlich mehrere Geister, die den gleichen Kopf haben wie !source. Die Gester und !source machen die selbe Bewegung und daraufhin fliegen alle Geister auf !target zu. Die Geister explodieren und !target erleidet !type !damage Schaden.', '!source atmet tief ein und entlässt einen golden Ballon hinter !target. Der Ballon beginnt extremst hell zu leuchten und um !target stehen plötzlich mehrere Geister, die den gleichen Kopf haben wie !source. Die Gester und !source machen die selbe Bewegung und daraufhin fliegen alle Geister auf !target zu. Die Geister explodieren, !target kann sich jedoch noch im letzten Moment befreien.', '!source atmet tief ein und entlässt einen golden Ballon hinter !target. Der Ballon beginnt extremst hell zu leuchten und um !target stehen plötzlich mehrere Geister, die den gleichen Kopf haben wie !source. Die Gester und !source machen die selbe Bewegung und daraufhin fliegen alle Geister auf !target zu. Die Geister explodieren, !target ist jedoch bereits tot.', '', 'Der Spieler entlässt einen hellen Ballon aus dem Geister entstehen, die bei Kontakt explodieren.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(216, 'Super Ghost Kamikaze 100 Finish', 'superghostkamikaze100finish', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source atmet tief ein und entlässt daraufhin eine riesige Anzahl an Geistern. Jeder Geist hat den selben Kopf wie !source. Die Geister stellen sich wie eine Armee neben !source auf und salutieren. !source geht neben der Armee her. Daraufhin zeigt !source auf !target. Die Geister fliegen daraufhin schnell auf !target zu und explodieren beim Kontakt. !target erleidet !type !damage Schaden.', '!source atmet tief ein und entlässt daraufhin eine riesige Anzahl an Geistern. Jeder Geist hat den selben Kopf wie !source. Die Geister stellen sich wie eine Armee neben !source auf und salutieren. !source geht neben der Armee her. Daraufhin zeigt !source auf !target. Die Geister fliegen daraufhin schnell auf !target zu und explodieren beim Kontakt. !target weicht jedoch jeden einzelnen Geist vor dem Kontakt aus.', '!source atmet tief ein und entlässt daraufhin eine riesige Anzahl an Geistern. Jeder Geist hat den selben Kopf wie !source. Die Geister stellen sich wie eine Armee neben !source auf und salutieren. !source geht neben der Armee her. Daraufhin zeigt !source auf !target. Die Geister fliegen daraufhin schnell auf !target zu und explodieren beim Kontakt. !target ist jedoch bereits tot.', '', 'Der Spieler entlässt eine Armee an Geistern.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(217, 'Masenko', 'masenko', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source positioniert beide Hände über den Kopf und sammelt Energie. Daraufhin entlässt !source einen gelben Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source positioniert beide Hände über den Kopf  und sammelt Energie. Daraufhin entlässt !source einen gelben Energiestrahl auf !target. !target weicht den Strahl leicht aus.', '!source positioniert beide Hände über den Kopf  und sammelt Energie. Daraufhin entlässt !source einen gelben Energiestrahl auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler feuert einen gelben Energiestrahl auf den Gegner ab. ', 0, '', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(218, 'Masendan', 'masendan', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. Die Energie bildet sich zu einer Kugel. !source nimmt die Kugel und wirft sie auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. Die Energie bildet sich zu einer Kugel. !source nimmt die Kugel und wirft sie auf !target. !target weicht jedoch aus.', '!source tut beide Hände über den Kopf und sammelt Energie. Die Energie bildet sich zu einer Kugel. !source nimmt die Kugel und wirft sie auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie und wirft sie in Form einer Kugel auf den Gegner.', 0, '', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(219, 'Golden Dome Attack', 'goldendomeattack', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source umgibt sich mit gelber Energie. !source konzentriert die Energie daraufhin in einer Kugel und schleudert einen gelben Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source umgibt sich mit gelber Energie. !source konzentriert die Energie daraufhin in einer Kugel und schleudert einen gelben Energiestrahl auf !target. !target weicht den Strahl leicht aus.', '!source umgibt sich mit gelber Energie. !source konzentriert die Energie daraufhin in einer Kugel und schleudert einen gelben Energiestrahl auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler umgibt sich mit Energie die er als Energiestrahl auf den Gegner schießt.', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(220, 'Double Masenko', 'doublemasenko', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt Energie über den Kopf und breitet daraufhin beide Hände aus. !source schießt zwei Energiestrahlen die auf !target zu fliegen. !target wird getroffen und erleidet !type !damage Schaden.', '!source sammelt Energie über den Kopf und breitet daraufhin beide Hände aus. !source schießt zwei Energiestrahlen die auf !target zu fliegen. !target weicht den Strahlen leicht aus.', '!source sammelt Energie über den Kopf und breitet daraufhin beide Hände aus. !source schießt zwei Energiestrahlen die auf !target zu fliegen. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt zwei Energiestrahlen auf den Feind.', 0, '', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(221, 'Multiple Masenko', 'multiplemasenko', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. !source schießt die Energie daraufhin von beiden Fingerspitzen aus auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. !source schießt die Energie daraufhin von beiden Fingerspitzen aus auf !target. !target weicht jedoch aus.', '!source tut beide Hände über den Kopf und sammelt Energie. !source schießt die Energie daraufhin von beiden Fingerspitzen aus auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt die Energie von den Fingerspitzen aus ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(222, 'Full Power Masenko', 'fullpowermasenko', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin entlässt !source einen großen Energiestrahl der auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin entlässt !source einen großen Energiestrahl der auf !target zu fliegt. !target weicht den Strahl jedoch aus.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin entlässt !source einen großen Energiestrahl der auf !target zu fliegt. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt einen großen Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(223, 'Explosive Madan', 'explosivemadan', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin entlässt !source einen kurzen aber riesigen Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin entlässt !source einen kurzen aber riesigen Energiestrahl ab, der auf !target zu fliegt. !target weicht den Strahl jedoch aus.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin entlässt !source einen kurzen aber riesigen Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt einen riesigen Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(224, 'Gekiretsu Madan', 'gekiretsumadan', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin schießt !source viele Energiebälle auf !target die bei Kontakt explodieren. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin schießt !source viele Energiebälle auf !target die bei Kontakt explodieren. !target weicht jedoch jeden Ball aus.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände. Daraufhin schießt !source viele Energiebälle auf !target die bei Kontakt explodieren. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt viele Energiekugeln auf den Gegner.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(225, 'Super Masenko', 'supermasenko', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen Energiestrahl ab, der auf !target zu fliegt. !target weicht den Strahl jedoch aus.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt einen gewaltigen Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(226, 'Super Explosive Madan', 'superexplosivemadan', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine riesige Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen, von Blitzen umgebenden, Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine riesige Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen, von Blitzen umgebenden, Energiestrahl ab, der auf !target zu fliegt. !target weicht den Strahl jedoch aus.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine riesige Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen, von Blitzen umgebenden, Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt einen gewaltigen, von Blitzen umgebenden, Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(227, 'Ultimate Masenko', 'ultimatemasenko', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine riesige brennende Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen, von Blitzen umgebenden, gelb-brennenden Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen und erleidet !type !damage Schaden.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine riesige brennende Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen, von Blitzen umgebenden, gelb-brennenden Energiestrahl ab, der auf !target zu fliegt. !target weicht den Strahl jedoch aus.', '!source tut beide Hände über den Kopf und sammelt Energie. Es bilden sich Blitze um die Hände und eine riesige brennende Aura bildet sich um !source. Daraufhin entlässt !source einen gewaltigen, von Blitzen umgebenden, gelb-brennenden Energiestrahl ab, der auf !target zu fliegt. !target wird getroffen. !target ist jedoch bereits tot.', '', 'Der Spieler sammelt Energie über den Kopf und schießt einen gewaltigen, von Blitzen umgebenden, gelb-brennenden Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(228, 'Dodon Ray', 'dodonray', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit dem Finger auf !target und entlässt einen kleinen Energiestrahl. !target wird getroffen und erleidet !type !damage Schaden.', '!source zeigt mit dem Finger auf !target und entlässt einen kleinen Energiestrahl. !target weicht den Strahl leicht aus.', '!source zeigt mit dem Finger auf !target und entlässt einen kleinen Energiestrahl. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt von der Fingerspitze einen kleinen Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 1, 1),
(229, 'Original Dodonpa', 'originaldodonpa', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit dem Finger auf !target und entlässt einen gelben Energiestrahl. !target wird getroffen und erleidet !type !damage Schaden.', '!source zeigt mit dem Finger auf !target und entlässt einen gelben Energiestrahl. !target weicht den Strahl leicht aus.', '!source zeigt mit dem Finger auf !target und entlässt einen gelben Energiestrahl. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt von der Fingerspitze einen gelben Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 1, 1),
(230, 'Ki Blast Cannon', 'kiblastcannon', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source hät beide Hände nach vorne und schießt einen gelben Energiestrahl auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source hät beide Hände nach vorne und schießt einen gelben Energiestrahl auf !target. !target weicht den Strahl leicht aus.', '!source hät beide Hände nach vorne und schießt einen gelben Energiestrahl auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt von beiden Händen einen gelben Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 1, 1),
(231, 'Dodon Barrage', 'dodonbarrage', 1, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit dem Finger auf !target und entlässt mehrere gelbe Energiestrahlen. !target wird getroffen und erleidet !type !damage Schaden.', '!source zeigt mit dem Finger auf !target und entlässt mehrere gelbe Energiestrahlen. !target weicht den Strahlen aus.', '!source zeigt mit dem Finger auf !target und entlässt mehrere gelbe Energiestrahlen. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt von der Fingerspitze mehrere gelbe Energiestrahlen ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 1, 1),
(232, 'Super Dodon Blast', 'superdodonblast', 1, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 30, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit dem Finger auf !target und entlässt einen großen gelben Energiestrahl. !target wird getroffen und erleidet !type !damage Schaden.', '!source zeigt mit dem Finger auf !target und entlässt einen großen gelben Energiestrahl. !target weicht den Strahl jedoch aus.', '!source zeigt mit dem Finger auf !target und entlässt einen großen gelben Energiestrahl. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt von der Fingerspitze einen großen gelben Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 1, 1),
(233, 'Super Dodon Wave', 'superdodonwave', 1, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit dem Finger auf !target und entlässt einen gewaltigen gelben Energiestrahl. !target wird getroffen und erleidet !type !damage Schaden.', '!source zeigt mit dem Finger auf !target und entlässt einen gewaltigen gelben Energiestrahl. !target weicht den Strahl jedoch aus.', '!source zeigt mit dem Finger auf !target und entlässt einen gewaltigen gelben Energiestrahl. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt von der Fingerspitze einen gewaltigen gelben Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 1, 1),
(234, 'Neo Dodon Ray', 'neododonray', 1, 120, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source zeigt mit dem Finger auf !target und entlässt einen gewaltigen, von Blitzen umgebenden, gelben Energiestrahl. !target wird getroffen und erleidet !type !damage Schaden.', '!source zeigt mit dem Finger auf !target und entlässt einen gewaltigen, von Blitzen  umgebenden, gelben Energiestrahl. !target weicht den Strahl jedoch aus.', '!source zeigt mit dem Finger auf !target und entlässt einen gewaltigen, von Blitzen umgebenden, gelben Energiestrahl. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler schießt von der Fingerspitze einen gewaltigen, von Blitzen umgebenden, gelben Energiestrahl ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1200, 0, 0, 24, 1, 1, 1),
(235, 'Tri Beam', 'tribeam', 1, 140, 0, 100, 0, 0, 0, 0, 0, 2800, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet mit den beiden Händen ein Dreieck. !source schreit daraufhin und entlässt eine gewaltige Energiewelle von den Händen aus auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source bildet mit den beiden Händen ein Dreieck. !source schreit daraufhin und entlässt eine gewaltige Energiewelle von den Händen aus auf !target. !target weicht der Energiewelle jedoch aus.', '!source bildet mit den beiden Händen ein Dreieck. !source schreit daraufhin und entlässt eine gewaltige Energiewelle von den Händen aus auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler bildet mit den Händen ein Dreieck und schießt eine gewaltige Energiewelle ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1400, 0, 0, 24, 1, 1, 1),
(236, 'Spirit Tri Beam', 'spirittribeam', 1, 160, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet mit einer Hand ein Dreieck. !source sammelt Energie, schreit daraufhin und entlässt eine gewaltige Energiewelle von der Hand aus auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source bildet mit einer Hand ein Dreieck. !source sammelt Energie, schreit daraufhin und entlässt eine gewaltige Energiewelle von der Hand aus auf !target. !target weicht der Energiewelle jedoch aus.', '!source bildet mit einer Hand ein Dreieck. !source sammelt Energie, schreit daraufhin und entlässt eine gewaltige Energiewelle von der Hand aus auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler bildet mit einer Hand ein Dreieck und schießt eine gewaltige Energiewelle ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1600, 0, 0, 24, 1, 1, 1),
(237, 'Neo Tri Beam', 'neotribeam', 1, 180, 0, 100, 0, 0, 0, 0, 0, 3600, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet mit beiden Händen ein Dreieck. !source sammelt Energie, wodurch es zwischen den Händen anfängt hell zu leuchten. !source wird von einer Aura umgeben, schreit daraufhin und entlässt eine gewaltige, von Blitzen umgebende, Energiewelle von der Hand aus auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source bildet mit beiden Händen ein Dreieck. !source sammelt Energie, wodurch es zwischen den Händen anfängt hell zu leuchten. !source wird von einer Aura umgeben, schreit daraufhin und entlässt eine gewaltige, von Blitzen umgebende, Energiewelle von der Hand aus auf !target. !target weicht der Energiewelle jedoch aus.', '!source bildet mit beiden Händen ein Dreieck. !source sammelt Energie, wodurch es zwischen den Händen anfängt hell zu leuchten. !source wird von einer Aura umgeben, schreit daraufhin und entlässt eine gewaltige, von Blitzen umgebende, Energiewelle von der Hand aus auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler bildet mit einer Hand ein Dreieck und schießt eine, von Blitzen umgebende, gewaltige Energiewelle ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1800, 0, 0, 24, 1, 1, 1),
(238, 'Ultra Tri Beam', 'ultratribeam', 1, 200, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 90, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet mit beiden Händen ein Dreieck. !source sammelt Energie, wodurch es zwischen den Händen anfängt hell zu leuchten. !source wird von einer brennenden Aura umgeben, schreit daraufhin und entlässt eine gewaltige, von Blitzen umgebende, brennende Energiewelle von der Hand aus auf !target. !target wird getroffen und erleidet !type !damage Schaden.', '!source bildet mit beiden Händen ein Dreieck. !source sammelt Energie, wodurch es zwischen den Händen anfängt hell zu leuchten. !source wird von einer brennenden Aura umgeben, schreit daraufhin und entlässt eine gewaltige, von Blitzen umgebende, brennende Energiewelle von der Hand aus auf !target. !target weicht der Energiewelle jedoch aus.', '!source bildet mit beiden Händen ein Dreieck. !source sammelt Energie, wodurch es zwischen den Händen anfängt hell zu leuchten. !source wird von einer brennenden Aura umgeben, schreit daraufhin und entlässt eine gewaltige, von Blitzen umgebende, brennende Energiewelle von der Hand aus auf !target. !target wird getroffen, !target ist jedoch bereits tot.', '', 'Der Spieler bildet mit einer Hand ein Dreieck und schießt eine, von Blitzen umgebende, gewaltige \r\n brennende Energiewelle ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 1, 1),
(239, 'Muscle Guard', 'muscleguard', 18, 50, 0, 0, 0, 0, 100, 0, 0, 500, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source spannt die Muskeln an, wodurch der Körper von !source härter wird.', '!source entspannt die Muskeln wieder.', '', '', 'Der Spieler spannt die Muskeln an wodurch sein Körper eine größere Verteidigung hat.', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 2, 0, 24, 1, 0, 1),
(240, 'Ki Guard', 'kiguard', 21, 200, 0, 0, 0, 0, 100, 0, 0, 300, 0, 8, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet schützende KI um den Körper, die Angriffe abwehren kann.', '!source lässt die KI wieder verschwinden.', '', '', 'Der Spieler umgibt sich mit schützender KI.', 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 24, 1, 0, 1),
(241, 'Hyper Guard', 'hyperguard', 21, 200, 0, 0, 0, 0, 100, 0, 0, 300, 0, 16, 1, 0, 0, 0, 0, 0, 0, 100, '!source nimmt eine Verteidigungshaltung an und umgibt sich mit einer elektrischen Aura.', '!source lässt die elektrische Aura wieder verschwinden.', '', '', 'Der Spieler umgibt sich mit einer schützenden elektrischen Aura.', 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 2, 0, 24, 1, 0, 1),
(242, 'Energy Guard', 'energyguard', 21, 200, 0, 0, 0, 0, 100, 0, 0, 300, 0, 24, 1, 0, 0, 0, 0, 0, 0, 100, '!source nimmt eine Verteidigungshaltung an und umgibt sich mit einer Aura aus Energie, die Angriffe abwehren kann.', '!source lässt die Aura aus Energie wieder verschwinden.', '', '', 'Der Spieler umgibt sich mit einer schützenden Aura aus Energie.', 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 3, 0, 24, 1, 0, 1),
(243, 'Ultra Guard', 'ultraguard', 21, 200, 0, 0, 0, 0, 100, 0, 0, 300, 0, 32, 1, 0, 0, 0, 0, 0, 0, 100, '!source nimmt eine Verteidigungshaltung an und umgibt sich mit einer brennenden Aura aus Energie, die Angriffe abwehren kann.', '!source lässt die brennende Aura aus Energie wieder verschwinden.', '', '', 'Der Spieler umgibt sich mit einer schützenden brennenden Aura aus Energie.', 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 4, 0, 24, 1, 0, 1),
(245, 'Wizard Shield', 'wizardbarrier', 2, 8, 0, 0, 0, 0, 100, 0, 0, 1600, 0, 32, 0, 0, 0, 0, 0, 0, 0, 100, '!source bildet eine schützende Kugel aus Energie um sich.', '', '', '', 'Der Spieler bildet eine schützende Kugel aus Energie um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 50, 0, 0, 24, 1, 0, 1),
(246, 'Energy Shield', 'energybarrier', 2, 12, 0, 0, 0, 0, 100, 0, 0, 2400, 0, 48, 0, 0, 0, 0, 0, 0, 0, 100, '!source bildet eine schützende Barriere aus purer Energie um sich.', '', '', '', 'Der Spieler bildet eine schützende Barriere um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 60, 0, 0, 24, 1, 0, 1),
(247, 'Absolute Shield', 'absolutebarrier', 2, 16, 0, 0, 0, 0, 100, 0, 0, 3200, 0, 64, 0, 0, 0, 0, 0, 0, 0, 100, '!source bildet eine perfekte schützende Barriere aus purer Energie um sich.', '', '', '', 'Der Spieler bildet eine perfekte schützende Barriere um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 80, 0, 0, 24, 1, 0, 1),
(248, 'KI Shield', 'kibarrier', 2, 20, 0, 0, 0, 0, 100, 0, 0, 4000, 0, 80, 0, 0, 0, 0, 0, 0, 0, 100, '!source umgibt sich mit schützender KI, wodurch Angriffe blockiert werden.', '', '', '', 'Die KI des Spielers ist so gewaltig, dass sie selbst Angriffe blockiert.', 0, '', 1, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(249, 'Aura Shield', 'aurabarrier', 2, 4, 0, 0, 0, 0, 100, 0, 0, 800, 0, 16, 0, 0, 0, 0, 0, 0, 0, 100, '!source bildet eine schützende Aura um sich.', '', '', '', 'Der Spieler bildet eine schützende Aura um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 40, 0, 0, 24, 1, 0, 1),
(250, 'KI Reflect', 'kishield', 20, 100, 0, 0, 0, 0, 0, 0, 25, 500, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet einen reflektierenden KI Schild um sich.', '', '', '', 'Der Spieler bildet einen reflektierenden KI Schild um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 20, 0, 0, 24, 1, 0, 1),
(251, 'Electric Reflect', 'electricshield', 20, 100, 0, 0, 0, 0, 0, 0, 30, 1200, 0, 24, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet einen reflektierenden elektrischen Schild um sich.', '', '', '', 'Der Spieler bildet einen reflektierenden elektrischen Schild um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 30, 0, 0, 24, 1, 0, 1),
(252, 'Energy Reflect', 'energyshield', 20, 100, 0, 0, 0, 0, 0, 0, 35, 1900, 0, 38, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet einen reflektierenden Schild aus reiner Energie um sich.', '', '', '', 'Der Spieler bildet einen reflektierenden Energieschild um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 40, 0, 0, 24, 1, 0, 1),
(253, 'Absolute Reflect', 'absoluteshield', 20, 100, 0, 0, 0, 0, 0, 0, 40, 2600, 0, 52, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet einen starken Schild aus purer Energie, der hell leuchtet und alle Angriffe reflektiert.', '', '', '', 'Der Spieler bildet einen reflektierenden und leuchtenden Energieschild um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 60, 0, 0, 24, 1, 0, 1),
(254, 'Golden Reflect', 'goldenshield', 20, 100, 0, 0, 0, 0, 0, 0, 50, 4000, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source bildet einen starken Schild aus purer Energie, der golden leuchtet und alle Angriffe reflektiert.', '', '', '', 'Der Spieler bildet einen reflektierenden und golden leuchtenden Energieschild um sich.', 0, '', 1, 0, 0, 0, 0, 0, 0, 80, 0, 0, 24, 1, 0, 1),
(255, 'KI Barrier', 'kidefense', 21, 200, 0, 0, 0, 0, 100, 100, 0, 300, 0, 8, 1, 0, 0, 0, 0, 0, 0, 100, '!source stellt sich verteidigend vor alle im Team und bildet eine KI Barriere. !source zieht die Angriffe auf sich.', '', '', '', 'Der Spieler zieht die Angriffe auf sich und schützt sich mit einer KI Barriere.', 0, '', 1, 0, 0, 0, 0, 0, 0, 20, 1, 0, 24, 1, 0, 1),
(256, 'Energy Barrier', 'energydefense', 21, 200, 0, 0, 0, 0, 100, 100, 0, 300, 0, 16, 1, 0, 0, 0, 0, 0, 0, 100, '!source stellt sich verteidigend vor alle im Team und bildet eine große Energie Barriere. !source zieht die Angriffe auf sich.', '', '', '', 'Der Spieler zieht die Angriffe auf sich und schützt sich mit einer großen Energie Barriere.', 0, '', 1, 0, 0, 0, 0, 0, 0, 30, 2, 0, 24, 1, 0, 1),
(257, 'Absolute Barrier', 'absolutedefense', 21, 200, 0, 0, 0, 0, 100, 100, 0, 300, 0, 24, 1, 0, 0, 0, 0, 0, 0, 100, '!source stellt sich verteidigend vor alle im Team und bildet eine gewaltige Energie Barriere, die das ganze Team umgibt. !source zieht die Angriffe auf sich.', '', '', '', 'Der Spieler zieht die Angriffe auf sich und schützt sich mit einer gewaltigen Energie Barriere.', 0, '', 1, 0, 0, 0, 0, 0, 0, 40, 3, 0, 24, 1, 0, 1),
(258, 'Perfect Barrier', 'perfectdefense', 21, 200, 0, 0, 0, 0, 100, 100, 0, 300, 0, 32, 1, 0, 0, 0, 0, 0, 0, 100, '!source stellt sich verteidigend vor alle im Team und bildet mehrere gewaltige Energie Barrieren, die das ganze Team umgeben. !source zieht die Angriffe auf sich.', '', '', '', 'Der Spieler zieht die Angriffe auf sich und schützt sich mit mehrere gewaltige Energie Barrieren.', 0, '', 1, 0, 0, 0, 0, 0, 0, 60, 4, 0, 24, 1, 0, 1),
(259, 'God Barrier', 'goddefense', 21, 200, 0, 0, 0, 0, 100, 100, 0, 300, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source stellt sich verteidigend vor alle im Team und bildet eine gewaltige Barriere, die wie eine göttliche Aura brennt. !source zieht die Angriffe auf sich.', '', '', '', 'Der Spieler zieht die Angriffe auf sich und schützt sich mit einer brennenden göttlichen Barriere.', 0, '', 1, 0, 0, 0, 0, 0, 0, 80, 5, 0, 24, 1, 0, 1),
(260, 'Heal', 'heal', 5, 30, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 24, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hände auf !target, konzentriert Energie und heilt !target um !damage.', '!source hält die Hände auf !target, konzentriert Energie und !target weicht aus.', '!source hält die Hände auf !target und konzentriert Energie, !target ist jedoch tot.', '', 'Der Spieler heilt das Ziel.', 0, '', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(261, 'Strong Heal', 'strongheal', 5, 50, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hände auf !target und konzentriert Energie. Eine grüne Aura umgibt !target und !source heilt !target um !damage.', '!source hält die Hände auf !target und konzentriert Energie. Eine grüne Aura umgibt !target, !target weicht jedoch aus.', '!source hält die Hände auf !target und konzentriert Energie. Eine grüne Aura umgibt !target, !target ist jedoch bereits tot.', '', 'Der Spieler heilt das Ziel gut.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 0, 1),
(262, 'Hyper Heal', 'hyperheal', 5, 75, 0, 100, 0, 0, 0, 0, 0, 3000, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hände auf !target und konzentriert Energie. Wellen von Energie umgeben den Körper von !target und !source heilt !target um !damage.', '!source hält die Hände auf !target und konzentriert Energie. Wellen von Energie umgeben den Körper von !target, !target weicht jedoch aus.', '!source hält die Hände auf !target und konzentriert Energie. Wellen von Energie umgeben den Körper von !target. !target bleibt jedoch tot.', '', 'Der Spieler heilt das Ziel stark.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1500, 0, 0, 24, 1, 0, 1),
(263, 'Ultra Heal', 'ultraheal', 5, 100, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hände auf !target und konzentriert Energie. Ein blauer Strahl bewegt sich auf !target und !source heilt !target um !damage.', '!source hält die Hände auf !target und konzentriert Energie. Ein blauer Strahl bewegt sich auf !target, !target weicht diesen jedoch aus.', '!source hält die Hände auf !target und konzentriert Energie. Ein blauer Strahl bewegt sich auf !target, !target bleibt jedoch tot.', '', 'Der Spieler heilt das Ziel sehr stark.', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 0, 1),
(264, 'Weak Transfer', 'lifetransfer', 22, 15, 0, 100, 0, 0, 0, 0, 0, 200, 0, 25, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand auf !target und !target wird von einer heilenden Aura umgeben.', '!source hält eine Hand auf !target und !target wird von einer heilenden Aura umgeben, !target bewegt sich jedoch aus der Aura heraus.', '', '!target wird um !type !damage Schaden durch die heilende Aura von !source geheilt.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 100, 2, 0, 24, 1, 0, 1),
(265, 'Transfer', 'kitransfer', 22, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand auf !target und !target wird von einer gelben Aura umgeben die !target heilt.', '!source hält eine Hand auf !target und !target wird von einer gelben Aura umgeben, !target bewegt sich jedoch aus der Aura hinaus.', '', '!target wird um !type !damage Schaden durch die gelbe Aura von !source geheilt.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 250, 2, 0, 24, 1, 0, 1),
(266, 'Strong Transfer', 'energytransfer', 22, 60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand auf !target wodurch ein grüner Nebel auf !target zufliegt der !target heilt.', '!source hält eine Hand auf !target wodurch ein grüner Nebel auf !target zufliegt, !target weicht den Nebel jedoch aus.', '', '!target wird um !type !damage Schaden durch den grünen Nebel von !source geheilt.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 500, 2, 0, 24, 1, 0, 1),
(267, 'Unlock Defense', 'unlockdefense', 18, 50, 0, 0, 0, 0, 100, 0, 0, 500, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält die Hand auf !target, wodurch Energie in !target frei wird und die Verteidigung von !target temporär steigt.', '!source konnte die innere Verteidigung von !target nicht erwachen.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 500, 2, 0, 24, 1, 0, 1),
(268, 'Unlock Potential', 'unlockpotential', 18, 50, 0, 0, 0, 100, 100, 0, 0, 1000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source fängt an um !target in einen Kreis zu tanzen. Nach einiger Zeit hört !source auf und !target erhält plötzlich eine starke Kraft.', '!source tanzt für eine lange Zeit um !target, es passiert jedoch nichts.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 500, 2, 0, 24, 1, 0, 1),
(269, 'Release Power', 'releasepower', 18, 100, 0, 0, 0, 100, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält beide Hände auf !target und konzentriert die Energie. Daraufhin erhält !target eine riesige Menge an Kraft, die jedoch nur für einen Angriff reicht.', '!source hält beide Hände auf !target und konzentriert Energie, es passiert jedoch nichts.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 0, 1),
(270, 'Protective Shield', 'protectiveshield', 18, 100, 0, 0, 0, 0, 100, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!sourcer hält beide Hände auf !target und konzentriert die Energie. Daraufhin entsteht ein Energieschild um !target, der !target für einen Angriff beschützt.', '!source hält beide Hände auf !target und konzentriert Energie, es passiert jedoch nichts.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 0, 1),
(271, 'Solar Flare', 'solarflare', 9, 3, 0, 0, 0, 0, 0, 0, 0, 1600, 0, 16, 0, 0, 0, 0, 0, 0, 0, 90, '!source stellt sich vor !target hin und schaut diesen an. Daraufhin positioniert !source beide Hände vor die Stirn und fängt an zu schreien. Ein grelles Licht entsteht, welches !target blendet. ', '!source stellt sich vor !target hin und schaut diesen an. Daraufhin positioniert !source beide Hände vor die Stirn und fängt an zu schreien. Ein grelles Licht entsteht, jedoch konnte !target rechtzeitig die Augen schließen. ', '!source stellt sich vor !target hin und schaut diesen an. Daraufhin positioniert !source beide Hände vor die Stirn und fängt an zu schreien. Ein grelles Licht entsteht, welches !target blendet, !target ist jedoch tot.', '', 'Der Spieler blendet den Gegner für ein paar Runden.', 0, '', 1, 272, 0, 0, 0, 0, 0, 30, 0, 0, 24, 1, 0, 1),
(272, 'Blinded', 'blinded', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source ist geblendet und bewegt sich nicht.', '!source kann wieder sehen.', '', '', '', 0, '', 0, 271, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(273, 'Stone Spit', 'stonespit', 9, 4, 0, 0, 0, 0, 0, 0, 0, 2200, 0, 22, 0, 0, 0, 0, 0, 0, 0, 90, '!source schaut zu !target und spuckt !target an. Die Spucke trifft !target und beginnt !target zu versteinern. !target wird komplett versteinert.', '!source schaut zu !target und spuckt !target an. Die Spucke verfehlt !target jedoch.', '!source schaut zu !target und spuckt !target an. Die Spucke trifft !target und beginnt !target zu versteinern. !target ist jedoch bereits schon tot.', '', 'Der Spieler versteinert den Gegner für ein paar Runden.', 0, '', 1, 274, 0, 0, 0, 0, 0, 40, 0, 0, 24, 1, 0, 1),
(274, 'Stoned', 'stoned', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source ist versteinert.', 'Die Versteinerung von !source wird aufgehoben.', '', '', '', 0, '', 0, 273, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(275, 'Demon Eye', 'demoneye', 18, -25, 0, 0, 0, 0, 100, 0, 0, 500, 0, 20, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Hände in kreisenden Bewegungen und beschwört Schleim der die Verteidigung von !target senkt.', '!source bewegt die Hände in kreisenden Bewegungen und beschwört Schleim, !target weicht jedoch aus.', '!source bewegt die Hände in kreisenden Bewegungen und beschwört Schleim, !target ist jedoch tot.', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -500, 2, 0, 24, 1, 0, 1),
(276, 'Mind Control', 'mindcontrol', 18, -25, 0, 0, 0, 100, 100, 0, 0, 500, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Hände in kreisenden Bewegungen und tritt in den Geist von !target ein. !target wird von !source manipuliert und ist dadurch schwächer.', '!source bewegt die Hände in kreisenden Bewegungen und tritt in den Geist von !target ein. !target kann sich jedoch gegen !source wehren.', '!source bewegt die Hände in kreisenden Bewegungen und tritt in den Geist von !target ein. !target ist jedoch bereits tot.', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -500, 2, 0, 24, 1, 0, 1),
(277, 'Brainwash', 'brainwash', 18, -50, 0, 0, 0, 100, 0, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Hände in kreisenden Bewegungen gegen !target. Daraufhin spührt !target einen Schmerz im Kopf und kann nicht mehr die volle Kraft nutzen.', '!source bewegt die Hände in kreisenden Bewegungen gegen !target. !target kann sich jedoch dagegen wehren.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -2000, 0, 0, 24, 1, 0, 1),
(278, 'Hypnosis', 'hypnosis', 18, -50, 0, 0, 0, 0, 100, 0, 0, 2000, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Hände in kreisenden Bewegungen gegen !target. !target wird daraufhin schläfrig und kann sich nicht richtig verteidigen.', '!source bewegt die Hände in kreisenden Bewegungen gegen !target. !target bleibt jedoch wach.', '', '', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -2000, 0, 0, 24, 1, 0, 1),
(279, 'Drain', 'drain', 12, 40, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 32, 1, 0, 0, 0, 0, 0, 0, 100, '!source umklammert !target und fasst mit einer Hand auf den Körper von !target. !source absorbiert daraufhin Energie von !target. !target erleidet !type !damage Schaden und !source heilt sich um einen Anteil des Schadens.', '!source versucht !target zu umklammern, !target weicht jedoch aus.', '!source umklammert !target und fasst mit einer Hand auf den Körper von !target. !source absorbiert daraufhin Energie von !target. !target ist jedoch bereits tot.', '', 'Der Spieler umklammert den Gegner und absorbiert Energie vom Gegner.', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(280, 'Strong Drain', 'strongdrain', 12, 60, 0, 100, 0, 0, 0, 0, 0, 2400, 0, 48, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt sich schnell auf !target zu und würgt !target. Daraufhin absorbiert !source Energie von !target. !target erleidet !type !damage Schaden und !source heilt sich um einen Anteil des Schadens.', '!source bewegt sich schnell auf !target zu und würgt !target. !target kann sich jedoch noch befreien.', '!source bewegt sich schnell auf !target zu und würgt !target. Daraufhin absorbiert !source Energie von !target. !target ist jedoch bereits tot.', '', 'Der Spieler würgt den Gegner und absorbiert Energie vom Gegner.', 0, '', 1, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(281, 'Hyper Drain', 'hyperdrain', 12, 80, 0, 100, 0, 0, 0, 0, 0, 3200, 0, 64, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt sich schnell auf !target zu umfasst !target mit beiden Armen. Daraufhin absorbiert !source Energie von !target. !target erleidet !type !damage Schaden und !source heilt sich um einen Anteil des Schadens.', '!source bewegt sich schnell auf !target zu umfasst !target mit beiden Armen. !target kann sich jedoch noch befreien.', '!source bewegt sich schnell auf !target zu umfasst !target mit beiden Armen. Daraufhin absorbiert !source Energie von !target. !target ist jedoch bereits tot.', '', 'Der Spieler umfasst den Gegner mit beiden Armen und absorbiert Energie vom Gegner.', 0, '', 1, 0, 0, 0, 0, 0, 0, 800, 0, 0, 24, 1, 0, 1),
(282, 'Ultra Drain', 'ultradrain', 12, 100, 0, 100, 0, 0, 0, 0, 0, 4000, 0, 80, 1, 0, 0, 0, 0, 0, 0, 100, '!source durchbohrt mit einer Hand !target und würgt mit der anderen Hand !target. Daraufhin absorbiert !source Energie von !target. !target erleidet !type !damage Schaden und !source heilt sich um einen Anteil des Schadens.', '!source durchbohrt mit einer Hand !target und würgt mit der anderen Hand !target. !target kann sich jedoch noch befreien.', '!source durchbohrt mit einer Hand !target und würgt mit der anderen Hand !target. Daraufhin absorbiert !source Energie von !target. !target ist jedoch bereits tot.', '', 'Der Spieler durchbohrt den Gegner und absorbiert Energie vom Gegner.', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 0, 0, 24, 1, 0, 1),
(283, 'Curse', 'curseki', 22, -40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 40, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Arme in Kreisenden Bewegungen und belegt !target mit einen Fluch, der !target jede Runde schwächt.', '!source bewegt die Arme in Kreisenden Bewegungen, kann !target jedoch mit den Fluch nicht belegen.', '', '!target erleidet !type !damage Schaden durch den Fluch von !source.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -250, 2, 0, 24, 1, 0, 1),
(284, 'Strong Curse', 'curseenergy', 22, -60, 0, 100, 0, 0, 0, 0, 0, 1200, 0, 50, 1, 0, 0, 0, 0, 0, 0, 100, '!sourc bewegt die Arme in Kreisenden Bewegungen und belegt !target mit einen starken Fluch, der !target jede Runde schwächt.', '!source bewegt die Arme in Kreisenden Bewegungen, kann !target jedoch mit den starken Fluch nicht belegen.', '', '!target erleidet !type !damage Schaden durch den starken Fluch von !source.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -500, 2, 0, 24, 1, 0, 1),
(285, 'Brumm', 'brumm', 1, 10, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, '!source fährt gegen !target und verursacht !type !damage Schaden.', '!target weicht !source aus.', '!source fährt gegen !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(286, 'Tritt', 'tritt', 1, 2, 0, 100, 0, 0, 0, 0, 0, 8, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source tritt auf !target ein und verursacht !type !damage Schaden.', '!source will auf !target eintreten, verfehlt jedoch.', '!source will auf !target eintreten, !target ist jedoch bereits tot.', '', 'Der Spieler tritt auf das Ziel ein.', 0, '', 1, 0, 0, 0, 0, 0, 0, 20, 0, 4, 1, 1, 1, 1),
(287, 'Ellbogen', 'ellbogen', 1, 3, 0, 100, 0, 0, 0, 0, 0, 18, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source greift mit den Ellbogen !target an und verursacht !type !damage Schaden.', '!source will !target mit den Ellbogen angreifen, verfehlt jedoch.', '!source will !target mit den Ellbogen angreifen, !target ist jedoch bereits tot.', '', 'Der Spieler greift das Ziel mit dem Ellbogen an.', 0, '', 1, 0, 0, 0, 0, 0, 0, 30, 0, 5, 2, 1, 1, 1),
(288, 'Geballte Hand', 'geballtehand', 1, 4, 0, 100, 0, 0, 0, 0, 0, 32, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source ballt beide Hände zusammen und schlägt auf !target ein. !target erleidet !type !damage Schaden.', '!source ballt beide Hände zusammen und schlägt auf !target ein, !target weicht jedoch aus.', '!source ballt beide Hände zusammen und schlägt auf !target ein, !target ist jedoch bereits tot.', '', 'Der Spieler presst beide Hände zusammen und schlägt damit auf den Gegner ein.', 0, '', 1, 0, 0, 0, 0, 0, 0, 40, 0, 0, 4, 1, 1, 1),
(289, 'Feuer', 'feuer', 1, 100, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, '!source brennt wild und verbrennt !target. !target erleidet !type !damage Schaden.', '!source brennt wild.', '!source brennt wild und verbrennt !target. !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(290, 'Wände', 'wandattack', 1, 150, 0, 100, 0, 0, 0, 0, 0, 63, 0, 1, 0, 0, 0, 0, 0, 0, 0, 20, 'Die Wände von !source schließen sich und treffen !target. !target erleidet !type !damage Schaden.', 'Die Wände von !source schließen sich.', 'Die Wände von !source schließen sich und treffen !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 150, 0, 0, 24, 1, 0, 1),
(291, 'Pinball', 'pinball', 1, 200, 0, 100, 0, 0, 0, 0, 0, 63, 0, 1, 0, 0, 0, 0, 0, 0, 0, 20, 'Die Kugel von !source erwischt !target und !target erleidet !type !damage Schaden.', 'Die Kugel von !source rollt.', 'Die Kugel von !source erwischt !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1);
INSERT INTO `attacks` (`id`, `name`, `image`, `type`, `value`, `epvalue`, `lpvalue`, `kpvalue`, `atkvalue`, `defvalue`, `tauntvalue`, `reflectvalue`, `kp`, `lp`, `energy`, `procentual`, `procentualcost`, `learnlp`, `learnki`, `learnkp`, `learnattack`, `learndefense`, `accuracy`, `text`, `missText`, `deadText`, `loadtext`, `description`, `transformationid`, `race`, `displayed`, `loadattack`, `npcid`, `loadrounds`, `blockattack`, `blockedattack`, `item`, `minvalue`, `rounds`, `level`, `learntime`, `npcpickable`, `costgenerated`, `displaydied`) VALUES
(292, 'Maschinengewehr', 'maschinengewehr', 1, 300, 0, 100, 0, 0, 0, 0, 0, 125, 0, 2, 0, 0, 0, 0, 0, 0, 0, 20, '!source feuert mit dem Maschinengewehr auf !target und verursacht !type !damage Schaden.', '!source feuert mit dem Maschinengewehr wild umher.', '!source feuert mit dem Maschinengewehr auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 0, 1),
(293, 'Namekianische Fusion', 'namekfuse', 13, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source berührt !target und die Energie von !target wandert zu !source und sie verschmelzen zu einer Person.', '!source berührt !target und will mit !target verschmelzen, es funktioniert jedoch nicht.', '!source berührt !target und die Energie von !target wandert zu !source und sie verschmelzen zu einer Person. Jedoch ist die Person sehr dünn und schwach.', '', 'Der Spieler fusioniert mit dem Ziel.', 0, 'Namekianer', 1, 0, 0, 0, 0, 0, 0, 0, -1, 0, 24, 1, 0, 1),
(294, 'Telepathy', 'telepathy', 18, 25, 0, 0, 0, 100, 100, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source kommuniziert mit dem Team telepathisch und verstärkt so die Zusammenarbeit.', '', '', '', '', 0, 'Kaioshin', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(295, 'Angst', 'angst', 18, -17.5, 0, 0, 0, 100, 100, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source fängt an zu Lachen und die gegnerischen Teams bekommen Angst.', '', '', '', '', 0, 'Freezer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(296, 'Affenschwanz abtrennen', 'cutapetail', 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '!source durchtrennt den Affenschwanz von !target.', '!source will den Affenschwanz von !target durchtrennen, !target weicht jedoch aus.', '!source will den Affenschwanz von !target durchtrennen, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(297, 'Powerball', 'powerball', 14, 4, 0, 0, 0, 0, 0, 0, 0, 2000, 0, 90, 0, 0, 0, 0, 0, 0, 0, 100, '!source erschafft einen leuchtenden Ball in der Hand und wirft ihn in dem Himmel. Dort wird der Ball größer und leuchtet wie ein Mond.', '!source will einen leuchtenden Ball in den Himmel werfen, dort ist jedoch bereits einer.', '', '', 'Ein Ball der so hell leuchtet wie der Mond.', 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(298, 'Mond zerstören', 'destroymoon', 14, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30, 0, 0, 0, 0, 0, 0, 0, 30, '!source schießt einen Energiestrahl in den Himmel, der den Mond zerstört.', '!source schießt einen Energiestrahl in den Himmel, verfehlt jedoch den Mond.', '', '', 'Der Spieler zerstört den Mond.', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(299, 'Saiyajin Power', 'saiyajinpower', 4, 10, 0, 100, 100, 100, 100, 0, 0, 100, 0, 0, 1, 0, 0, 0, 0, 0, 0, 20, '!source erhält durch die vielen Verletzungen einen starken Powerboost.', 'Der Powerboost von !source verschwindet wieder.', '', '', '', 3, 'Saiyajin', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(300, 'Randalieren', 'randale', 1, 1, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source randaliert und schlägt auf !target ein, !target erleidet !type !damage Schaden.', '!source randaliert und zerstört die Umgebung.', '!source randaliert und schlägt auf !target, !target ist jedoch bereits tot.', '', 'Der Spieler randaliert.', 0, '', 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(301, 'Hai-Biss', 'haibiss', 1, 60, 0, 100, 0, 0, 0, 0, 0, 125, 0, 2, 0, 0, 0, 0, 0, 0, 0, 100, '!source beißt !target mit seinen scharfen Zähnen und verursacht !type !damage Schaden.', '!source will !target mit den scharfe Zähnen beißen, !target weicht jedoch aus.', '!source beißt !target mit seinen scharfen Zähnen, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 60, 0, 0, 24, 1, 0, 1),
(302, 'Zertrampeln', 'zertrampeln', 1, 70, 0, 100, 0, 0, 0, 0, 0, 125, 0, 2, 0, 0, 0, 0, 0, 0, 0, 100, '!source zertrampelt !target und verursacht !type !damage Schaden.', '!source will !target zertrampeln, !target weicht jedoch aus.', '!source zertrampelt !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 70, 0, 0, 24, 1, 0, 1),
(303, 'Stinkwolke', 'stinkwolke', 1, 100, 0, 100, 0, 0, 0, 0, 0, 200, 0, 4, 0, 0, 0, 0, 0, 0, 0, 100, '!source verursacht eine Stinkwolke die !target vergiftet und !type !damage Schaden verursacht.', '!source entlässt eine Stinkwolke.', '!source verursacht eine Stinkwolke die !target vergiftet, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(304, 'HellBoost', 'hellboost', 18, 25, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source fängt an zu Lachen und wird von einer Energie aus der Hölle umgeben, die !source stärkt.', '', '', '', '', 0, 'Demon', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(305, 'Maschinengewehre', 'maschinengewehre', 1, 125, 0, 100, 0, 0, 0, 0, 0, 313, 0, 5, 0, 0, 0, 0, 0, 0, 0, 100, '!source feuern mit den Gewehren auf !target und verursachen !type !damage Schaden.', '!source feueren mit den Gewehren wild umher.', '!source feuern mit den Gewehren auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 125, 0, 0, 24, 1, 0, 1),
(306, 'Kunai werfen', 'kunaiwerfen', 1, 150, 0, 100, 0, 0, 0, 0, 0, 375, 0, 6, 0, 0, 0, 0, 0, 0, 0, 100, '!source wirft Kunai auf !target und verursachen !type !damage Schaden.', '!source wirft Kunai, verfehlt jedoch !target.', '!source wirft Kunai auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 150, 0, 0, 24, 1, 0, 1),
(307, 'KP Aufladen', 'kpaufladen', 11, 50, 0, 0, 100, 0, 0, 0, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und regeneriert KP.', '!source konzentriert sich und regeneriert KP.', '!source konzentriert sich und regeneriert KP.', '', 'Der Spieler konzentriert sich und regeneriert seine KP.', 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(308, 'Pistolenschuss', 'pistolenschuss', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source feuert mit der Pistole auf !target und verursachen !type !damage Schaden.', '!source verfehlt !target mit der Pistole.', '!source feuert mit der Pistole auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(309, 'Flammenwerfer', 'flammenwerfer', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source schießt mit den Flammenwerfer auf !target und verursachen !type !damage Schaden.', '!source lässt die Flammen wild umherschlagen.', '!source schießt mit den Flammenwerfer auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(310, 'Würgen', 'wuergen', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source packt !target mit einem Tentakel und würgt !target. !target erleidet !type !damage Schaden.', '!source versucht !target mit einen Tentakel zu packen, schafft es jedoch nicht.', '!source packt !target mit einem Tentakel und würgt !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(311, 'Shotgun', 'shotgun', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source schießt mit der Shotgun auf !target !target erleidet !type !damage Schaden.', '!source schießt mit der Shotgun auf !target, !target weicht jedoch aus.', '!source schießt mit der Shotgun auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(312, 'Kopfnuss', 'kopfnuss', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source springt auf !target zu und trifft !target mit den Kopf. !target erleidet !type !damage Schaden.', '!source springt an !target vorbei.', '!source springt auf !target zu und trifft !target mit den Kopf. !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(313, 'Boxschlag', 'boxschlag', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source schlägt mit dem Boxhandschuhen auf !target ein. !target erleidet !type !damage Schaden.', '!source schlägt mit dem Boxhandschuhen auf !target ein, !target weicht jedoch aus.', '!source schlägt mit dem Boxhandschuhen auf !target ein. !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(314, 'Nachladen', 'nachladen', 11, 50, 0, 0, 100, 0, 0, 0, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source lädt die Waffe nach.', '!source lädt die Waffe nach.', '!source lädt die Waffe nach.', '', 'Der Spieler lädt die Waffe nach.', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(315, 'DinoAusruhen', 'dinoausruhen', 11, 50, 0, 0, 100, 0, 0, 0, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source ruht sich für einen Moment aus.', '!source ruht sich für einen Moment aus.', '!source ruht sich für einen Moment aus.', '', 'Der Spieler ruht sich kurz aus.', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1),
(316, 'Antennen-Strahl', 'antennenstrahl', 1, 10, 0, 100, 0, 0, 0, 0, 0, 200, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source feuern von ihren Antennen einen Strahl auf !target und !target erleidet !type !damage Schaden.', '!source feuern von ihren Antennen einen Strahl auf !target, !target weicht jedoch aus.', '!source feuern von ihren Antennen einen Strahl auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(317, 'Raketen', 'raketen', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source feuert Raketen auf !target. Die Raketen treffen !target und !target erleidet !type !damage Schaden.', '!source feuert Raketen auf !target. Die Raketen fliegen auf !target zu, verfehlen !target jedoch.', '!source feuert Raketen auf !target. Die Raketen fliegen auf !target zu, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(318, 'Starker Pistolenschuss', 'pistolenschuss', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source feuert mit der Pistole auf !target und verursachen !type !damage Schaden.', '!source verfehlt !target mit der Pistole.', '!source feuert mit der Pistole auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(319, 'Bandagenwurf', 'bandagenwurf', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source schießt mit den Bandagen auf !target und verursacht !type !damage Schaden.', '!source verfehlt !target mit den Bandagen.', '!source schießt mit den Bandagen auf !target, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(320, 'Unsichtbarer Schlag', 'unsichtbarerschlag', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!target wird plötzlich von mehreren Seiten geschlagen, ohne dass !source zu sehen ist. !target erleidet !type !damage Schaden.', 'Es passiert nichts.', '!target wird plötzlich von mehreren Seiten geschlagen, ohne dass !source zu sehen ist. !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(321, 'Teufelswelle', 'teufelswelle', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält beide Hände nach vorne und entlässt einen pinken Energiestrahl, der sich ringelt und !target trifft. !target erleidet !type !damage Schaden.', '!source hält beide Hände nach vorne und entlässt einen pinken Energiestrahl, der sich ringelt, jedoch !target verfehlt.', '!source hält beide Hände nach vorne und entlässt einen pinken Energiestrahl, der sich ringelt und !target trifft. !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(322, 'Blutiger Biss', 'blutigerbiss', 12, 10, 0, 100, 0, 0, 0, 0, 0, 400, 0, 8, 1, 0, 0, 0, 0, 0, 0, 100, '!source springt auf !target und beißt !target. !target erleidet !type !damage Schaden und !source heilt sich um einen Anteil des Schadens.', '!source springt auf !target, !target weicht jedoch aus.', '!source springt auf !target und beißt !target. !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 24, 1, 0, 1),
(323, 'Pinball Heal', 'pinball', 11, 50, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, 'Die Kugel von !source rollt.', 'Die Kugel von !source rollt.', 'Die Kugel von !source rollt.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 24, 1, 0, 1),
(324, 'Acht Fäuste', 'achtfaeuste', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source bewegt die Arme so schnell, dass es aussieht, als hätte !source acht Fäuste. Daraufhin greift !source !target mit den Fäusten an und !target erleidet !type !damage Schaden.', '!source bewegt die Arme so schnell, dass es aussieht, als hätte !source acht Fäuste. Daraufhin greift !source !target mit den Fäusten an, !target weicht jedoch aus.', '!source bewegt die Arme so schnell, dass es aussieht, als hätte !source acht Fäuste. Daraufhin greift !source !target mit den Fäusten an, !target ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(325, 'Medium Drain', 'mediumdrain', 12, 20, 0, 100, 0, 0, 0, 0, 0, 800, 0, 13, 1, 0, 0, 0, 0, 0, 0, 100, '!source richtet, mit geöffneten Mund, den Blick auf !target und beginnt Energie von !target zu absorbieren. !target erleidet !type !damage Schaden und !source heilt sich um einen Anteil des Schadens.', '!source richtet, mit geöffneten Mund, den Blick auf !target und beginnt Energie von !target zu absorbieren. !target konnte dem jedoch ausweichen. ', '!source richtet, mit geöffneten Mund, den Blick auf !target und beginnt Energie von !target zu absorbieren. !target ist jedoch bereits tot.', '', 'Der Spieler saugt dem Gegner Energie ab.', 0, '', 1, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(326, 'Medium Heal', 'mediumheal', 5, 4, 0, 100, 0, 0, 0, 0, 0, 800, 0, 12, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand auf den Kopf von !target, konzentriert Energie und heilt !target um !type !damage.', '!source hält eine Hand auf den Kopf von !target, konzentriert Energie und !target weicht aus.', '!source hält eine Hand auf den Kopf von !target und konzentriert Energie, !target ist jedoch tot.', '', 'Der Spieler heilt das Ziel indem er eine Hand auf den Kopf legt.', 0, '', 1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(327, 'Hyper Curse', 'hypercurse', 22, -80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source schaut zu !target und die Augen von !source werden rot. !source belegt !target mit einen sehr starken Fluch, der !target jede Runde schwächt.', '!source schaut zu !target und die Augen von !source werden rot. !source kann !target jedoch nicht mit den sehr starken Fluch belegen.', '', '!target erleidet !type !damage Schaden durch den sehr starken Fluch von !source.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -750, 2, 0, 24, 1, 0, 1),
(328, 'Ultra Curse', 'ultracurse', 22, -100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source schaut zu !target und die Augen von !source werden rot und Blitze entstehen um !source !source belegt !target mit einen extrem starken Fluch, der !target jede Runde schwächt.', '!source schaut zu !target und die Augen von !source werden rot. !source kann !target jedoch nicht mit den extrem starken Fluch belegen.', '', '!target erleidet !type !damage Schaden durch den extrem starken Fluch von !source.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, -1000, 2, 0, 24, 1, 0, 1),
(329, 'Hyper Transfer', 'hypertransfer', 22, 80, 0, 100, 0, 0, 0, 0, 0, 1600, 0, 60, 1, 0, 0, 0, 0, 0, 0, 100, '!source hält eine Hand auf !target wodurch ein sehr hell leuchtender, grüner Nebel auf !target zufliegt der !target heilt.', '!source hält eine Hand auf !target wodurch ein sehr hell leuchtender, grüner Nebel entsteht, den !target jedoch ausweicht.', '', '!target wird um !type !damage Schaden durch den hell., leuchtenden, grünen Nebel von !source geheilt.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 750, 2, 0, 24, 1, 0, 1),
(330, 'Ultra Transfer', 'ultratransfer', 22, 100, 0, 100, 0, 0, 0, 0, 0, 2000, 0, 70, 1, 0, 0, 0, 0, 0, 0, 100, '!source berührt !target, wodurch eine gelbe Aura um !source und !target entsteht und leuchtende Energie um die Beiden entsteht, die !target heilt.', '!source berührt !target, wodurch eine gelbe Aura um !source und !target entsteht und leuchtende Energie um die Beiden entsteht, !target bewegt sich jedoch aus der Aura hinaus.', '', '!target wird um !type !damage Schaden durch die leuchtende Energie von !source geheilt.', '', 0, '', 1, 0, 0, 0, 0, 0, 0, 1000, 2, 0, 24, 1, 0, 1),
(331, 'Schwerthieb', 'schwerthieb', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source rennt auf !target zu und versucht diesen mit seinem Schwert zu schaden. !target wird getroffen und erleidet !type !damage Schaden.', '!source rennt auf !target zu und versucht diesen mit seinem Schwert zu schaden. !target konnte jedoch ausweichen. ', '!source rennt auf !target zu und versucht diesen mit seinem Schwert zu schaden. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Anwender sprinten auf sein Ziel zu und versucht diesen mit seinem Schwert zu schaden. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 0, 1),
(332, 'Elektrische Schockwelle', 'elektrischeschockwelle', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt elektrische Energie in seiner Hand und entfesselt diese auf !target. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source sammelt elektrische Energie in seiner Hand und entfesselt diese auf !target. !target konnte jedoch davon ausweichen. ', '!source sammelt elektrische Energie in seiner Hand und entfesselt diese auf !target. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender sammelt elektrische Energie in seiner Hand und entfesselt diese auf sein Ziel.', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(333, 'Ausruhen', 'ausruhen', 11, 50, 0, 0, 100, 0, 0, 0, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source ruht sich aus und tankt wieder Energie.', '!source ruht sich aus und tankt wieder Energie.', '!source ruht sich aus und tankt wieder Energie.\r\n', '', 'Der Anwender ruht sich aus und tankt wieder Energie.', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(334, 'Super Energiestrahl', 'superenergiestrahl', 1, 30, 0, 100, 0, 0, 0, 0, 0, 600, 0, 5, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert Energie in seinem Mund und feuert diese auf !target ab. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert Energie in seinem Mund und feuert diese auf !target ab. !target konnte jedoch ausweichen. ', '!source konzentriert Energie in seinem Mund und feuert diese auf !target ab. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Anwender konzentriert Energie in seinem Mund und feuert diese auf sein Ziel ab.', 0, '', 0, 0, 0, 0, 0, 0, 0, 300, 0, 0, 24, 1, 0, 1),
(335, 'Anrempeln ', 'anrempeln', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source stürmt auf !target los und rempelt diesen an. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source stürmt auf !target los und versucht diesen anzurempeln. !target konnte jedoch davon ausweichen. ', '!source stürmt auf !target los und rempelt diesen an. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender stürmt auf sein Ziel zu und rempelt dieses an. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(336, 'Schlag-Tritt-Kombo', 'schlagtrittkombo', 1, 20, 0, 100, 0, 0, 0, 0, 0, 400, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source stürmt auf !target zu und entfesselt eine Kombination aus Schlägen und Tritten. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source stürmt auf !target zu und entfesselt eine Kombination aus Schlägen und Tritten. !target konnte jedoch davon ausweichen. ', '!source stürmt auf !target zu und entfesselt eine Kombination aus Schlägen und Tritten. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender stürmt auf sein Ziel zu und entfesselt eine Kombination aus Schlägen und Tritten.', 0, '', 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 24, 1, 0, 1),
(337, 'Saibaman Explosion', 'saibamanbomb', 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, '!source explodiert.', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(338, 'Bananas fangen', 'bananasfangen', 15, 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, '!source fängt !target.', '!source konnte !target nicht fangen.', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1),
(339, 'Gregory Hit', 'gregoryhit', 1, 1e25, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, '!source trifft !target mit dem Hammer.', '!source konnte !target nicht treffen.', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1),
(340, 'Gregory Taunt', 'gregorytaunt', 9, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 80, '!source versucht !target zu provozieren. !target fällt darauf herein und rennt !source blind hinterher. ', '!source versucht !target zu provozieren. !target ignoriert den Spott einfach. ', '!source versucht !target zu provozieren. !target fällt darauf herein, ist jedoch bereits schon tot. ', '', 'Der Anwender verspottet sein Ziel. ', 0, '', 0, 341, 0, 0, 0, 0, 0, 30, 0, 0, 24, 0, 0, 1),
(341, 'Verspottet', 'taunted', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source verfolgt Blind das Ziel. ', '!source hat sich wieder beruhigt. ', '', '', '', 0, '', 0, 340, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(342, 'Bananen-Wurf', 'bananasstun', 9, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 80, '!source wirft mit einer Bananenschale auf !target. !target konnte dieser nicht ausweichen und rutscht darauf aus.', '!source wirft mit einer Bananenschale auf !target. !target konnte dieser ausweichen.', '!source wirft mit einer Bananenschale auf !target. !target konnte dieser nicht ausweichen und rutscht darauf aus, ist jedoch bereits schon tot.', '', 'Der Anwender wirft mit einer Bananenschale auf sein Zeil.', 0, '', 0, 343, 0, 0, 0, 0, 0, 30, 0, 0, 24, 0, 0, 1),
(343, 'Ausgerutscht', 'ausgerutscht', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source liegt betäubt auf den Boden. ', '!source kann wieder aufstehen. ', '', '', '', 0, '', 0, 342, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(344, 'Höllenspirale (1HKO)', 'hoellenspirale', 1, 1000000, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert eine gewaltige Menge an Energie auf seinen Fingerspitzen und feuert diese in Form einer Spirale auf !target ab.', '!source konzentriert eine gewaltige Menge an Energie auf seinen Fingerspitzen und feuert diese in Form einer Spirale auf !target ab, welche jedoch verfehlt.', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(345, 'Doppelsonntag', 'doppelsonntag', 1, 45, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und lädt zwei lila Energiekugeln auf, welche gleichzeitig als Energiestrahlen auf !target zufliegen. !target wird getroffen und erleidet !type !damage Schaden.', '!source konzentriert sich und lädt zwei lila Energiekugeln auf, welche gleichzeitig als Energiestrahlen auf !target zufliegen. !target weicht den Strahlen jedoch aus.', '!source konzentriert sich und lädt zwei lila Energiekugeln auf, welche gleichzeitig als Energiestrahlen auf !target zufliegen. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Anwender konzentriert sich und lädt zwei Energiekugeln auf, welche er gleichzeitig als Energiestrahl auf sein Ziel abfeuert. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(346, 'Böser Blick', 'boeserblick', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird wütend und starrt !target finster an. !target wird vom Blick beeinflusst und erleidet !type !damage Schaden.', '!source wird wütend und starrt !target finster an. !target lässt sich davon nicht beeindrucken. ', '!source wird wütend und starrt !target finster an. !target wird vom Blick beeinflusst, ist jedoch bereits tot.', '', 'Der Anwender ist wütend und starrt sein Ziel böse an. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(347, 'Säure-Angriff', 'saibamansäure', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source öffnet seinen Schädel und feuert eine Ladung Säure auf !target ab. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source öffnet seinen Schädel und feuert eine Ladung Säure auf !target ab. !target konnte jedoch ausweichen.', '!source öffnet seinen Schädel und feuert eine Ladung Säure auf !target ab. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender öffnet seinen Schädel und feuert eine Ladung Säure auf sein Ziel ab. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(348, 'Super Galick Blaster', 'supergalickblaster', 1, 50, 0, 100, 0, 0, 0, 0, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source öffnet seinen Mund und feuert einen riesigen pinken Energiestrahl ab. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source öffnet seinen Mund und feuert einen riesigen pinken Energiestrahl ab. !target konnte dem jedoch ausweichen.', '!source öffnet seinen Mund und feuert einen riesigen pinken Energiestrahl ab. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender öffnet seinen Mund und feuert einen riesigen pinken Energiestrahl auf sein Ziel ab. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 500, 0, 0, 24, 0, 0, 1),
(349, 'Bananas Sprint', 'bananassprint', 1, 35, 0, 100, 0, 0, 0, 0, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source nimmt Anlauf und sprintet !target an. !target wird getroffen und erleidet !type !damage Schaden.', '!source nimmt Anlauf und sprintet !target an. !target konnte davon jedoch ausweichen.', '!source nimmt Anlauf und sprintet !target an. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Anwender nimmt Anlauf und sprintet sein Ziel an. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 350, 0, 0, 24, 1, 0, 1),
(350, 'Riesiger Sturm', 'großersturm', 1, 45, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source hebt seine rechte Hand und streckt zwei Finger aus, konzentriert sich und entfesselt eine riesige Explosionswelle. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source hebt seine rechte Hand und streckt zwei Finger aus, konzentriert sich und entfesselt eine riesige Explosionswelle. !target konnte dem jedoch ausweichen.', '!source hebt seine rechte Hand und streckt zwei Finger aus, konzentriert sich und entfesselt eine riesige Explosionswelle. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender hebt seine rechte Hand und streckt zwei Finger aus, konzentriert sich und entfesselt eine riesige Explosionswelle.', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(351, 'Super Galick Beam', 'supergalickbeam', 1, 45, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und umhüllt sich selbst mit einer lila Energie, welche er auf !target abfeuert. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source konzentriert sich und umhüllt sich selbst mit einer lila Energie, welche er auf !target abfeuert. !target konnte dem jedoch ausweichen.', '!source konzentriert sich und umhüllt sich selbst mit einer lila Energie, welche er auf !target abfeuert. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender konzentriert sich und umhüllt sich selbst mit einer lila Energie, welche er auf sein Ziel abfeuert.', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(352, 'Keulenschwung', 'keulenschwung', 1, 55, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 80, '!source holt mir einer gigantischen Keule aus und versucht !target damit zu treffen. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source holt mir einer gigantischen Keule aus und versucht !target damit zu treffen. !target konnte dem  jedoch rechtzeitig noch ausweichen. ', '!source holt mir einer gigantischen Keule aus und versucht !target damit zu treffen. !target wird davon getroffen, ist jedoch bereits schon tot.', '', 'Der Anwender holt mit einer gigantischen Keule aus und versucht sein Ziel damit zu treffen. ', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(353, 'BombStrike', 'bombstrikeneu', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source umhüllt sich mit einer roten Aura und stürmt auf !target zu. !target wird von einem heftigen Schlag getroffen und erhällt !type !damage Schaden.', '!source umhüllt sich mit einer roten Aura und stürmt auf !target zu. !target konnte jedoch ausweichen.', '!source umhüllt sich mit einer roten Aura und stürmt auf !target zu. !target wird von einem heftigen Schlag getroffen. !target ist jedoch bereits tot.', '', 'Der Anwender umhüllt sich mit roter Energie und stürmt auf den Gegner zu.', 0, '', 0, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(355, 'Lord Freezer', 'lordfreezer', 9, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 100, ' !source schaut schockiert hinter !target und täuscht vor als wäre ein mächtiger Feind hinter !target. !target kann sich nicht auf den Kampf konzentrieren.', '', '!source versucht !target zu provozieren. !target fällt darauf herein, ist jedoch bereits schon tot.', '', 'Der Anwender verspottet sein Ziel. ', 0, '', 0, 356, 0, 0, 0, 0, 0, 30, 0, 0, 24, 0, 0, 1),
(356, 'Verspottet', 'lordfreezerneu', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source kann sich noch nicht konzentrieren.', '!source kann sich wieder konzentrieren', '', '', '', 0, '', 0, 340, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(357, 'MaximumBuster', 'maximumbuster', 1, 110, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt eine Menge Energie zwischen seinen Händen. !source schleudert einen gelben Energiestrahl auf !target. !target erhält !type !damage Schaden.', '!source sammelt eine Menge Energie zwischen seinen Händen. !source schleudert einen gelben Energiestrahl auf !target. !target konnte jedoch ausweichen.', '!source sammelt eine Menge Energie zwischen seinen Händen. !source schleudert einen gelben Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Anwender sammelt Energie zwischen seinen Händen und schleudert einen gelben Energiestrahl auf sein Ziel', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(358, 'DodoriaHeadButt', 'dodoriaheadbut', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source stürmt auf !target frontal zu. !target wird von !source Kopf getroffen und seinen Stacheln durchbohrt. !target erhält !type !damage Schaden.', '!source stürmt auf !target frontal zu. !target konnte jedoch ausweichen.', '!source stürmt auf !target frontal zu. !target wird von !source Kopf getroffen und seinen Stacheln durchbohrt.  !target ist jedoch bereits tot.', '', 'Der Anwender stürmt auf sein Ziel zu um es mit seinen Kopfstacheln zu durchbohren.', 0, '', 0, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(359, 'Eleganter Schuss', 'eleganterschuss', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source richtet einen Arm nach vorne und schleudert einen gelben Energiestrahl auf !target. !target wird getroffen und erhält !type !damage Schaden.', '!source richtet einen Arm nach vorne und schleudert einen gelben Energiestrahl auf !target. !target konnte jedoch ausweichen.', '!source richtet einen Arm nach vorne und schleudert einen gelben Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Anwender feuert einen massiven, gelben Energiestrahl auf sein Ziel.', 0, '', 0, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(360, 'Zarbon Monster Form', 'zarbonmonster', 4, 200, 0, 100, 100, 100, 100, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, '!source wird wütend. !source spannt seinen Körper an und mutiert zu einem Monster.', '', '', '', '', 1, '', 1, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 24, 1, 0, 1),
(361, 'ZarbonAutoLose', 'zarbonmonster', 1, 1000000000000, 0, 100, 0, 2147483647, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, '!target erstarrt vor !source neuer Kraft. !target ergreift die Flucht.', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(362, 'MonsterCrush', 'monstercrush', 1, 125, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source packt !target und fliegt mit !target in die Luft. !source rammt !target in einer spiralförmigen Drehung in den Boden. !target erhält !type !damage Schaden.', '!source packt !target und fliegt mit !target in die Luft. !target konnte sich aus dem Angriff befreien.', '!source packt !target und fliegt mit !target in die Luft. !source rammt !target in einer spiralförmigen Drehung in den Boden. !target ist jedoch bereits tot.', '', 'Ein von Zarbon genutzter Piledriver der sein Ziel in den Boden rammt.', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(363, 'Zeitstopp', '', 9, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und stoppt die Zeit um !target.', '', '!source konzentriert sich und versucht die Zeit um !target zu stoppen. !target ist bereits tot.', '', 'Der Anwender verspottet sein Ziel. ', 0, '', 0, 364, 0, 0, 0, 0, 0, 30, 0, 0, 24, 0, 0, 1),
(364, 'gestoppte Zeit', '', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '!source ist noch in der Zeit eingefroren.', '!source kann sich wieder bewegen.', '', '', '', 0, '', 0, 363, 0, 0, 0, 0, 0, 10, 0, 0, 24, 1, 0, 1),
(365, 'Baumwurf', '', 1, 40, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source konzentriert sich und reist per Telekinese einen Baum aus dem Boden. !source schleudert den Baum auf !target. !target erhält !type !damage Schaden.', '!source konzentriert sich und reist per Telekinese einen Baum aus dem Boden. !source schleudert den Baum auf !target. Konnte jedoch ausweichen.', '!source konzentriert sich und reist per Telekinese einen Baum aus dem Boden. !source schleudert den Baum auf !target. !target ist jedoch bereits tot.', '', 'Der Anwender feuert einen massiven, gelben Energiestrahl auf sein Ziel.', 0, '', 0, 0, 0, 0, 0, 0, 0, 400, 0, 0, 24, 1, 0, 1),
(366, 'Rikuum Eraser Gun', 'erasergun', 1, 110, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt eine Menge Energie in seinem Mund. !source feuert einen violetten Energiestrahl auf !target. !target erhält !type !damage Schaden.', '!source sammelt eine Menge Energie in seinem Mund. !source schleudert einen violetten Energiestrahl auf !target. !target konnte jedoch ausweichen.', '!source sammelt eine Menge Energie in seinem Mund. !source schleudert einen violetten Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Anwender sammelt Energie in seinem Mund und schleudert einen violetten Energiestrahl auf sein Ziel', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(367, 'Rikuum Fighting Bomber', 'fightingbomber', 1, 165, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt eine Menge Energie, die seinen Körper vollständig umhüllt. !source ruft \"Rikuum... Fighting.. BOMBER!\" und feuert einen violetten Energiestrahl auf !target. !target erhält !type !damage Schaden.', '!source sammelt eine Menge Energie, die seinen Körper vollständig umhüllt. !source ruft \"Rikuum... Fighting.. BOMBER!\" und feuert einen violetten Energiestrahl auf !target. !target konnte jedoch ausweichen.', '!source sammelt eine Menge Energie, die seinen Körper vollständig umhüllt. !source ruft \"Rikuum... Fighting.. BOMBER!\" und feuert einen violetten Energiestrahl auf !target. !target ist jedoch bereits tot.', '', 'Der Anwender eine Menge Energie, die seinen Körper vollständig umhüllt und feuert einen violetten Energiestrahl auf sein Ziel', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(368, 'Crusher Ball', '', 1, 165, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt eine Menge Energie in seiner Linken Hand und erschafft eine Kugel. !source schlägt die Kugel mit der rechten Hand in Richtung von !target. !target erhält !type !damage Schaden.', '!source sammelt eine Menge Energie in seiner Linken Hand und erschafft eine Kugel. !source schlägt die Kugel mit der rechten Hand in Richtung von !target.  !target konnte jedoch ausweichen.', '!source sammelt eine Menge Energie in seiner Linken Hand und erschafft eine Kugel. !source schlägt die Kugel mit der rechten Hand in Richtung von !target.  !target ist jedoch bereits tot.', '', 'Der Anwender eine Menge Energie, die seinen Körper vollständig umhüllt und feuert einen violetten Energiestrahl auf sein Ziel', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(369, 'Milky Cannon', '', 1, 175, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source streckt seine Hand nach vorne und sammelt eine enorme Menge an Energie. !source zeigt mit der Hand auf !target und setzt die gesammelte Energie frei. !target erhält !type !damage Schaden.', '!source streckt seine Hand nach vorne und sammelt eine enorme Menge an Energie. !source zeigt mit der Hand auf !target und setzt die gesammelte Energie frei.  !target konnte jedoch ausweichen.', '!source streckt seine Hand nach vorne und sammelt eine enorme Menge an Energie. !source zeigt mit der Hand auf !target und setzt die gesammelte Energie frei.!target ist jedoch bereits tot.', '', 'Der Anwender eine Menge Energie, die seinen Körper vollständig umhüllt und feuert einen violetten Energiestrahl auf sein Ziel', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(370, 'Blue Hurricane', '', 1, 165, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source umhüllt sich mit Blauer Energie. !source stürzt sich auf !target und zerstört dabei alles, was ihm im Weg steht. !target erhält !type !damage Schaden.', '!source umhüllt sich mit Blauer Energie. !source stürzt sich auf !target und zerstört dabei alles, was ihm im Weg steht. !target konnte jedoch ausweichen.', '!source umhüllt sich mit Blauer Energie. !source stürzt sich auf !target und zerstört dabei alles, was ihm im Weg steht. !target ist jedoch bereits tot.', '', 'Der Anwender eine Menge Energie, die seinen Körper vollständig umhüllt und feuert einen violetten Energiestrahl auf sein Ziel', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(371, 'Body Swap', '', 16, 1, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source sammelt eine große Menge an Energie. !source streckt die Arme in die Luft und ruft \"ES GESCHEHE\". !source tauscht mit !target den Körper.', '-', '-', '', '-', 0, '', 0, 0, 0, 0, 0, 0, 0, 600, 0, 0, 24, 1, 0, 1),
(372, 'Doppel-Energiestrahl', 'DoppelEnergiestrahl', 1, 45, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source feuert zwei gebündelte Energiestrahle aus seinen Händen ab, die auf !target zurasen.!target wird voll getroffen und erleidet !type !damage Schaden.', '!source feuert zwei gebündelte Energiestrahle aus seinen Händen ab, die auf !target zurasen.!target wich diesen jedoch gerade so aus.', '!source feuert zwei gebündelte Energiestrahle aus seinen Händen ab, die auf !target zurasen.!target wird voll getroffen, ist jedoch bereits tot.', '', 'Der Anwender feuert zwei gebündelte Energiestrahle aus seinen Händen ab, welche auf sein Ziel zurasen.', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(373, 'Schweifhieb', 'Schwanzhiebo', 1, 45, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source holt mit seinem riesigen Schweif aus und versucht !target zu treffen. !target wird getroffen und erleidet !type !damage Schaden.', '!source holt mit seinem riesigen Schweif aus und versucht !target zu treffen. !target konnte jedoch ausweichen.', '!source holt mit seinem riesigen Schweif aus und versucht !target zu treffen. !target wird getroffen, ist jedoch bereits tot.', '', 'Der Anwender holt mit seinem Schweif aus.', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(374, 'CC Schlagen', 'ccschlag', 1, 5, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 100, 'HIT !damage', 'MISS', '!source tötet !target und veruracht !damage Schaden', '', 'CC Test Faust', 0, '', 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 1, 1, 1),
(375, 'Auge des Sturms', 'sturmauge', 1, 45, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source wirbelt kräftig herum. !target gerät in den Sog und kann nicht mehr entfliehen. !target fällt benommen aus großer Höhe auf dem Boden und erleidet !type !damage Schaden.', '!source wirbelt kräftig herum und versucht !target in den Sog zu ziehen. !target konnte jedoch ausweichen.', '!source wirbelt kräftig herum. !target gerät in den Sog und kann nicht mehr entfliehen. !target fällt benommen aus großer Höhe auf dem Boden, ist jedoch bereits tot.', '', '.', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(376, 'Wirbelwind', 'wirbelwind', 1, 45, 0, 100, 0, 0, 0, 0, 0, 1000, 0, 10, 1, 0, 0, 0, 0, 0, 0, 90, '!source wirbelt Unmengen an gefährlichen Gegenständen aus der Wüste auf !target. !target wird von mehreren Steinen und vertrockneten Bäumen getroffen und erleidet !type !damage Schaden.', '!source wirbelt Unmengen an gefährlichen Gegenständen aus der Wüste auf !target. !target konnte diesen Gegenständen jedoch ausweichen. ', '!source wirbelt Unmengen an gefährlichen Gegenständen aus der Wüste auf !target. !target wird von mehreren Steinen und vertrockneten Bäumen getroffen, ist jedoch bereits tot.', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1),
(377, 'Flügelschlag', 'flugelschlag', 1, 45, 0, 100, 0, 0, 0, 0, 0, 800, 0, 10, 1, 0, 0, 0, 0, 0, 0, 100, '!source schlägt mit seinen riesigen Flügeln in Richtung !target. !target wird davon getroffen und erleidet !type !damage Schaden.', '!source schlägt mit seinen riesigen Flügeln in Richtung !target. !target konnte dem Flügelschlag jedoch ausweichen.', '!source schlägt mit seinen riesigen Flügeln in Richtung !target. !target wird davon getroffen, ist jedoch bereits tot.', '', 'Der Anwender schlägt mit seinen riesigen Flügeln auf sein Ziel.', 0, '', 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 24, 1, 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chatmessages`
--

CREATE TABLE `chatmessages` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `acc` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `time` datetime NOT NULL,
  `channel` varchar(30) NOT NULL,
  `fight` int(11) NOT NULL,
  `team` int(2) NOT NULL,
  `arank` int(2) NOT NULL,
  `titel` varchar(30) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `clans`
--

CREATE TABLE `clans` (
  `id` int(11) NOT NULL,
  `name` varchar(90) CHARACTER SET latin1 NOT NULL,
  `tag` varchar(4) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `text` longtext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `banner` varchar(255) CHARACTER SET latin1 NOT NULL,
  `points` int(11) NOT NULL,
  `leader` int(11) NOT NULL,
  `members` int(4) NOT NULL,
  `coleader` int(11) NOT NULL,
  `zeni` varchar(255) CHARACTER SET latin1 NOT NULL,
  `rules` longtext CHARACTER SET latin1 NOT NULL,
  `requirements` longtext CHARACTER SET latin1 NOT NULL,
  `memberki` int(90) NOT NULL,
  `rang` int(11) NOT NULL,
  `log` longtext CHARACTER SET latin1 NOT NULL,
  `shoutbox` longtext CHARACTER SET latin1 NOT NULL,
  `Planet` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dragonballs`
--

CREATE TABLE `dragonballs` (
  `id` int(11) NOT NULL,
  `planet` varchar(90) NOT NULL,
  `place` varchar(90) NOT NULL,
  `player` int(11) NOT NULL,
  `stars` int(2) NOT NULL,
  `wishes` int(2) NOT NULL,
  `activetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `dragonballs`
--

INSERT INTO `dragonballs` (`id`, `planet`, `place`, `player`, `stars`, `wishes`, `activetime`) VALUES
(1, 'Erde', 'Die Pilzstadt', 0, 1, 1, '2020-10-30 18:00:00'),
(2, 'Erde', 'Ebene', 0, 2, 1, '2020-10-30 18:00:00'),
(3, 'Erde', 'Pinguinhausen', 0, 3, 1, '2020-10-30 18:00:00'),
(4, 'Erde', 'Wüsten-Stützpunkt', 0, 4, 1, '2020-10-30 18:00:00'),
(5, 'Erde', 'Das Verlassene Dorf', 0, 5, 1, '2020-10-30 18:00:00'),
(6, 'Erde', 'Unterwasser', 0, 6, 1, '2020-10-30 18:00:00'),
(7, 'Erde', 'Wüste', 0, 7, 1, '2020-10-30 18:00:00'),
(8, 'Namek', 'Inselgruppe', 0, 1, 1, '2020-08-09 18:00:00'),
(9, 'Namek', 'Inselgruppe', 0, 2, 1, '2020-08-09 18:00:00'),
(10, 'Namek', 'Inselgruppe', 0, 3, 1, '2020-08-09 18:00:00'),
(11, 'Namek', 'Inselgruppe', 0, 4, 1, '2020-08-09 18:00:00'),
(12, 'Namek', 'Inselgruppe', 0, 5, 1, '2020-08-09 18:00:00'),
(13, 'Namek', 'Inselgruppe', 0, 6, 1, '2020-08-09 18:00:00'),
(14, 'Namek', 'Inselgruppe', 0, 7, 1, '2020-08-09 18:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `image` varchar(255) NOT NULL,
  `minplayers` int(2) NOT NULL,
  `maxplayers` int(2) NOT NULL,
  `fights` longtext NOT NULL,
  `item` longtext NOT NULL,
  `dropchance` int(11) NOT NULL,
  `zeni` int(11) NOT NULL,
  `placeandtime` longtext NOT NULL,
  `dailyreset` tinyint(1) NOT NULL,
  `winable` int(10) NOT NULL,
  `finishedplayers` longtext NOT NULL,
  `begin` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `decreasenpcfight` tinyint(1) NOT NULL,
  `isdungeon` tinyint(1) NOT NULL,
  `schedule` longtext NOT NULL,
  `difficulty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `name`, `image`, `minplayers`, `maxplayers`, `fights`, `item`, `dropchance`, `zeni`, `placeandtime`, `dailyreset`, `winable`, `finishedplayers`, `begin`, `end`, `decreasenpcfight`, `isdungeon`, `schedule`, `difficulty`) VALUES
(1, 'Adjutant Black', 'black', 1, 4, '74;1;0;0;0;0;0;0@75;1;0;0;0;0;0;0', '147;148;149', 50, 0, 'Erde;RR-Hauptquartier;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(2, 'Tiger Angriff', 'tiger', 1, 4, '1;1;0;0;0;0;0;0@1;1;0;0;0;0;0;0@1;1;0;0;0;0;0;0', '14;15;16;17', 50, 0, 'Erde;Wald;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 50),
(3, 'Pterodactyl Wahnsinn', 'pterodactyl', 1, 4, '2;1;0;0;0;0;0;0@2;1;0;0;0;0;0;0@2;1;0;0;0;0;0;0', '19;20;21;22;23', 50, 0, 'Erde;Ebene;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 50),
(4, 'Zerstört es nicht!', 'auto', 1, 4, '6;1;1;50;0;0;0;0', '', 100, 1000, 'Erde;Hütte;2:4:6;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 0, 0, 'Findet jede Woche am Dienstag, Donnerstag und Samstag statt.', 100),
(5, 'Diebstahl', 'diebstahl', 1, 4, '3;1;0;0;0;0;0;0@3;1;0;0;0;0;0;0@3;1;0;0;0;0;0;0', '24;25;26;27;41', 50, 0, 'Erde;Bergweg;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 50),
(6, 'Pilafs Herausforderung', 'pilafherausforderung', 1, 4, '19;1;0;0;0;0;0;0@18;1;0;0;0;0;0;0@17;1;0;0;0;0;0;0', '50;49;48;47;46', 50, 0, 'Erde;Prinz Pilafs Schloss;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 50),
(7, 'Die Wüstenbanditen', 'wuestenbanditen', 1, 4, '9;1;0;0;0;0;0;0@8;1;0;0;0;0;0;0', '51;52;53;54;76', 50, 0, 'Erde;Wüste;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(8, 'Die Trainingsinsel Prüfung', 'trainingsinsel', 1, 4, '52;1;0;0;0;0;0;0@53;1;0;0;0;0;0;0@10;1;0;0;0;0;0;0', '83;84;85', 50, 0, 'Erde;Trainingsinsel;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 50),
(10, 'Die Endrunden beginnen', 'endrunden', 1, 4, '56;1;0;0;0;0;0;0@57;1;0;0;0;0;0;0', '89;90;91;92', 50, 0, 'Erde;Papayainsel;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(11, 'Der lilane Ninja', 'ninjalila', 1, 4, '61;1;0;0;0;0;0;0@62;1;0;0;0;0;0;0', '108;109;110;111;112;191', 50, 0, 'Erde;Muskelturm;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(12, 'General Blue', 'blue', 1, 4, '66;1;0;0;0;0;0;0@67;1;0;0;0;0;0;0', '125;126;127;128;192', 50, 0, 'Erde;Piratenhöhle;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(13, 'Oozaru Angriff', 'oozaru', 1, 4, '72;1;0;0;0;0;0;0', '184', 50, 0, 'Erde;Prinz Pilafs Schloss;1;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 0, 0, 'Findet jede Woche am Montag statt.', 100),
(14, 'Red Ribbon Armee', 'rrarmee', 1, 4, '60;1;0;0;0;0;0;0@60;1;0;0;0;0;0;0@60;1;0;0;0;0;0;', '', 100, 9000, 'Erde;Jingledorf;5;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 0, 0, 'Findet jede Woche am Freitag statt.', 50),
(15, 'Piraten Roboter', 'piraten-roboter', 1, 4, '65;1;0;0;0;0;0;0@65;1;0;0;0;0;0;0', '184', 50, 0, 'Erde;Piratenhöhle;3;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 0, 0, 'Findet jede Woche am Mittwoch statt.', 75),
(16, 'Arale', 'arale', 1, 4, '68:73;1;0;0;0;0;0;0', '129;130;131;132', 50, 0, 'Erde;Pinguinhausen;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(17, 'Senzu Jagd', 'korin', 1, 4, '25;1;0;0;0;0;0;0', '102', 50, 0, 'Erde;Quittenturm;7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 0, 0, 'Findet jeden Sonntag statt.', 100),
(18, 'Tao BaiBai', 'tao', 1, 4, '71;1;0;0;0;0;0;0', '133;134;135;136', 50, 0, 'Erde;Quittenwald;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 100),
(19, 'Kranichschule', 'kranichschule', 1, 4, '85;1;0;0;0;0;0;0@86;1;0;0;0;0;0;0', '151;152;153;193', 50, 0, 'Erde;Papayainsel;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(20, 'Babas Herausforderung', 'babadungeon', 1, 4, '77;1;0;0;0;0;0;0@76;1;0;0;0;0;0;0', '155;156;157;154;158', 50, 0, 'Erde;Uranai Babas Palast;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(24, 'Der alte Tyrann', 'deraltetyrann', 1, 4, '94;1;0;0;0;0;0;0@90;1;0;0;0;0;0;0', '159;160;161', 50, 0, 'Erde;Yajirobis Prärie;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 75),
(26, 'Der Piccolo Clan', 'derpiccoloclan', 1, 4, '89;1;0;0;0;0;0;0@92:94;1;0;0;0;0;0;0@90;1;0;0;0;0;0;@93;1;0;0;0;0;0;0', '185', 75, 0, 'Erde;King Castle;5;1-31;1-12;1-365;2018-2400', 1, 10, '1993@10;2127@10;2427@10;1775@1;1720@3', '', '', 0, 0, 'Findet jede Woche am Freitag statt.', 25),
(28, 'Ein teuflisches Finale', 'dasfinale', 1, 4, '99;1;0;0;0;0;0;0', '186;189;187;188', 50, 0, 'Erde;Papayainsel;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 100),
(29, 'Der Fremde aus dem All', 'radditzdng', 1, 4, '103;1;0;0;0;0;0;0', '199;200;202;201', 50, 0, 'Erde;Wildnis;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 100),
(30, 'Der Prinz der Saiyajins', 'vegetadng', 1, 4, '110;1;0;0;0;0;0;0', '206;208;207;209;210', 50, 0, 'Erde;Gizard-Ödnis;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 1, 1, '', 100),
(31, 'Enmas Baum', 'enmasbaum', 1, 4, '111;1;0;0;0;0;0;0@112;1;0;0;0;0;0;0', '204', 50, 0, 'Jenseits;Check-In Station;7;1-31;1-12;1-365;2018-2400', 1, 10, '', '', '', 0, 0, 'Findet jede Woche am Sonntag statt.', 75),
(32, 'Oolong das Schwein', 'oolong', 1, 4, '48;1;0;0;0;0;0;@12;1;0;0;0;0;0;@13;1;0;0;0;0;0;', '42;43;44', 50, 0, 'Erde;Das Verlassene Dorf;1:2:3:4:5:6:7;1-31;1-12;1-365;2018-2050', 1, 10, '', '', '', 1, 1, '', 50);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fighters`
--

CREATE TABLE `fighters` (
  `id` int(11) NOT NULL,
  `acc` int(11) NOT NULL,
  `npc` int(11) NOT NULL,
  `fusedacc` int(11) NOT NULL,
  `fight` int(11) NOT NULL,
  `team` int(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `charimage` varchar(255) NOT NULL,
  `ki` int(11) NOT NULL,
  `mki` int(11) NOT NULL,
  `lp` varchar(255) NOT NULL,
  `mlp` varchar(255) NOT NULL,
  `kp` varchar(255) NOT NULL,
  `mkp` varchar(255) NOT NULL,
  `attack` varchar(255) NOT NULL,
  `mattack` varchar(255) NOT NULL,
  `defense` varchar(255) NOT NULL,
  `mdefense` varchar(255) NOT NULL,
  `accuracy` int(10) NOT NULL,
  `maccuracy` int(10) NOT NULL,
  `reflex` int(10) NOT NULL,
  `mreflex` int(10) NOT NULL,
  `action` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `previoustarget` int(11) NOT NULL,
  `attacks` longtext NOT NULL,
  `isnpc` tinyint(1) NOT NULL,
  `lastaction` datetime NOT NULL,
  `transformations` longtext NOT NULL,
  `ilp` int(10) NOT NULL,
  `ikp` int(10) NOT NULL,
  `menergy` int(3) NOT NULL,
  `energy` int(3) NOT NULL,
  `loadattack` int(11) NOT NULL,
  `loadvalue` int(10) NOT NULL,
  `owner` int(11) NOT NULL,
  `paralyzed` int(3) NOT NULL,
  `inactive` tinyint(1) NOT NULL,
  `loadrounds` int(2) NOT NULL,
  `inventory` longtext NOT NULL,
  `npccontrol` tinyint(4) NOT NULL,
  `buffs` longtext NOT NULL,
  `dots` longtext NOT NULL,
  `race` varchar(30) NOT NULL,
  `apetail` int(2) NOT NULL,
  `apecontrol` int(1) NOT NULL,
  `fusetimer` int(3) NOT NULL,
  `majincounter` int(2) NOT NULL,
  `kicktimer` int(11) NOT NULL,
  `taunt` int(11) NOT NULL,
  `reflect` int(3) NOT NULL,
  `patterns` longtext NOT NULL,
  `attackcode` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fights`
--

CREATE TABLE `fights` (
  `id` int(10) NOT NULL,
  `type` int(2) NOT NULL,
  `place` varchar(90) NOT NULL,
  `planet` varchar(90) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `mode` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `round` int(4) NOT NULL DEFAULT 1,
  `text` longtext NOT NULL,
  `levelup` tinyint(1) NOT NULL,
  `zeni` int(10) NOT NULL,
  `items` longtext NOT NULL,
  `gainaccs` longtext NOT NULL,
  `story` int(10) NOT NULL,
  `challenge` int(11) NOT NULL,
  `survivalteam` int(2) NOT NULL,
  `survivalrounds` int(4) NOT NULL,
  `npcid` int(4) NOT NULL,
  `npcmode` varchar(10) NOT NULL,
  `event` int(11) NOT NULL,
  `eventfight` int(3) NOT NULL DEFAULT 0,
  `healing` tinyint(1) NOT NULL,
  `tournament` int(11) NOT NULL,
  `dragonball` int(11) NOT NULL,
  `weather` int(2) NOT NULL,
  `survivalwinner` int(2) NOT NULL,
  `healthratio` int(3) NOT NULL,
  `healthratioteam` int(2) NOT NULL,
  `healthratiowinner` int(2) NOT NULL,
  `debuglog` longtext NOT NULL,
  `fighters` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `statsid` int(11) NOT NULL,
  `visualid` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `equipped` int(11) NOT NULL,
  `statstype` int(2) NOT NULL,
  `upgrade` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `id` int(30) NOT NULL,
  `name` longtext CHARACTER SET utf8 NOT NULL,
  `category` int(2) NOT NULL,
  `image` varchar(30) NOT NULL,
  `description` longtext NOT NULL,
  `price` int(10) NOT NULL,
  `type` int(2) NOT NULL,
  `lp` int(50) NOT NULL,
  `kp` int(50) NOT NULL,
  `attack` int(10) NOT NULL,
  `defense` int(10) NOT NULL,
  `value` int(11) NOT NULL,
  `slot` int(2) NOT NULL,
  `travelbonus` int(3) NOT NULL,
  `equippedimage` varchar(255) NOT NULL,
  `fightattack` int(11) NOT NULL,
  `expirationdays` int(3) NOT NULL,
  `needitem` int(11) NOT NULL,
  `sellable` tinyint(1) NOT NULL DEFAULT 1,
  `race` varchar(30) NOT NULL,
  `lv` int(4) NOT NULL,
  `trainbonus` int(4) NOT NULL,
  `leget` int(3) NOT NULL,
  `upgradeid` int(11) NOT NULL,
  `arenapoints` int(11) NOT NULL,
  `maxupgrade` int(3) NOT NULL,
  `upgradedivider` int(3) NOT NULL,
  `changetype` tinyint(1) NOT NULL,
  `changeupgrade` tinyint(1) NOT NULL,
  `defaultstatstype` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` (`id`, `name`, `category`, `image`, `description`, `price`, `type`, `lp`, `kp`, `attack`, `defense`, `value`, `slot`, `travelbonus`, `equippedimage`, `fightattack`, `expirationdays`, `needitem`, `sellable`, `race`, `lv`, `trainbonus`, `leget`, `upgradeid`, `arenapoints`, `maxupgrade`, `upgradedivider`, `changetype`, `changeupgrade`, `defaultstatstype`) VALUES
(1, 'Verbranntes Fleisch', 1, 'verbranntesfleisch', 'Das ist Fleisch, was zulange gebraten worden ist.', 250, 1, 50, 0, 0, 0, 50, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(2, 'Blatt mit Wasser', 1, 'blattmitwasser', 'Das ist ein Blatt, auf dem Wasser getropft ist.', 250, 1, 0, 50, 0, 0, 50, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(3, 'Jindujun', 4, 'jindujun', 'Eine Wolke, auf der man sich schnell fortbewegt.', 5000, 4, 0, 0, 0, 0, 10, 4, 10, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(4, 'Hähnchenkeule', 1, 'haehnchenkeule', 'Das Bein eines Huhnes.', 500, 1, 100, 0, 0, 0, 100, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(5, 'Kleiner Becher', 1, 'kleinerbecher', 'Ein kleiner Becher mit Wasser', 500, 1, 0, 100, 0, 0, 100, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(6, 'Dinosaurier-Keule', 1, 'dinosaurierfleisch', 'Das Fleisch eines Dinosaurier.', 1250, 1, 250, 0, 0, 0, 250, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(7, 'Wasserflasche', 1, 'wasserflasche', 'Eine Flasche voll mit Wasser.', 1250, 1, 0, 250, 0, 0, 250, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(8, 'Gebratener Fisch', 1, 'fisch', 'Ein Fisch der über ein Feuer gebraten worden ist.', 2500, 1, 500, 0, 0, 0, 500, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(9, 'Eimer mit Wasser', 1, 'eimerwasser', 'Ein Eimer voll mit Wasser.', 2500, 1, 0, 500, 0, 0, 500, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(10, 'Hamburger', 1, 'hamburger', 'Ein lecker zubereiteter Hamburger', 5000, 1, 1000, 0, 0, 0, 1000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(11, 'Energy Drink', 1, 'energydrink', 'Ein Energy Drink, der viel Energie wieder herstellt.', 5000, 1, 0, 1000, 0, 0, 1000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(12, 'Voller Teller', 1, 'vollerteller', 'Ein Teller voll mit Essen', 12500, 1, 2500, 0, 0, 0, 2500, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(13, 'Limonade', 1, 'limonade', 'Erfrischende Limonade aus einer Flasche', 12500, 1, 0, 2500, 0, 0, 2500, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(14, 'Tiger Schuhe', 2, 'tigerschuhe', 'Schuhe aus dem Fell des Tigers', 1200, 3, 0, 0, 0, 4, 6, 7, 0, 'tigerschuhe', 0, 0, 0, 1, '', 0, 0, 0, 0, 106, 3, 10, 1, 1, 2),
(15, 'Tiger Hose', 2, 'tigerhose', 'Eine Hose aus dem Fell des Tigers', 2200, 3, 0, 0, 0, 6, 11, 3, 0, 'tigerhose', 0, 0, 0, 1, '', 0, 0, 0, 0, 111, 3, 10, 1, 1, 2),
(16, 'Tiger Schürze', 2, 'tigerhemd', 'Eine Schürze aus dem Fell des Tigers', 2800, 3, 0, 0, 0, 12, 14, 5, 0, 'tigerhemd', 0, 0, 0, 1, '', 0, 0, 0, 0, 114, 3, 10, 1, 1, 2),
(17, 'Tiger Handschuhe', 2, 'tigerhandschuhe', 'Handschuhe aus dem Fell des Tigers', 2000, 3, 0, 0, 0, 8, 10, 2, 0, 'tigerhandschuhe', 0, 0, 0, 1, '', 0, 0, 0, 0, 110, 3, 10, 1, 1, 2),
(18, 'Ast', 3, 'ast', 'Ein Ast der von einem Baum gefallen ist', 1800, 3, 0, 0, 10, 0, 9, 6, 0, 'ast', 0, 0, 0, 1, '', 0, 0, 0, 0, 109, 3, 10, 1, 1, 1),
(19, 'Pterodactyl Schuhe', 2, 'pterodactylschuhe', 'Schuhe aus der Haut eines Pterodactyls.', 1200, 3, 0, 0, 0, 6, 6, 7, 0, 'pterodactylschuhe', 0, 0, 0, 1, '', 4, 0, 0, 0, 146, 3, 10, 1, 1, 2),
(20, 'Pterodactyl Hose', 2, 'pterodactylhose', 'Eine Hose aus dr Haut eines Pterodactyls', 2200, 3, 0, 0, 0, 8, 11, 3, 0, 'pterodactylhose', 0, 0, 0, 1, '', 4, 0, 0, 0, 151, 3, 10, 1, 1, 2),
(21, 'Pterodactyl Hemd', 2, 'pterodactylhemd', 'Ein Hemd aus der Haut eines Pterodactyls', 3000, 3, 0, 0, 0, 14, 15, 5, 0, 'pterodactylhemd', 0, 0, 0, 1, '', 4, 0, 0, 0, 155, 3, 10, 1, 1, 2),
(22, 'Pterodactyl Handschuhe', 2, 'pterodactylhandschuhe', 'Handschuhe aus der Haut eines Pterodactyls', 2000, 3, 0, 0, 0, 12, 10, 2, 0, 'pterodactylhandschuhe', 0, 0, 0, 1, '', 4, 0, 0, 0, 150, 3, 10, 1, 1, 2),
(23, 'Knochen', 3, 'knochen', 'Knochen eines Pterodactyl', 3600, 3, 0, 0, 40, 0, 18, 6, 0, 'knochen', 0, 0, 0, 1, '', 4, 0, 0, 0, 158, 3, 10, 1, 1, 1),
(24, 'Schuhe des Diebes', 2, 'diebschuhe', 'Schuhe die einen Bärendieb gehörten.', 1800, 3, 0, 0, 0, 12, 9, 7, 0, 'diebschuhe', 0, 0, 0, 1, '', 5, 0, 0, 0, 159, 3, 10, 1, 1, 2),
(25, 'Hose des Diebes', 2, 'diebhose', 'Eine Hose die einen Bärendieb gehörte.', 2800, 3, 0, 0, 0, 14, 14, 3, 0, 'diebhose', 0, 0, 0, 1, '', 5, 0, 0, 0, 164, 3, 10, 1, 1, 2),
(26, 'Rüstung des Diebes', 2, 'diebhemd', 'Eine Rüstung die einen Bärendieb gehörte.', 3800, 3, 0, 0, 0, 20, 19, 5, 0, 'diebhemd', 0, 0, 0, 1, '', 5, 0, 0, 0, 169, 3, 10, 1, 1, 2),
(27, 'Handschuhe des Diebes', 2, 'diebhandschuhe', 'Handschuhe die einen Bärendieb gehörten.', 2600, 3, 0, 0, 0, 16, 13, 2, 0, 'diebhandschuhe', 0, 0, 0, 1, '', 5, 0, 0, 0, 163, 3, 10, 1, 1, 2),
(28, 'Rostiges Schwert', 3, 'rostigesschwert', 'Ein rostiges Schwert', 2400, 3, 0, 0, 50, 0, 12, 6, 0, 'rostigesschwert', 0, 0, 0, 1, '', 4, 0, 0, 0, 152, 3, 10, 1, 1, 1),
(29, 'Lumpen Schuhe', 2, 'lumpenschuhe', 'Sehr billige Schuhe', 600, 3, 0, 0, 0, 1, 3, 7, 0, 'lumpenschuhe', 0, 0, 0, 1, '', 0, 0, 0, 0, 103, 3, 10, 1, 1, 2),
(30, 'Lumpen Hose', 2, 'lumpenhose', 'Eine sehr billige Hose', 1200, 3, 0, 0, 0, 2, 6, 3, 0, 'lumpenhose', 0, 0, 0, 1, '', 0, 0, 0, 0, 106, 3, 10, 1, 1, 2),
(31, 'Lumpen Hemd', 2, 'lumpenhemd', 'Ein sehr billiges Hemd', 1400, 3, 0, 0, 0, 5, 7, 5, 0, 'lumpenhemd', 0, 0, 0, 1, '', 0, 0, 0, 0, 107, 3, 10, 1, 1, 2),
(32, 'Lumpen Handschuhe', 2, 'lumpenhandschuhe', 'Sehr billige Handschuhe', 1000, 3, 0, 0, 0, 3, 5, 2, 0, 'lumpenhandschuhe', 0, 0, 0, 1, '', 0, 0, 0, 0, 105, 3, 10, 1, 1, 2),
(33, 'Stoffschuhe', 2, 'stoffschuhe', 'Schuhe aus Stoff', 1200, 3, 0, 0, 0, 10, 6, 7, 0, 'stoffschuhe', 0, 0, 0, 1, '', 5, 0, 0, 0, 156, 3, 10, 1, 1, 2),
(34, 'Stoffhose', 2, 'stoffhose', 'Eine Hose aus Stoff', 1800, 3, 0, 0, 0, 11, 9, 3, 0, 'stoffhose', 0, 0, 0, 1, '', 5, 0, 0, 0, 159, 3, 10, 1, 1, 2),
(35, 'Stoffhemd', 2, 'stoffhemd', 'Ein Stoff Hemd', 2400, 3, 0, 0, 0, 16, 12, 5, 0, 'stoffhemd', 0, 0, 0, 1, '', 5, 0, 0, 0, 162, 3, 10, 1, 1, 2),
(36, 'Stoffhandschuhe', 2, 'stoffhandschuhe', 'Handschuhe aus Stoff', 1600, 3, 0, 0, 0, 13, 8, 2, 0, 'stoffhandschuhe', 0, 0, 0, 1, '', 5, 0, 0, 0, 158, 3, 10, 1, 1, 2),
(37, 'Zerfetzte Stoffschuhe', 2, 'zerfetztestoffschuhe', 'Zerfetzte Schuhe aus Stoff', 800, 3, 0, 0, 0, 2, 4, 7, 0, 'zerfetztestoffschuhe', 0, 0, 0, 1, '', 4, 0, 0, 0, 144, 3, 10, 1, 1, 2),
(38, 'Zerfetzte Stoffhose', 2, 'zerfetztestoffhose', 'Eine zerfetzte Hose aus Stoff', 1400, 3, 0, 0, 0, 4, 7, 3, 0, 'zerfetztestoffhose', 0, 0, 0, 1, '', 4, 0, 0, 0, 147, 3, 10, 1, 1, 2),
(39, 'Zerfetztes Stoffhemd', 2, 'zerfetztesstoffhemd', 'Ein zerfetztes Stoff Hemd', 1600, 3, 0, 0, 0, 8, 8, 5, 0, 'zerfetztesstoffhemd', 0, 0, 0, 1, '', 4, 0, 0, 0, 148, 3, 10, 1, 1, 2),
(40, 'Zerfetzte Stoffhandschuhe', 2, 'zerfetztestoffhandschuhe', 'Zerfetzte Handschuhe aus Stoff', 1400, 3, 0, 0, 0, 6, 7, 2, 0, 'zerfetztestoffhandschuhe', 0, 0, 0, 1, '', 4, 0, 0, 0, 147, 3, 10, 1, 1, 2),
(41, 'Schwert', 3, 'schwert', 'Ein Schwert', 3000, 3, 0, 0, 60, 0, 15, 6, 0, 'schwert', 0, 0, 0, 1, '', 5, 0, 0, 0, 165, 3, 10, 1, 1, 1),
(42, 'Schuhe von Oolong', 2, 'oolongschuhe', 'Schuhe von Oolong', 2400, 3, 0, 0, 0, 14, 12, 7, 0, 'oloongschuhe', 0, 0, 0, 1, '', 7, 0, 0, 0, 182, 3, 10, 1, 1, 2),
(43, 'Hose von Oolong', 2, 'oolonghose', 'Eine Hose die von Oolong getragen worden ist', 4000, 3, 0, 0, 0, 16, 20, 3, 0, 'oolonghose', 0, 0, 0, 1, '', 7, 0, 0, 0, 190, 3, 10, 1, 1, 2),
(44, 'Oberteil von Oolong', 2, 'oolonghemd', 'Das Oberteil von Oolong', 5200, 3, 0, 0, 0, 22, 26, 5, 0, 'oolonghemd', 0, 0, 0, 1, '', 7, 0, 0, 0, 196, 3, 10, 1, 1, 2),
(45, 'Handschuhe von Oolong', 2, 'oolonghandschuhe', 'Handschuhe von Oolong', 3400, 3, 0, 0, 0, 18, 17, 2, 0, 'oolonghandschuhe', 0, 0, 0, 1, '', 7, 0, 0, 0, 187, 3, 10, 1, 1, 2),
(46, 'Schuhe von Shu', 2, 'shuschuhe', 'Schuhe von Shu', 3000, 3, 0, 0, 0, 18, 15, 7, 0, 'shuschuhe', 0, 0, 0, 1, '', 12, 0, 0, 0, 235, 3, 10, 1, 1, 2),
(47, 'Hose von Shu', 2, 'shuhose', 'Eine Hose die von Shu getragen worden ist', 5200, 3, 0, 0, 0, 21, 26, 3, 0, 'shuhose', 0, 0, 0, 1, '', 12, 0, 0, 0, 246, 3, 10, 1, 1, 2),
(48, 'Oberteil von Shu', 2, 'shuhemd', 'Das Oberteil von Shu', 6800, 3, 0, 0, 0, 27, 34, 5, 0, 'shuhemd', 0, 0, 0, 1, '', 12, 0, 0, 0, 254, 3, 10, 1, 1, 2),
(49, 'Handschuhe von Shu', 2, 'shuhandschuhe', 'Handschuhe von Shu', 4600, 3, 0, 0, 0, 24, 23, 2, 0, 'shuhandschuhe', 0, 0, 0, 1, '', 12, 0, 0, 0, 243, 3, 10, 1, 1, 2),
(50, 'Katana', 3, 'katana', 'Ein Katana', 8400, 3, 0, 0, 90, 0, 42, 6, 0, 'katana', 0, 0, 0, 1, '', 12, 0, 0, 0, 262, 3, 10, 1, 1, 1),
(51, 'Schuhe von Yamchu', 2, 'yamchuschuhe', 'Schuhe von Yamchu', 2600, 3, 0, 0, 0, 16, 13, 7, 0, 'yamchuschuhe', 0, 0, 0, 1, '', 9, 0, 0, 0, 203, 3, 10, 1, 1, 2),
(52, 'Hose von Yamchu', 2, 'yamchuhose', 'Eine Hose die von Yamchu getragen worden ist', 4400, 3, 0, 0, 0, 18, 22, 3, 0, 'yamchuhose', 0, 0, 0, 1, '', 9, 0, 0, 0, 212, 3, 10, 1, 1, 2),
(53, 'Oberteil von Yamchu', 2, 'yamchuhemd', 'Das Oberteil von Yamchu', 5800, 3, 0, 0, 0, 26, 29, 5, 0, 'yamchuhemd', 0, 0, 0, 1, '', 9, 0, 0, 0, 219, 3, 10, 1, 1, 2),
(54, 'Handschuhe von Yamchu', 2, 'yamchuhandschuhe', 'Handschuhe von Yamchu', 4000, 3, 0, 0, 0, 20, 20, 2, 0, 'yamchuhandschuhe', 0, 0, 0, 1, '', 9, 0, 0, 0, 210, 3, 10, 1, 1, 2),
(75, 'Dragonball Radar', 0, 'radar', 'Ein Radar um die Dragonballs zu finden.', 10000, 5, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 1, '', 10, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(76, 'Säbel von Yamchu', 3, 'yamchuschwert', 'Ein Säbel genutzt von Yamchu', 7200, 3, 0, 0, 80, 0, 36, 6, 0, 'yamchuschwert', 0, 0, 0, 1, '', 9, 0, 0, 0, 226, 3, 10, 1, 1, 1),
(77, 'Mönchstab', 3, 'moenchstab', 'Ein Stab der für viele Dinge benutzt werden kann,', 8800, 3, 0, 0, 100, 0, 44, 6, 0, 'moenchstab', 0, 0, 0, 1, '', 13, 0, 0, 0, 274, 3, 10, 1, 1, 1),
(78, 'Hemd der Schildkrötenschule', 2, 'turtlehemd', 'Ein Hemd was in der Schildkrötenschule getragen wird.', 7200, 3, 0, 0, 0, 30, 36, 5, 0, 'turtlehemd', 0, 0, 0, 1, '', 13, 0, 0, 0, 266, 3, 10, 1, 1, 2),
(79, 'Handschuhe der Schildkrötenschule', 2, 'turtlehandschuhe', 'Handschuhe die in der Schildkrötenschule getragen werden.', 5000, 3, 0, 0, 0, 25, 25, 2, 0, 'turtlehandschuhe', 0, 0, 0, 1, '', 13, 0, 0, 0, 255, 3, 10, 1, 1, 2),
(80, 'Hose der Schildkrötenschule', 2, 'turtlehose', 'Eine Hose die in der Schildkrötenschule getragen wird.', 5400, 3, 0, 0, 0, 23, 27, 3, 0, 'turtlehose', 0, 0, 0, 1, '', 13, 0, 0, 0, 257, 3, 10, 1, 1, 2),
(81, 'Schuhe der Schildkrötenschule', 2, 'turtleschuhe', 'Schuhe die in der Schildkrötenschule getragen werden.', 3200, 3, 0, 0, 0, 22, 16, 7, 0, 'turtleschuhe', 0, 0, 0, 1, '', 13, 0, 0, 0, 246, 3, 10, 1, 1, 2),
(82, 'Potara', 4, 'potara', 'Potara mit denen man fusionieren kann.', 0, 5, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 10, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(83, 'Hose des Herrn der Schildkröten', 2, 'mutenroshihose', 'Eine Hose die der Herr der Schildkröten getragen hat.', 6000, 3, 0, 0, 0, 29, 30, 3, 0, 'mutenroshihose', 0, 0, 0, 1, '', 13, 0, 0, 0, 260, 3, 10, 1, 1, 2),
(84, 'Hemd des Herrn der Schildkröten', 2, 'mutenroshihemd', 'Ein Hemd was der Herr der Schildkröten getragen hat.', 8000, 3, 0, 0, 0, 35, 40, 5, 0, 'mutenroshihemd', 0, 0, 0, 1, '', 13, 0, 0, 0, 270, 3, 10, 1, 1, 2),
(85, 'Schuhe des Herrn der Schildkröten', 2, 'mutenroshischuhe', 'Schuhe die von dem Herrn der Schildkröten getragen worden sind.', 3800, 3, 0, 0, 0, 26, 19, 7, 0, 'mutenroshischuhe', 0, 0, 0, 1, '', 13, 0, 0, 0, 249, 3, 10, 1, 1, 2),
(86, 'Hose von Bakterian', 2, 'bakterianhose', 'Die Hose die von Bakterian getragen worden ist.', 6800, 3, 0, 0, 30, 0, 34, 3, 0, 'bakterianhose', 0, 0, 0, 1, '', 15, 0, 0, 0, 284, 3, 10, 1, 1, 1),
(87, 'Schuhe von Bakterian', 2, 'bakterianschuhe', 'Schuhe die von Bakterian getragen worden sind.', 4000, 3, 0, 0, 20, 0, 20, 7, 0, 'bakterianschuhe', 0, 0, 0, 1, '', 15, 0, 0, 0, 270, 3, 10, 1, 1, 1),
(88, 'Handschuhe von Bakterian', 2, 'bakterianhandschuhe', 'Handschuhe die von Bakterian getragen worden sind.', 6000, 3, 0, 0, 20, 0, 30, 2, 0, 'bakterianhandschuhe', 0, 0, 0, 1, '', 15, 0, 0, 0, 280, 3, 10, 1, 1, 1),
(89, 'Hemd eines Mönches', 2, 'namhemd', 'Ein Hemd welches Mönche tragen.', 10000, 3, 0, 0, 0, 40, 50, 5, 0, 'namhemd', 0, 0, 0, 1, '', 18, 0, 0, 0, 330, 3, 10, 1, 1, 2),
(90, 'Hose eines Mönches', 2, 'namhose', 'Hose die von einem Mönch getragen wird.', 7600, 3, 0, 0, 0, 31, 38, 3, 0, 'namhose', 0, 0, 0, 1, '', 18, 0, 0, 0, 318, 3, 10, 1, 1, 2),
(91, 'Schuhe des Mönches', 2, 'namschuhe', 'Schuhe die von Mönchen getragen werden-', 4400, 3, 0, 0, 0, 28, 22, 7, 0, 'namschuhe', 0, 0, 0, 1, '', 18, 0, 0, 0, 302, 3, 10, 1, 1, 2),
(92, 'Handschuhe des Mönches', 2, 'namhandschuhe', 'Handschuhe die von Mönchen getragen werden', 6800, 3, 0, 0, 0, 26, 34, 2, 0, 'namhandschuhe', 0, 0, 0, 1, '', 18, 0, 0, 0, 314, 3, 10, 1, 1, 2),
(95, 'Bonbon', 1, 'bonbon', 'Ein Bonbon', 0, 2, 10, 10, 0, 0, 20, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(96, 'Großer Bonbon', 1, 'bonbon2', 'Ein großer Bonbon', 0, 2, 20, 20, 0, 0, 40, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(97, 'Kaffeebonbon', 1, 'kaffeebonbon', 'Ein Bonbon zum Kaffee', 0, 2, 30, 30, 0, 0, 60, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(98, 'Zuckerstange', 1, 'zuckerstange', 'Eine Zuckerstange', 0, 2, 40, 40, 0, 0, 80, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(99, 'Muffin', 1, 'muffin', 'Ein leckerer Muffin', 0, 2, 60, 60, 0, 0, 120, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(100, 'Kekse', 1, 'kekse', 'Lecker duftendende Kekse', 0, 2, 70, 70, 0, 0, 140, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(101, 'Zuckersenzu', 1, 'zuckersenzu', 'Eine Senzu Bohne gemacht aus Zucker', 0, 2, 40, 40, 0, 0, 80, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(102, 'Senzu', 1, 'senzu', 'Eine Senzu Bohne die den Anwender komplett wiederherrstellt', 0, 2, 100, 100, 0, 0, 200, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(103, 'Lolipop', 1, 'lolipop', 'Ein Lolipop zum schlecken', 0, 2, 50, 50, 0, 0, 100, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(104, 'Weihnachtshemd', 2, 'weihnachtshemd', 'Ein Hemd was zu Weihnachten getragen wird.', 0, 3, 0, 0, 0, 0, 0, 5, 0, 'weihnachtshemd', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(105, 'Weihnachtshandschuhe', 2, 'weihnachtshandschuhe', 'Handschuhe die zu Weihnachten getragen werden.', 0, 3, 0, 0, 0, 0, 0, 2, 0, 'weihnachtshandschuhe', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(106, 'Weihnachtsschuhe', 2, 'weihnachtsschuhe', 'Schuhe die zu Weihnachten getragen werden.', 0, 3, 0, 0, 0, 0, 0, 7, 0, 'weihnachtsschuhe', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(107, 'Weihnachtshose', 2, 'weihnachtshose', 'Eine Hose die zu Weihnachten getragen wird.', 0, 3, 0, 0, 0, 0, 0, 3, 0, 'weihnachtshose', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(108, 'Hemd eines Ninjas', 2, 'ninjahemd', 'Ein Hemd was ein Ninja getragen hat. Er mag Lila.', 11400, 3, 0, 0, 0, 45, 57, 5, 0, 'ninjahemd', 0, 0, 0, 1, '', 22, 0, 0, 0, 377, 3, 10, 1, 1, 2),
(109, 'Hose eines Ninjas', 2, 'ninjahose', 'Eine Hose die ein Ninja getragen hat. Er mag Lila.', 8400, 3, 0, 0, 0, 38, 42, 3, 0, 'ninjahose', 0, 0, 0, 1, '', 22, 0, 0, 0, 362, 3, 10, 1, 1, 2),
(110, 'Schuhe eines Ninjas', 2, 'ninjaschuhe', 'Schuhe die ein Ninja getragen hat. Er mag Lila.', 5000, 3, 0, 0, 0, 35, 25, 7, 0, 'ninjaschuhe', 0, 0, 0, 1, '', 22, 0, 0, 0, 345, 3, 10, 1, 1, 2),
(111, 'Handschuhe des Ninjas', 2, 'ninjahandschuhe', 'Handschuhe die ein Ninja getragen hat. Er mag Lila.', 7600, 3, 0, 0, 0, 32, 38, 2, 0, 'ninjahandschuhe', 0, 0, 0, 1, '', 22, 0, 0, 0, 358, 3, 10, 1, 1, 2),
(112, 'Katana des Ninjas', 3, 'ninjakatana', 'Ein Katana das von einem echten Ninja geführt worden ist.', 14000, 3, 0, 0, 150, 0, 70, 6, 0, 'ninjakatana', 0, 0, 0, 1, '', 22, 0, 0, 0, 390, 3, 10, 1, 1, 1),
(116, 'Kaputtes Red Ribbon Hemd', 2, 'rrkaputthemd', 'Ein kaputtes Hemd der Red Ribbon Uniform', 12000, 3, 0, 0, 0, 50, 60, 5, 0, 'rrkaputthemd', 0, 0, 0, 1, '', 27, 0, 0, 0, 430, 3, 10, 1, 1, 2),
(117, 'Kaputte Red Ribbon Handschuhe', 2, 'rrkaputthandschuhe', 'Kaputte Handschuhe der Red Ribbon Uniform', 7600, 3, 0, 0, 0, 38, 38, 2, 0, 'rrkaputthandschuhe', 0, 0, 0, 1, '', 27, 0, 0, 0, 408, 3, 10, 1, 1, 2),
(118, 'Kaputte Red Ribbon Schuhe', 2, 'rrkaputtschuhe', 'Kaputte Schuhe der Red Ribbn Uniform', 5400, 3, 0, 0, 0, 42, 27, 7, 0, 'rrkaputtschuhe', 0, 0, 0, 1, '', 27, 0, 0, 0, 397, 3, 10, 1, 1, 2),
(119, 'Kaputte Red Ribbon Hose', 2, 'rrkaputthose', 'Eine kaputte Hose der Red Ribbon Uniform', 9000, 3, 0, 0, 0, 45, 45, 3, 0, 'rrkaputthose', 0, 0, 0, 1, '', 27, 0, 0, 0, 415, 3, 10, 1, 1, 2),
(125, 'Red Ribbon Hose', 2, 'rrheilehose', 'Eine Hose der Red Ribbon Uniform', 9400, 3, 0, 0, 0, 48, 47, 3, 0, 'rrheilehose', 0, 0, 0, 1, '', 27, 0, 0, 0, 417, 3, 10, 1, 1, 2),
(126, 'Red Ribbon Schuhe', 2, 'rrheileschuhe', 'Schuhe der Red Ribbn Uniform', 5600, 3, 0, 0, 0, 45, 28, 7, 0, 'rrheileschuhe', 0, 0, 0, 1, '', 27, 0, 0, 0, 398, 3, 10, 1, 1, 2),
(127, 'Red Ribbon Handschuhe', 2, 'rrheilehandschuhe', 'Handschuhe der Red Ribbon Uniform', 8600, 3, 0, 0, 0, 42, 43, 2, 0, 'rrheilehandschuhe', 0, 0, 0, 1, '', 27, 0, 0, 0, 413, 3, 10, 1, 1, 2),
(128, 'Red Ribbon Hemd', 2, 'rrheilehemd', 'Ein Hemd der Red Ribbon Uniform', 12800, 3, 0, 0, 0, 55, 64, 5, 0, 'rrheilehemd', 0, 0, 0, 1, '', 27, 0, 0, 0, 434, 3, 10, 1, 1, 2),
(129, 'Arale Hose', 2, 'aralehose', 'Die Hose die von Arale getragen wird.', 9800, 3, 0, 0, 0, 52, 49, 3, 0, 'aralehose', 0, 0, 0, 1, '', 27, 0, 0, 0, 419, 3, 10, 1, 1, 2),
(130, 'Arale Schuhe', 2, 'araleschuhe', 'Schuhe die von Arale getragen werden.', 6200, 3, 0, 0, 0, 48, 31, 7, 0, 'araleschuhe', 0, 0, 0, 1, '', 27, 0, 0, 0, 401, 3, 10, 1, 1, 2),
(131, 'Arale Shirt', 2, 'aralehemd', 'Ein Shirt das von Arale oft getragen wird.', 13400, 3, 0, 0, 0, 58, 67, 5, 0, 'aralehemd', 0, 0, 0, 1, '', 27, 0, 0, 0, 437, 3, 10, 1, 1, 2),
(132, 'Poo am Stock', 3, 'araleweapon', 'Ein pinkes Stück an einem Stock.', 16400, 3, 0, 0, 200, 0, 82, 6, 0, 'araleweapon', 0, 0, 0, 1, '', 27, 0, 0, 0, 452, 3, 10, 1, 1, 1),
(133, 'Hose von Tao BaiBai', 2, 'taohose', 'Eine Hose die von Tao BaiBai getragen worden ist.', 10600, 3, 0, 0, 0, 54, 53, 3, 0, 'taohose', 0, 0, 0, 1, '', 30, 0, 0, 0, 453, 3, 10, 1, 1, 2),
(134, 'Schuhe von Tao BaiBai', 2, 'taoschuhe', 'Schuhe die von Tao BaiBai getragen worden sind.', 7400, 3, 0, 0, 0, 52, 37, 7, 0, 'taoschuhe', 0, 0, 0, 1, '', 30, 0, 0, 0, 437, 3, 10, 1, 1, 2),
(135, 'Anzug von Tao BaiBai', 2, 'taohemd', 'Eine Anzug der von Tao BaiBai getragen worden ist.', 14200, 3, 0, 0, 0, 62, 71, 5, 0, 'taohemd', 0, 0, 0, 1, '', 30, 0, 0, 0, 471, 3, 10, 1, 1, 2),
(136, 'Säule', 3, 'taoweapon', 'Eine Säule die zum Angriff benutzt werden kann.', 17600, 3, 0, 0, 210, 0, 88, 6, 0, 'taoweapon', 0, 0, 0, 1, '', 30, 0, 0, 0, 488, 3, 10, 1, 1, 1),
(147, 'Anzug von Black', 2, 'blackhemd', 'Eine Anzug der von Black getragen worden ist.', 15600, 3, 0, 0, 0, 66, 78, 5, 0, 'blackhemd', 0, 0, 0, 1, '', 32, 0, 0, 0, 498, 3, 10, 1, 1, 2),
(148, 'Schuhe von Black', 2, 'blackschuhe', 'Schuhe die von Black getragen worden sind.', 9000, 3, 0, 0, 0, 56, 45, 7, 0, 'blackschuhe', 0, 0, 0, 1, '', 32, 0, 0, 0, 465, 3, 10, 1, 1, 2),
(149, 'Hose von Black', 2, 'blackhose', 'Eine Hose die von Black getragen worden ist.', 11600, 3, 0, 0, 0, 61, 58, 3, 0, 'blackhose', 0, 0, 0, 1, '', 32, 0, 0, 0, 478, 3, 10, 1, 1, 2),
(150, 'Alle Dragonballs', 0, 'alldbs', 'Alle sieben Dragonballs, mit denen man sich etwas wünschen kann.', 0, 5, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(151, 'Hemd der Kranichschule', 2, 'kranichhemd', 'Ein Hemd das in der Kranichschule getragen wird.', 18000, 3, 0, 0, 0, 78, 90, 5, 0, 'kranichhemd', 0, 0, 0, 1, '', 40, 0, 0, 0, 590, 3, 10, 1, 1, 2),
(152, 'Hose der Kranichschule', 2, 'kranichhose', 'Eine Hose die in der Kranichschule getragen wird.', 13400, 3, 0, 0, 0, 70, 67, 3, 0, 'kranichhose', 0, 0, 0, 1, '', 40, 0, 0, 0, 567, 3, 10, 1, 1, 2),
(153, 'Schuhe der Kranichschule', 2, 'kranichschuhe', 'Schuhe die in der Kranichschule getragen werden.', 8800, 3, 0, 0, 0, 66, 44, 7, 0, 'kranichschuhe', 0, 0, 0, 1, '', 40, 0, 0, 0, 544, 3, 10, 1, 1, 2),
(154, 'Handschuhe von Inkognito', 2, 'noitem', 'Besondere Handschuhe die von Inkognito getragen worden sind.', 11200, 3, 0, 0, 0, 56, 56, 2, 0, 'noitem', 0, 0, 0, 1, '', 34, 0, 0, 0, 496, 3, 10, 1, 1, 2),
(155, 'Hemd von Inkognito', 2, 'noitem', 'Ein besonderes Hemd das von Inkognito getragen worden ist.', 16800, 3, 0, 0, 0, 71, 84, 5, 0, 'noitem', 0, 0, 0, 1, '', 34, 0, 0, 0, 524, 3, 10, 1, 1, 2),
(156, 'Schuhe von Inkognito', 2, 'noitem', 'Besondere Schuhe die von Inkognito getragen worden sind.', 7400, 3, 0, 0, 0, 60, 37, 7, 0, 'noitem', 0, 0, 0, 1, '', 34, 0, 0, 0, 477, 3, 10, 1, 1, 2),
(157, 'Hose von Inkognito', 2, 'noitem', 'Ein besonderes Hose die von Inkognito getragen worden ist.', 12400, 3, 0, 0, 0, 63, 62, 3, 0, 'noitem', 0, 0, 0, 1, '', 34, 0, 0, 0, 502, 3, 10, 1, 1, 2),
(158, 'Das Schwert von Inkognito', 3, 'noitem', 'Ein geheimes Schwert, das Inkognito nie benutzt hat.', 20600, 3, 0, 0, 250, 0, 103, 6, 0, 'noitem', 0, 0, 0, 1, '', 34, 0, 0, 0, 543, 3, 10, 1, 1, 1),
(159, 'Hemd vom Oberteufel', 2, 'oberteufelbrust', 'Ein Hemd, welches vom Oberteufel getragen wurde. ', 18600, 3, 0, 0, 0, 90, 93, 5, 0, 'oberteufelbrust', 0, 0, 0, 1, '', 44, 0, 0, 0, 633, 3, 10, 1, 1, 2),
(160, 'Hose vom Oberteufel', 2, 'oberteufelhose', 'Eine Hose, die vom Oberteufel getragen wurde. ', 14000, 3, 0, 0, 0, 84, 70, 3, 0, 'oberteufelhose', 0, 0, 0, 1, '', 44, 0, 0, 0, 610, 3, 10, 1, 1, 2),
(161, 'Schuhe vom Oberteufel', 2, 'oberteufelschuhe', 'Schuhe, die vom Oberteufel getragen wurden. ', 9600, 3, 0, 0, 0, 80, 48, 7, 0, 'oberteufelschuhe', 0, 0, 0, 1, '', 44, 0, 0, 0, 588, 3, 10, 1, 1, 2),
(166, 'Oberteil der Königlichen Wache', 2, 'kingcastlehemd', 'Das Oberteil der Uniform der Königlichen Wache. ', 21600, 3, 0, 0, 0, 85, 108, 5, 0, 'kingcastlehemd', 0, 0, 0, 1, '', 45, 0, 0, 0, 658, 3, 10, 1, 1, 2),
(167, 'Hose der Königlichen Wache', 2, 'kingcastlehose', 'Die Hose der Uniform der Königlichen Wache.', 16000, 3, 0, 0, 0, 74, 80, 3, 0, 'kingcastlehose', 0, 0, 0, 1, '', 45, 0, 0, 0, 630, 3, 10, 1, 1, 2),
(168, 'Schuhe der Königlichen Wache', 2, 'kingcastleschuhe', 'Die Schuhe der Uniform der Königlichen Wache.  ', 9600, 3, 0, 0, 0, 69, 48, 7, 0, 'kingcastleschuhe', 0, 0, 0, 1, '', 45, 0, 0, 0, 598, 3, 10, 1, 1, 2),
(169, 'Handschuhe der Königlichen Wache', 2, 'kingcastlehandschuhe', 'Die Handschuhe der Uniform der Königlichen Wache.', 14400, 3, 0, 0, 0, 72, 72, 2, 0, 'kingcastlehandschuhe', 0, 0, 0, 1, '', 45, 0, 0, 0, 622, 3, 10, 1, 1, 2),
(170, 'Schwert der Königlichen Wache', 3, 'kingcastleschwert', 'Das passende Schwert zur Uniform der Königlichen Wache. ', 26400, 3, 0, 0, 300, 0, 132, 6, 0, 'kingcastleschwert', 0, 0, 0, 1, '', 45, 0, 0, 0, 682, 3, 10, 1, 1, 1),
(171, 'verbesserte Jindujun', 4, 'verbessertejindujun', 'Eine Wolke, auf der man sich deutlich schneller fortbewegt.', 0, 4, 0, 0, 0, 0, 20, 4, 20, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(172, 'Medizin zum Statsreset', 1, 'statreset', 'Eine Medizin, die die Stats auf den Start zurücksetzt, damit man sie neuverteilen kann.', 0, 6, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(173, 'Medizin zum Skillreset', 1, 'statreset', 'Eine Medizin, die die Skills auf den Start zurücksetzt, damit man sie neuverteilen kann.', 0, 6, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(184, 'Type Stone', 1, 'statstein', 'Ein Stein wodurch der Typ eines Items verändert wird.', 10000, 6, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 1),
(185, 'Level Stone', 1, 'levelstein', 'Ein Stein wodurch der Level eines Items verändert wird.', 40000, 6, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(186, 'Oberteil von Piccolo', 2, 'piccolobrust', 'Das Oberteil von Piccolos Kampfuniform. ', 24400, 3, 0, 0, 0, 96, 122, 5, 0, 'piccolobrust', 0, 0, 0, 1, '', 50, 0, 0, 0, 722, 3, 10, 1, 1, 2),
(187, 'Hose von Piccolo', 2, 'piccolohose', 'Die Hose von Piccolos Kampfanzug', 18000, 3, 0, 0, 0, 88, 90, 3, 0, 'piccolohose', 0, 0, 0, 1, '', 50, 0, 0, 0, 690, 3, 10, 1, 1, 2),
(188, 'Schuhe von Piccolo', 2, 'piccoloschuhe', 'Die Schuhe von Piccolos Kampfanzug.', 10800, 3, 0, 0, 0, 84, 54, 7, 0, 'piccoloschuhe', 0, 0, 0, 1, '', 50, 0, 0, 0, 654, 3, 10, 1, 1, 2),
(189, 'Handschuhe von Piccolo', 2, 'piccolohand', 'Die Handschuhe von Piccolos Kampfuniform.', 16400, 3, 0, 0, 0, 82, 82, 2, 0, 'piccolohand', 0, 0, 0, 1, '', 50, 0, 0, 0, 682, 3, 10, 1, 1, 2),
(190, 'Aura der Schildkrötenschule', 2, 'aurablau2', 'Die Aura von Muten Roshi und seiner Schüler.', 10400, 3, 0, 0, 26, 26, 52, 1, 0, 'aurablau2', 0, 0, 0, 1, '', 13, 0, 0, 0, 282, 0, 10, 1, 0, 0),
(191, 'Aura des Ninjas', 2, 'aurapink1', 'Die Aura eines gefährlichen Ninjas.', 17600, 3, 0, 0, 44, 44, 88, 1, 0, 'aurapink1', 0, 0, 0, 1, '', 22, 0, 0, 0, 408, 0, 10, 1, 0, 0),
(192, 'Aura von General Blue', 2, 'aurablau1', 'Die Aura eines gefährlichen Generals.', 21600, 3, 0, 0, 54, 54, 108, 1, 0, 'aurablau1', 0, 0, 0, 1, '', 27, 0, 0, 0, 478, 0, 10, 1, 0, 0),
(193, 'Aura von Tenshinhan', 2, 'auraweiß1', 'Die Aura von Tenshinhan', 32000, 3, 0, 0, 80, 80, 160, 1, 0, 'auraweiß1', 0, 0, 0, 1, '', 40, 0, 0, 0, 660, 0, 10, 1, 0, 0),
(194, 'Enge Ninja Hose', 2, 'leehose', 'Eine Hose die von wahren Ninjas getragen wird.', 0, 3, 0, 0, 0, 0, 0, 3, 0, 'leehose', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(195, 'Enge Ninja Schuhe', 2, 'leeschuhe', 'Enge Schuhe die von wahren Ninjas getragen werden.', 0, 3, 0, 0, 0, 0, 0, 7, 0, 'leeschuhe', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(196, 'Enge Ninja Handschuhe', 2, 'leehand', 'Enge Handschuhe die von wahren Ninjas getragen werden.', 0, 3, 0, 0, 0, 0, 0, 2, 0, 'leehand', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(197, 'Enges Ninja Outfit', 2, 'leebrust', 'Ein enges Outfit das von echten Ninjas getragen wird.', 0, 3, 0, 0, 0, 0, 0, 5, 0, 'leebrust', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 3, 10, 1, 1, 2),
(198, 'Chip', 2, 'androidchip', 'Der Chip eines Androides.', 0, 3, 0, 0, 0, 0, 4, 1, 0, 'androidchip', 0, 0, 0, 0, 'Android', 0, 0, 0, 0, 0, 999, 1, 1, 0, 0),
(199, 'Oberteil von Radditz', 2, 'radditzbrust', 'Das Oberteil von Radditz\' Rüstung ', 25000, 3, 0, 0, 0, 0, 125, 5, 0, 'radditzbrust', 0, 0, 0, 1, '', 53, 0, 0, 0, 755, 3, 10, 1, 1, 2),
(200, 'Handschuhe von Radditz', 2, 'radditzhand', 'Die Handschuhe von Radditz\' Rüstung.', 16600, 3, 0, 0, 0, 0, 83, 2, 0, 'radditzhand', 0, 0, 0, 1, '', 53, 0, 0, 0, 713, 3, 10, 1, 1, 2),
(201, 'Schuhe von Radditz', 2, 'radditzschuhe', 'Die Schuhe von Radditz\' Rüstung.', 11200, 3, 0, 0, 0, 0, 56, 7, 0, 'radditzschuhe', 0, 0, 0, 1, '', 53, 0, 0, 0, 686, 3, 10, 1, 1, 2),
(202, 'Hose von Radditz', 2, 'radditzhose', 'Die Hose von Radditz\' Rüstung. ', 18400, 3, 0, 0, 0, 0, 92, 3, 0, 'radditzhose', 0, 0, 0, 1, '', 53, 0, 0, 0, 722, 3, 10, 1, 1, 2),
(203, 'Verbesserter Mönchstab', 3, 'moenchstab', 'Ein besserer Stab, der für viele Dinge benutzt werden kann,', 30400, 3, 0, 0, 0, 0, 152, 6, 0, 'moenchstab', 0, 0, 0, 1, '', 52, 0, 0, 0, 772, 3, 10, 1, 1, 1),
(204, 'Enmas Frucht', 4, 'enmasfrucht', 'Die Frucht von Enma, womit man sich wiederbeleben kann.', 15000, 6, 0, 0, 0, 0, 212, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(205, 'Aura von Radditz', 2, '', 'Die Aura von Radditz', 42400, 3, 0, 0, 80, 80, 212, 1, 0, '', 0, 0, 0, 1, '', 53, 0, 0, 0, 0, 0, 10, 1, 0, 0),
(206, 'Oberteil von Vegeta', 2, 'vegetabrust', 'Das Oberteil von Vegetas Rüstung ', 31400, 3, 0, 0, 0, 0, 157, 5, 0, 'vegetabrust', 0, 0, 0, 1, '', 60, 0, 0, 0, 857, 3, 10, 1, 1, 2),
(207, 'Hose von Vegeta', 2, 'vegetahose', 'Die Hose von Vegetas Rüstung. ', 23200, 3, 0, 0, 0, 0, 116, 3, 0, 'vegetahose', 0, 0, 0, 1, '', 60, 0, 0, 0, 816, 3, 10, 1, 1, 2),
(208, 'Handschuhe von Vegeta', 2, 'vegetahand', 'Die Handschuhe von Vegetas Rüstung.', 21000, 3, 0, 0, 0, 0, 105, 2, 0, 'vegetahand', 0, 0, 0, 1, '', 60, 0, 0, 0, 805, 3, 10, 1, 1, 2),
(209, 'Schuhe von Vegeta', 2, 'vegetaschuhe', 'Die Schuhe von Vegetas Rüstung.', 14000, 3, 0, 0, 0, 0, 70, 7, 0, 'vegetaschuhe', 0, 0, 0, 1, '', 60, 0, 0, 0, 770, 3, 10, 1, 1, 2),
(210, 'Aura von Vegeta', 2, 'vegetaaura', 'Die Aura von Vegeta', 48000, 3, 0, 0, 80, 80, 240, 1, 0, 'vegetaaura', 0, 0, 0, 1, '', 60, 0, 0, 0, 900, 0, 10, 1, 0, 0),
(215, 'Namekianischer Salat', 1, 'nameksalat', 'Ein saftig schmeckender Salat, der kein Dressing benötigt.', 25000, 1, 5000, 0, 0, 0, 5000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(216, 'Namekianischer Softdrink', 1, 'nameksoftdrink', 'Ein erfrischender Softdrink.\r\nNach was schmeckt er nur?', 25000, 1, 0, 5000, 0, 0, 5000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(217, 'Namekianisches Frühstück', 1, 'namekfruhstuck', 'Ein herzhaftes Frühstück.\r\nNamekianer lieben es!', 40000, 1, 10000, 0, 0, 0, 10000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(218, 'Namekianischer Tee', 1, 'namektee', 'Ein namekianischer Tee, so grün wie seine Einwohner.', 40000, 1, 0, 10000, 0, 0, 10000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(219, 'Namekianische Wings', 1, 'namekwings', 'Zarte Wings aus saftigem Dinofleisch des Planeten Namek.', 70000, 1, 10000, 10000, 0, 0, 10000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0),
(220, 'Namekianische Heilsuppe', 1, 'namekheilsuppei', 'Eine kräftigende Heilsuppe.', 100000, 1, 15000, 15000, 0, 0, 15000, 0, 0, '', 0, 0, 0, 1, '', 0, 0, 0, 0, 0, 3, 10, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lastfights`
--

CREATE TABLE `lastfights` (
  `id` int(10) NOT NULL,
  `type` int(2) NOT NULL,
  `place` varchar(90) NOT NULL,
  `planet` varchar(90) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `mode` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `round` int(4) NOT NULL DEFAULT 1,
  `text` longtext NOT NULL,
  `levelup` tinyint(1) NOT NULL,
  `zeni` int(10) NOT NULL,
  `items` longtext NOT NULL,
  `gainaccs` longtext NOT NULL,
  `story` int(10) NOT NULL,
  `challenge` int(11) NOT NULL,
  `survivalteam` int(2) NOT NULL,
  `survivalrounds` int(4) NOT NULL,
  `npcid` int(4) NOT NULL,
  `npcmode` varchar(10) NOT NULL,
  `event` int(11) NOT NULL,
  `eventfight` int(3) NOT NULL DEFAULT 0,
  `healing` tinyint(1) NOT NULL,
  `tournament` int(11) NOT NULL,
  `dragonball` int(11) NOT NULL,
  `weather` int(2) NOT NULL,
  `survivalwinner` int(2) NOT NULL,
  `healthratio` int(3) NOT NULL,
  `healthratioteam` int(2) NOT NULL,
  `healthratiowinner` int(2) NOT NULL,
  `debuglog` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sessionid` varchar(30) NOT NULL,
  `betreff` varchar(30) NOT NULL,
  `ip` varchar(90) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `statsid` int(11) NOT NULL,
  `visualid` int(11) NOT NULL,
  `amount` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `statstype` int(2) NOT NULL,
  `upgrade` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `News`
--

CREATE TABLE `News` (
  `id` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `authorname` varchar(30) NOT NULL,
  `authorimage` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(30) NOT NULL,
  `text` longtext CHARACTER SET utf8 NOT NULL,
  `kommentare` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `npcs`
--

CREATE TABLE `npcs` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `description` longtext NOT NULL,
  `lp` int(10) NOT NULL,
  `mlp` int(11) NOT NULL,
  `kp` int(10) NOT NULL,
  `mkp` int(11) NOT NULL,
  `attack` int(10) NOT NULL,
  `defense` int(10) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `reflex` int(11) NOT NULL,
  `attacks` longtext NOT NULL,
  `zeni` int(10) NOT NULL,
  `items` longtext NOT NULL,
  `survivalrounds` int(4) NOT NULL,
  `survivalteam` int(2) NOT NULL,
  `survivalwinner` int(2) NOT NULL,
  `race` varchar(30) NOT NULL,
  `healthratio` int(3) NOT NULL,
  `healthratioteam` int(2) NOT NULL,
  `healthratiowinner` int(2) NOT NULL,
  `playerattack` int(11) NOT NULL,
  `patterns` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `npcs`
--

INSERT INTO `npcs` (`id`, `name`, `image`, `description`, `lp`, `mlp`, `kp`, `mkp`, `attack`, `defense`, `accuracy`, `reflex`, `attacks`, `zeni`, `items`, `survivalrounds`, `survivalteam`, `survivalwinner`, `race`, `healthratio`, `healthratioteam`, `healthratiowinner`, `playerattack`, `patterns`) VALUES
(1, 'Tiger', 'tiger', 'Ein wilder, fleischfressender Tiger', 80, 80, 80, 80, 8, 8, 100, 100, '1', 250, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(2, 'Pterodactyl', 'pterodactyl', 'Dieser Flugsaurier ist eindeutig ein Fleischfresser. ', 300, 300, 300, 300, 30, 30, 100, 100, '1;2', 1000, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(3, 'Bärendieb', 'baerendieb', 'Ein bärischer Dieb, der mit einem Schwert umgehen kann.', 500, 500, 500, 500, 50, 50, 100, 100, '1;2;53', 1500, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(4, 'Wolf', 'wolf', 'Ein Wolf der sich fernab seines Rudels zum Kampf stellt. ', 700, 700, 700, 700, 70, 70, 100, 100, '50;51;52', 2000, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(5, 'Erzaehler', 'erzaehler', 'Der Erzähler, der die Geschehnisse des Spielers kommentiert.', 1000000000, 1000000000, 1000000000, 1000000000, 1000000000, 1000000000, 100, 100, '1;35;37;41;44;48;63;75;91;108;117;133', 0, '', 0, 0, 0, '', 0, 0, 0, 13, ''),
(6, 'Auto', 'auto', 'Bulmas Auto außer zur Fortbewegung ist es für nix zu gebrauchen', 500, 500, 100, 100, 10, 10, 100, 100, '49;285', 500, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(7, 'Oolong', 'oolong', 'Oolong ist ein Schwein und Formwandler, manchmal nutzt er das zu seinem Vorteil.', 1250, 1250, 1250, 1250, 125, 125, 100, 100, '1;2', 3000, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(8, 'Yamchu (Wüstenbandit)', 'yamchu', 'Yamchu ein Wüstenbandit und guter Freund von Pool.', 1750, 1750, 1750, 1750, 175, 175, 100, 100, '1;288;307', 4000, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(9, 'Pool', 'pool', 'Pool ist ein kleines schwebendes Wesen und der beste Freund von Yamchu. Er ist zudem ein Formwandler und kann sich in alles verwandeln. Im Verwandlungskindergarten war er in einer Klasse mit Oolong, bis dieser aufgrund schlechten Benehmens des Kindergartens verwiesen wurde. ', 1500, 1500, 1500, 1500, 150, 150, 100, 100, '1;286;287;307', 3500, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(10, 'Kid Krillin', 'trainingsinsel_krillin', 'Krillin ist eine sehr ruhige Person. Er besitzt eine Glatze und ist außerdem sehr klein. ', 3250, 3250, 3250, 3250, 325, 325, 100, 100, '1;36;307', 6000, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(11, 'Muten Roshi', 'mutenroshi', 'Der Herr Der Schildkröten ist Muten Roshi der lehrer von Son Goku und Krillin als sie noch Kinder waren', 1900, 1900, 1900, 1900, 190, 190, 100, 100, '1;2;3;4;307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(12, 'Oger', 'oga', 'Oolong in der Form eines Ogers.', 2000, 2000, 500, 500, 50, 200, 100, 100, '1;286;307', 3000, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(13, 'Stier', 'stier', 'Oolong in der Form eines Stieres.', 1000, 1000, 1000, 1000, 200, 100, 100, 100, '1;286;307', 3000, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(14, 'Nam', 'nam', 'Nam ist ein Kämpfer für sein Dorf er scheut keinen weg und mühen um beim Tunier teilzunehmen um mit dem preisgeld wasser für sein Dorf zukaufen da dort seit langem eine Dürre herscht', 5000, 5000, 5000, 5000, 500, 500, 100, 100, '1;3;4;7;307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(15, 'Gilian', 'Gilian', 'Gilian ist ist ein böser Schummler, und pfeift auf Fairness und Sportgeist seine geheimwaffe ist sein speichel er spuckt diesen auf seine gegner die sich wen sie getroffen werden nicht mehr bewegen können', 4800, 4800, 4800, 4800, 480, 480, 100, 100, '1;3;7;307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(16, 'Jackie Chun', 'Jackie_Chun', 'Jackie Chun ist eine Alternative Identität des Herrn der Schildkröten. Als Jackie Chun nimmt er am Tunier teil', 10000, 10000, 5200, 5200, 120, 500000, 100, 100, '1;2;3;7;78;307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(17, 'Prinz Pilaf', 'pilaf', 'Pilaf ist ein reicher, kluger und kleiner blauer Erdling.', 2500, 2500, 2500, 2500, 250, 250, 100, 100, '1;36;307', 4750, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(18, 'Mai', 'mai', 'Mai gehört neben Shu zu Prinz Pilafs Gefolge.', 2700, 2700, 2700, 2700, 270, 270, 100, 100, '1;36;307', 5250, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(19, 'Shu', 'shu', 'Shu ist ein kleiner Hunde ähnliche Gestalt, die jedoch nicht zu unterschützen ist, auch wen er manchmal tollpatschig ist.', 2600, 2600, 2600, 2600, 260, 260, 100, 100, '1;36;307', 5000, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(20, 'Diener', 'diener', 'Ein Diener', 10, 10, 10, 10, 19, 6, 100, 100, '1;1', 0, '', 0, 0, 0, 'Namekianer', 0, 0, 0, 0, ''),
(21, 'Dummy', 'dummy', 'Ich Bin ein Test Dummy', 1000000, 1000000, 1000000, 1000000, 1000000, 1000000, 100, 100, '1;2;3;4;50;51;52;57;64;158;159', 0, '', 0, 0, 0, 'Saiyajin', 0, 0, 0, 0, ''),
(22, 'Bakterian', 'Bakterian', 'Bakterian ist ein Kämpfer, der beim Großen Turnier teilnimmtm. Er hat sich in seinem Leben nur ein einziges Mal gewaschen und stinkt daher fürchterlich. Aufgrund seines Gestanks besiegt er viele Kämpfer im Turnier. ', 800, 800, 800, 800, 80, 80, 100, 100, '1;2;3;50;51;52;307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(24, 'Ranfan', 'Ranfan', 'Ranfan nimmt am 21. Tenkaichi Bud?kai teil, als Son Goku und Kuririn zum ersten Mal dort antraten.', 2000, 2000, 2000, 2000, 200, 200, 100, 100, '1;2;3;50;51;52;307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(25, 'Meister Korin', 'meisterkorin', 'Meister Quitte ist ein über 800 Jahre alter Kater, der auf dem Quittenturm wohnt. Ursprünglich kommt Meister Quitte aus dem Jenseits, wie er aber auf die Erde gekommen ist, bleibt bisher unbekannt. Er gilt als Meister der Kampfkunst und genießt daher große Anerkennung.', 1000, 1000, 1000, 1000, 2000, 1000, 100, 1000, '1;2', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(26, 'Shark', 'shark', 'Ein gefräiger Räuber der Meere, welcher seine Beute aus dem Nichts anfällt.', 2700, 2700, 2700, 2700, 270, 270, 100, 100, '188;189', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(27, 'Lunch', 'lunch1', 'Dies ist ein Event NPC\r\nEvent: XXXX', 900, 900, 900, 900, 50, 50, 100, 100, '1;2;3;190', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(28, 'Bad Lunch', 'badlunch', 'Eine blonde Frau, doch woher kommt sie? Und wo ist Lunch?', 3000, 3000, 3000, 3000, 300, 300, 100, 100, '1;288;292;307', 5500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(29, 'Lunchs Fiffy', 'Fiffy', 'Dies ist ein Event NPC\r\nEvent: XXXX', 900, 900, 900, 900, 50, 50, 100, 100, '50;51;52', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(30, 'Bad Lunch SSJ', 'lunch2', 'Dies ist ein Event NPC\r\nEvent: XXXX', 5000, 5000, 5000, 5000, 100, 100, 100, 100, '1;2;3;56;190;191', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(31, 'Kraftprotz Krillin', 'Kuririn', 'Krillin ist eine sehr ruhige Person. Er besitzt eine Glatze und ist außerdem sehr klein. ', 2900, 2900, 2900, 2900, 290, 290, 100, 100, '1;2;3;4;185', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(32, 'Igor', 'igor', 'Der Treudoofe Igor, liest seinem Meister jeden Wunsch von den Lippen ab.\r\n', 3100, 3100, 3100, 3100, 310, 310, 100, 100, '2;192;193', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(33, 'Gastel', 'Gastel', 'Ghastel der Torwächter, sein Geschlecht ist bis Heute ein gut gehütetes Geheimnis.', 3400, 3400, 3400, 3400, 340, 340, 100, 100, '2;3;194;195', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(34, 'Lucifer', 'vampier', 'Ein Vampir-Damon der Angst vor der Sonne, wie auch Knoblauch hat. Was für ein armer Wicht, aber die Sonnenbrille sitzt', 4600, 4600, 4600, 4600, 400, 400, 100, 100, '2;196;197', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(35, 'Roboter', 'roboter', 'Der Prinz mit dem Wunsch zur Weltherrschaft in seinem treuen Kampfroboter. Leider von schlechter Qualität und leicht zerstörbar.', 3800, 3800, 3800, 3800, 380, 380, 100, 100, '198;199;200;201', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(36, 'Meister Lampe', 'lampe', 'Der Kopf der Hasenbande. Er terrorisiert nicht nur den Nachbarbau.', 4000, 4000, 4000, 4000, 400, 400, 100, 100, '1;2;202;203', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(37, 'Old Kai', 'Old Kai', 'Der alte Kaioshin wurde vor 15 Generationen von Beerus in einem Schwert versiegelt.\r\n\r\nDas Siegel scheint über die Jahre schwächer geworden zu sein, denn manchmal gelingt es ihm sich irgendwo zu Manifestieren um anderen Kaioshins sein wissen anzubieten.', 100000000, 100000000, 100000000, 100000000, 100000000, 100000000, 100, 100, '126', 0, '', 0, 0, 0, 'Kaioshin', 0, 0, 0, 0, ''),
(38, 'Schildkröte', 'kröte', 'Dies ist ein Event NPC\r\nEvent: XXXX', 6000, 6000, 6000, 6000, 90, 120, 100, 100, '3;204;205', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(39, 'Son Goku', 'Goku_Kid', 'Dies ist ein Event NPC\r\nEvent: XXXX', 1500, 1500, 1500, 1500, 150, 150, 100, 100, '1;2;3;4', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(40, 'Krillin', 'Kid_Krillin', 'Dies ist ein Event NPC\r\nEvent: XXXX', 1500, 1500, 1500, 1500, 150, 150, 100, 100, '1;2;3;4', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(41, 'Muten Roshi', 'Roshisssss', 'Dies ist ein Event NPC\r\nEvent: XXXX', 1700, 1700, 1700, 1700, 170, 170, 100, 100, '1;2;3;4', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(42, 'Son Goku', 'Kid_Goku_after', 'Dies ist ein Event NPC\r\nEvent: XXXX', 1650, 1650, 1650, 1650, 165, 165, 100, 100, '1;2;3;185', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(43, 'Krillin', 'Kid_Krillin_After', 'Dies ist ein Event NPC\r\nEvent: XXXX', 1650, 1650, 1650, 1650, 165, 165, 100, 100, '1;2;3;185', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(44, 'Muten Roshi  (Max Power)', 'Roshi_Max', 'Dies ist ein Event NPC\r\nEvent: XXXX', 2000, 2000, 5000, 5000, 180, 180, 100, 100, '1;2;3;78;185', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(45, 'Muten Roshi', 'herr', 'Der berühmteste Kämpfer der Erde... nach Mister Satan...\r\nMuten Roshi ist wahrhaft mit allen Wassern gewaschen und hat schon viele Schüler in den Kampfkünsten unterwiesen. Es gibt keinen Besseren!', 1000000000, 1000000000, 1000000000, 1000000000, 1000000000, 1000000000, 100, 100, '7', 0, '', 0, 0, 0, 'Saiyajin', 0, 0, 0, 0, ''),
(46, 'Chaozu', 'Chiaotzu', 'Einfügen', 10000000, 10000000, 10000000, 10000000, 10000000, 10000000, 100, 100, '93', 0, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, ''),
(47, 'Mini Cell', 'minimi', 'Das ist ein Minicell', 10, 10, 10, 10, 19, 6, 100, 100, '1', 0, '', 0, 0, 0, 'Bio-Android', 0, 0, 0, 0, ''),
(48, 'Dorfbewohner', 'dorfbewohner', 'Ein Bewohner des Dorfes', 750, 750, 750, 750, 75, 75, 100, 100, '1;2', 2000, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(49, 'Feuer', 'feuernpc', 'Ein wildes Feuer', 10000, 10000, 10000, 10000, 200, 1000, 100, 100, '289', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(50, 'Karottenmonster', 'karottenmonster', 'Das Karottenmonster ist der Chef der Karottenbande', 2250, 2250, 2250, 2250, 225, 225, 100, 100, '1;36;288;307', 4500, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(51, 'Pilafs Schloss', 'pilafschlossnpc', 'Das Schloss von Pilaf.', 3000, 3000, 3000, 3000, 200, 300, 100, 100, '290;291;323', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(52, 'Hai', 'hai', 'Ein Hai aus dem Meer', 3000, 3000, 3000, 3000, 300, 300, 100, 100, '301;315', 5500, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(53, 'T-Rex', 'trextrainingsinsel', 'Ein T-Rex von der Trainingsinsel.', 3000, 3000, 3000, 3000, 300, 300, 100, 100, '302;315', 5500, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(54, 'Bakterian', 'bakterian', 'Ein stinkender Typ.', 3500, 3500, 3500, 3500, 350, 350, 100, 100, '303;307', 6500, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(55, 'Startnummer 69', 'startnummer69', 'Die Nummer 69 im großen Turnier', 3500, 3500, 3500, 3500, 700, 350, 100, 100, '1;288;307', 6500, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(56, 'Gilian', 'gilian', 'Ein intelligenter Flugsaurier.', 3750, 3750, 3750, 3750, 375, 375, 100, 100, '1;36;307', 7000, '', 0, 0, 0, '', 0, 0, 0, 0, '12'),
(57, 'Nam', 'nam', 'Ein Mönch', 4000, 4000, 4000, 4000, 400, 400, 100, 100, '1;36;307', 7500, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, '12'),
(58, 'Jackie Chun', 'jackychun', 'Ein alter Mann der jedoch sehr stark ist.', 4250, 4250, 4250, 4250, 425, 425, 100, 100, '36;37;307', 8000, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, '11'),
(59, 'Oberst Silver', 'oberstsilver', 'Ein Oberst der Red Ribbon Army.', 4500, 4500, 4500, 4500, 450, 450, 100, 100, '1;36;307', 8500, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, '12'),
(60, 'RR Soldaten', 'rrsoldaten', 'Soldaten der Red Ribbon Army.', 4750, 4750, 4750, 4750, 475, 475, 100, 100, '305;314', 9000, '', 0, 0, 0, '', 0, 0, 0, 0, '14'),
(61, 'Leutnant Metallic', 'leutnantmetallic', 'Leutnant der Red Ribbon Army.', 5000, 5000, 5000, 5000, 500, 500, 100, 100, '1;36;37;307', 10000, '', 0, 0, 0, 'Android', 0, 0, 0, 0, '11'),
(62, 'Ninja Lila', 'ninjalila', 'Ein Ninja aus der Red Ribbon Army', 5250, 5250, 5250, 5250, 525, 525, 100, 100, '306;307', 10500, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, '11'),
(63, 'Buyon', 'buyon', 'Ein lilanes Monster was aus einer Gummimasse besteht.', 6000, 6000, 5000, 5000, 500, 600, 100, 100, '2;37;307', 11000, '', 0, 0, 0, 'Demon', 0, 0, 0, 0, '11'),
(64, 'General White', 'generalwhite', 'Ein General der Red Ribbon Army, bekannt durch seine Haare.', 5750, 5750, 5750, 5750, 575, 575, 100, 100, '308;314', 11500, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, '14'),
(65, 'Piraten-Roboter', 'piratenroboter', 'Ein Roboter der von Piraten gebaut worden ist.', 6250, 6250, 6250, 6250, 625, 625, 100, 100, '308;309;314', 12500, '', 0, 0, 0, '', 0, 0, 0, 0, '14'),
(66, 'Octopapa', 'octopapa', 'Ein riesiger blauer Octopus', 6500, 6500, 6500, 6500, 700, 600, 100, 100, '307;310', 13000, '', 0, 0, 0, 'Majin', 0, 0, 0, 0, '11'),
(67, 'General Blue', 'generalblue', 'Ein General der Red Ribbon Army.', 6500, 6500, 6000, 6000, 800, 650, 100, 100, '311;314', 13500, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, '14'),
(68, 'Arale', 'arale', 'Ein kleines Mädchen das ein großes Geheimnis in sich birgt.', 8000, 8000, 6000, 6000, 700, 700, 100, 100, '307;312', 14000, '', 0, 0, 0, 'Majin', 0, 0, 0, 0, '11'),
(69, 'Straßenboxer', 'strassenboxer', 'Ein Boxer der auf der Straße für Geld boxt.', 6000, 6000, 6000, 6000, 600, 600, 100, 100, '307;313', 12000, '', 0, 0, 0, 'Mensch', 0, 0, 0, 0, '11'),
(70, 'Oberst Yellow', 'oberstyellow', 'Ein Oberst der Red Ribbon Army', 7250, 7250, 7250, 7250, 725, 725, 100, 100, '308;314', 14500, '', 0, 0, 0, '', 0, 0, 0, 0, '14'),
(71, 'Tao BaiBai', 'taobaibai', 'Ein Profikiller der für die Red Ribbon Army arbeitet', 8000, 8000, 7000, 7000, 900, 800, 100, 100, '228;307', 16000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(72, 'Oozaru', 'oozaru', 'Ein wütender Oozaru', 5000, 5000, 1000, 1000, 250, 250, 100, 100, '37;300;307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(73, 'Gatchan', 'gatchan', 'Kleine fliegende Mädchen.', 3000, 3000, 3000, 3000, 700, 700, 100, 100, '307;316', 14000, '', 0, 0, 0, 'Majin', 0, 0, 0, 0, '11'),
(74, 'Adjutant Black', 'adjutantblack', 'Ein Assistent von Kommander Red', 8500, 8500, 8000, 8000, 825, 825, 100, 100, '314;318', 16500, '', 0, 0, 0, '', 0, 0, 0, 0, '14'),
(75, 'Adjutant Black', 'adjutantblackarmor', 'Der Assistent von Kommander Red in einer Rüstung', 9000, 9000, 8000, 8000, 825, 875, 100, 100, '314;317', 17000, '', 0, 0, 0, '', 0, 0, 0, 0, '14'),
(76, 'Inkognito', 'inkognito', 'Ein unsichtbarer Mensch', 4000, 4000, 8000, 8000, 1000, 900, 100, 200, '307;320', 17500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(77, 'Dracula', 'dracula', 'Ein Vampir', 9000, 9000, 8000, 8000, 1000, 900, 100, 100, '307;322', 18000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(78, 'Die Mumie', 'mumie', 'Eine Mumie die von Uranai zum Leben erweckt worden ist.', 9000, 9000, 8000, 8000, 900, 1000, 100, 100, '307;319', 18000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(79, 'Akkuman', 'akkuman', 'Der Teufel in Person', 9250, 9250, 8000, 8000, 925, 925, 100, 100, '307;321', 18500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(80, 'Der maskierte Mann', 'dermaskiertemann', 'Ein Maskierter Mann der einen Heiligenschein trägt.', 10000, 10000, 8000, 8000, 950, 900, 100, 100, '179;307', 19000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(81, 'Pilafs Maschine', 'pilafmachine', 'Eine Maschine von Pilaf die aus mehreren Robotern besteht.', 10000, 10000, 8000, 8000, 900, 1000, 100, 100, '314;317', 19500, '', 0, 0, 0, '', 0, 0, 0, 0, '14'),
(82, 'King Chapa', 'kingchapa', 'Man sagt, er habe bei einen Turnier gewonnen, ohne berührt worden zu sein.', 10000, 10000, 10000, 10000, 1000, 1000, 100, 100, '307;324', 20000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(83, 'Pamput', 'pamput', 'Ein berühmter Filmstar.', 10500, 10500, 10500, 10500, 1025, 1025, 100, 100, '307;313', 20500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(84, 'Krillin', 'krillinwtm', 'Krillin beim großen Turnier.', 10500, 10500, 10500, 10500, 1050, 1100, 100, 100, '179;307', 21000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(85, 'Chiaotzu', 'chiaotzu', 'Der Begleiter von Tenshinhan', 10000, 10000, 10000, 10000, 1000, 1000, 100, 100, '228;307', 20500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(86, 'Tenshinhan', 'tenshinhanwtm', 'Ein Schüler der Kranich Schule', 11000, 11000, 10500, 10500, 1100, 1050, 100, 100, '228;229;307', 21500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(88, 'Yajirobi', 'yajirobi', 'Ein herrenloser Samurai, welcher durch die Prärie wandert. ', 15000, 15000, 5000, 5000, 1400, 1100, 100, 100, '331;333;335', 22000, '', 0, 0, 0, '', 0, 0, 0, 0, '13'),
(89, 'Zimbel', 'zimbel', 'Ein großes drachenähnliches Monster, welches irgendwie in Beziehung zu Oberteufel Piccolo steht. ', 15000, 15000, 5000, 5000, 1400, 1200, 100, 100, '307;332;334', 22500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(90, 'Oberteufel Piccolo (Alt)', 'oberteufelpiccoloalt', 'Der Oberteufel terrorisierte einst schon mal die Welt und ist nun wieder dabei, diese zu erobern. ', 16000, 16000, 5000, 5000, 1700, 1300, 100, 100, '307;332;334', 24000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(91, 'Muten Roshi (Finsternis)', 'mutenroshifinsternis', 'Eine merkwürdige Gestalt, die sich als Muten Roshi ausgibt. ', 16000, 16000, 5000, 5000, 1600, 1200, 100, 100, '179;180;307', 24500, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(92, 'Trommel', 'trommel', 'Ein großes dickes Monster, welches vom jungen Oberteufel erschaffen wurde. ', 18000, 18000, 5000, 5000, 1200, 1800, 100, 100, '20;307;332;334', 25000, '', 0, 0, 0, '', 0, 0, 0, 0, '15;11'),
(93, 'Oberteufel Piccolo (Jung)', 'oberteufelpiccolojung', 'Der Oberteufel in seiner Höchstform. ', 18000, 18000, 5000, 5000, 1800, 1300, 100, 100, '157;158;307', 26000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(94, 'Tamburin', 'tamburin', 'Ein grünes geflügeltes Monster, welches Krillin getötet hat. Es steht in Verbindung zum Oberteufel Piccolo. ', 15000, 15000, 5000, 5000, 1600, 1100, 100, 100, '307;332;334', 23000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(95, 'Test-Dummy', 'testdummy', 'Ein Test-Dummy, der zum testen da ist. ', 100, 100, 5000, 5000, 10, 10, 100, 100, '307', 0, '', 0, 0, 0, '', 0, 0, 0, 0, '16'),
(96, 'Mr. Popo', 'mrpopo', 'Mr. Popo ist eine sehr alte Persönlichkeit (sogar noch älter als Gott selbst), welche Gott dient und dessen Garten pflegt.', 12000, 12000, 4000, 4000, 5000, 1400, 100, 250, '2;287;288', 26500, '', 0, 0, 0, '', 50, 1, 0, 0, ''),
(97, 'Chichi', 'chichi', 'Chichi ist die Tochter des Rinderteufels und eine begabte Kampfkünstlerin. ', 20000, 20000, 5000, 5000, 1900, 1400, 100, 100, '307;336', 27000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(98, 'Tenshinhan', 'tenshinhanwtm2', 'Der ehemalige Sieger des Turniers und ein Rivale des Spielers. ', 20000, 20000, 5000, 5000, 2000, 1400, 100, 100, '229;307', 28000, '', 0, 0, 0, '', 0, 0, 0, 0, '11'),
(99, 'Piccolo', 'piccolo', 'Die Reinkarnation des Oberteufels. Er hat sich beim Turnier angemeldet, um sich am Spieler rächen zu können. ', 20000, 20000, 5000, 5000, 2100, 1400, 100, 100, '159;307', 28500, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(100, 'Yamchu', 'yamchuwtm2', 'Yamchu ist ein ehemaliger Bandit und Schüler der Schildkrötenschule. Er sieht den Spieler als seinen Rivalen an. ', 21000, 21000, 5000, 5000, 2200, 1400, 100, 100, '54;61;307', 29000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(101, 'Krillin', 'krillinwtm2', 'Krillin ist ein Schüler der Schildkrötenschule und ein guter Freund des Spielers. ', 22000, 22000, 5000, 5000, 2200, 1400, 100, 100, '182;307', 30000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(102, 'Piccolo', 'piccoloss', 'Die Reinkarnation des Oberteufels. Geht eine Allianz mit dem Spieler ein um Radditz zu besiegen. ', 20000, 20000, 5000, 5000, 2500, 1400, 100, 100, '159;307;344', 0, '', 0, 0, 0, '', 0, 0, 0, 0, '5;6'),
(103, 'Radditz', 'radditz', 'Ein Außerirdischer, welcher jegliche Lebensform auf den Planeten auslöschen möchte. ', 22000, 22000, 5000, 5000, 2300, 1800, 100, 100, '307;345', 35000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(104, 'Enma Daio', 'enmadaio', 'Der Richter des Jenseits. Er entscheidet über das Schicksal der Verstorbenen. ', 23000, 23000, 5000, 5000, 2300, 1800, 100, 100, '307;346', 35000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(105, 'Bananas', 'bananas', 'Ein flinker und schneller Affe. Außerdem das Haustier von Meister Kaio. ', 30000, 30000, 1000, 1000, 1400, 2500, 100, 120, '342;349', 0, '', 0, 0, 0, '', 0, 0, 0, 338, '7'),
(106, 'Gregory', 'gregory', 'Ein flinkes Insekt, welches Meister Kaio dient. Es scheint ziemlich schadenfroh zu sein. ', 35000, 35000, 100, 100, 10, 3500, 100, 1000, '2;340', 0, '', 0, 0, 0, '', 0, 0, 0, 339, '8'),
(107, 'Pflanzenmann', 'pflanzenmann', 'Eine kleine grünliche Kreatur, welche den Saiyajins als Trainingspartner dient. ', 25000, 25000, 5000, 5000, 2500, 1700, 100, 100, '307;337;347', 37000, '', 0, 0, 0, '', 0, 0, 0, 0, '9;6'),
(108, 'Nappa', 'nappa', 'Eine starker, aber nicht sehr heller Krieger. Er ist sehr brutal und spielt gerne mit seinen Gegnern.', 26000, 26000, 5000, 5000, 2500, 2000, 100, 100, '307;350', 38000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(109, 'Vegeta', 'vegetass', 'Der Prinz der Saiyajins. Unglaublich stolz, aber auch unglaublich stark. ', 27000, 27000, 7500, 7500, 2650, 1900, 100, 100, '307;351', 39000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(110, 'Vegeta (Wehraffe)', 'vegetaaffe', 'Der Prinz der Saiyajins, welcher sich in einen riesigen Affen verwandelt hat. ', 54000, 54000, 7500, 7500, 5300, 3800, 100, 100, '307;348;351', 100000, '', 0, 0, 0, '', 0, 0, 0, 0, '18;6'),
(111, 'Mez', 'mez', 'Mez ist ein großer Oger und einer von zwei Wächter des Baumes.', 21000, 21000, 5000, 5000, 1800, 2100, 100, 100, '307;352', 33000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(112, 'Goz', 'goz', 'Goz ist ein großer Oger und einer von zwei Wächter des Baumes.', 21000, 21000, 5000, 5000, 2100, 1800, 100, 100, '307;352', 33000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(113, 'Cui', 'cuia', 'Ein Handlanger von Freezer, der auf Planet Namek sein Unwesen treibt.', 55000, 55000, 7000, 7000, 5400, 3800, 100, 100, '307;353;355', 40000, '', 0, 0, 0, '', 0, 0, 0, 0, '17;6'),
(114, 'Dodoria', 'dodorianeu', 'Die rechte Hand von Freezer. Ein gnadenloser und mächtiger Krieger.', 57000, 57000, 8000, 8000, 5600, 4100, 100, 100, '307;358', 41000, '', 0, 0, 0, '', 0, 0, 0, 0, '19;6'),
(115, 'Zarbon ', 'zarbon', 'Ein Elite Krieger von Freezer. Er verbindet Eleganz mit Tödlichkeit.', 60000, 60000, 9000, 9000, 5750, 4250, 100, 100, '307;359', 42000, '', 0, 0, 0, '', 0, 0, 0, 0, '20;21;6'),
(116, 'Zarbon (Monster Form)', 'zarbon2', 'Ein Elite Krieger von Freezer in seiner grotesken Form.', 60000, 60000, 9000, 9000, 5750, 4250, 100, 100, '307;359', 43000, '', 0, 0, 0, '', 0, 0, 0, 0, '22;6'),
(117, 'Guldo', '', 'Ein Mitglied der Ginyu Force. Körperlich nicht sehr stark, kann aber die Zeit anhalten.', 47000, 47000, 5200, 5200, 4700, 4200, 100, 100, '307;365', 44000, '', 0, 0, 0, '', 0, 0, 0, 0, '23;6'),
(118, 'Rikuum', 'rikuum', 'Ein Mitglied der Ginyu Force. Besitzt große Stärke. Ist dennoch nicht der Klügste.', 49000, 49000, 5400, 5400, 4800, 4200, 100, 100, '307;366', 47000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(119, 'Rikuum (Zerstörte Kleidung)', 'rikuumwtm', 'Ein Mitglied der Ginyu Force. Besitzt große Stärke. Ist dennoch nicht der Klügste.', 49000, 49000, 5400, 5400, 5000, 4000, 100, 100, '307;366', 50000, '', 0, 0, 0, '', 0, 0, 0, 0, '6;24'),
(120, 'Jeice', 'jeice', 'Ein Mitglied der Ginyu Force. Fällt auf durch seine besonders rote Haut. Er ist ein starker Kämpfer mit narzisstischen Charakterzügen. ', 43000, 43000, 5000, 5000, 4700, 3000, 100, 120, '1;307;368', 52000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(121, 'Burter', 'burter', 'Ein Mitglied der Ginyu Force. Behauptet von sich der schnellste Krieger im Universum zu sein.', 46000, 46000, 5000, 5000, 4700, 3100, 100, 100, '1;307;370', 52000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(122, 'Kommandant Ginyu', 'ginyu', 'Kommandant der Ginyu Force. Besitzt die Fähigkeit mit anderen Lebewesen Körper zu tauschen.', 50000, 50000, 5500, 5500, 5000, 4600, 100, 100, '1;307;369', 55000, '', 0, 0, 0, '', 0, 0, 0, 0, '6;25'),
(123, 'Kommandant Ginyu (Body Swap)', 'bodyswap', 'Kommandant der Ginyu Force, der mit SonGoku den Körper getauscht hat.', 50000, 50000, 5500, 5500, 5000, 4600, 100, 100, '1;307;369', 55000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(124, 'Freezer', 'freezer', 'Ein Tyrann einer Planeten erobernden Rasse. Hat den Planeten Vegeta zerstört. ', 54000, 54000, 5700, 5700, 5400, 5000, 100, 100, '1;307', 60000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(125, 'Freezer (2te Form)', 'freezerzwei', 'Freezer in seiner zweiten Form. ', 56000, 56000, 6000, 6000, 5600, 5200, 100, 100, '1;307', 65000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(126, 'Freezer (3te Form)', 'freezerdrei', 'Freezer in seiner dritten Form.', 58000, 58000, 6200, 6200, 5800, 5400, 100, 100, '1;307', 70000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(127, 'Freezer (Finale Form)', 'freezerfinal', 'Freezer in seiner finalen Form. Er nutzt diese als Trumpfkarte nach dem er in die Ecke gedrückt wurde.', 65000, 65000, 8200, 8200, 6300, 5800, 100, 100, '1;307', 100000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(128, 'Freezer 100%', 'freezerw', 'Freezer in seiner 100% Form. Sein letzter Ausweg um gegen die neue Transformation seines Gegners zu kämpfen.', 130000, 130000, 8200, 8200, 12400, 10600, 100, 100, '1;307', 250000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(129, 'Wütende Chichi', 'Angrychichi', 'Die wütende Chichi stellt sich unserem Helden in den Weg.', 50000, 50000, 10000, 10000, 10, 5000, 100, 1000, '1', 0, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(130, 'Gedanken-Krillin', 'KrillinRaumschiff', 'Krillin, der sich während der Reise als Trainingspartner für einen Gedankenkampf anbietet.', 50000, 50000, 15000, 15000, 4000, 2500, 100, 100, '1;372', 10000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(131, 'CC Test', 'cctestdummy', 'Test Dummy für CC.', 20000, 20000, 20000, 20000, 5400, 3000, 100, 100, '1;286;287;288', 250, '', 0, 0, 0, '', 0, 0, 0, 0, ''),
(132, 'Dinosaurier', 'dinosaur', 'Ein gefräßiger Dinosaurier, dessen Leibspeise Dragonballs sind. ', 60000, 60000, 10000, 10000, 5000, 3000, 100, 100, '1;373', 50000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(133, 'Tornado', 'tornado', 'Ein riesiger Tornado, der die auf der Erde um Längen überragt.', 60000, 60000, 12000, 12000, 5500, 3500, 100, 80, '375;376', 50000, '', 0, 0, 0, '', 0, 0, 0, 0, '6'),
(134, 'Waldvogel', 'Waldvogel', 'Ein Waldvogel, dessen Krallen allein die Größe eines Menschen besitzen.', 65000, 65000, 15000, 15000, 6000, 4000, 100, 100, '1;377', 60000, '', 0, 0, 0, '', 0, 0, 0, 0, '6');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `patterns`
--

CREATE TABLE `patterns` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` int(3) NOT NULL,
  `valuename` varchar(30) NOT NULL,
  `operator` int(1) NOT NULL,
  `value` varchar(30) NOT NULL,
  `isprocent` tinyint(1) NOT NULL,
  `attack` int(11) NOT NULL,
  `patterntarget` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `patterns`
--

INSERT INTO `patterns` (`id`, `name`, `type`, `valuename`, `operator`, `value`, `isprocent`, `attack`, `patterntarget`) VALUES
(2, 'TestRoundOnce', 1, 'round', 2, '5', 0, 4, 0),
(3, 'TestRoundSelfModulo', 1, 'round', 6, '4', 0, 1, 0),
(4, 'TestRoundAll', 1, 'round', 3, '0', 0, 1, 1),
(5, '20% Höllenspirale', 2, 'lp', 1, '20', 1, 344, 4),
(6, 'KP Laden 20% (800KP)', 0, 'kp', 1, '20', 1, 307, 0),
(7, 'Stun (Bananas)', 1, 'round', 6, '10', 0, 342, 1),
(8, 'Stun (Gregory)', 1, 'round', 6, '5', 0, 340, 1),
(9, 'Bombe 15%', 0, 'lp', 1, '15', 1, 337, 1),
(11, 'KP Nachladen 15% (600KP)', 0, 'kp', 1, '15', 1, 307, 0),
(12, 'KP Laden 8% (<100KP)', 0, 'kp', 1, '8', 1, 307, 0),
(13, 'Ausruhen 15% (600KP)', 0, 'kp', 1, '15', 1, 333, 0),
(14, 'Nachladen 15% (600KP)', 0, 'kp', 1, '15', 1, 314, 0),
(15, 'Taunt ', 1, 'round', 6, '3', 0, 20, 1),
(16, 'KP Laden permanent', 0, 'kp', 1, '100', 1, 307, 0),
(17, 'Stun (Cui)', 1, 'round', 6, '7', 0, 355, 1),
(18, 'Super Tech (Vegeta)', 1, 'round', 6, '15', 0, 348, 1),
(19, 'Super Tech Dodoria', 1, 'round', 6, '5', 0, 357, 1),
(20, 'Zarbon Monster Form', 1, 'round', 6, '10', 0, 360, 0),
(21, 'ZarbonAutoLose', 1, 'round', 6, '12', 1, 361, 1),
(22, 'Super Tech Zarbon', 1, 'round', 6, '4', 0, 362, 1),
(23, 'Stun (Guldo)', 1, 'round', 6, '5', 0, 363, 1),
(24, 'Rikuum Fighting Bomber', 1, 'round', 6, '4', 0, 367, 1),
(25, 'Body Swap', 0, 'lp', 1, '20', 1, 371, 1),
(26, 'CCDefensive', 1, 'round', 6, '2', 0, 2, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(90) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `planet` varchar(90) CHARACTER SET utf8 NOT NULL,
  `actions` longtext NOT NULL,
  `items` longtext NOT NULL,
  `npcs` longtext NOT NULL,
  `x` int(4) NOT NULL,
  `y` int(4) NOT NULL,
  `travelable` tinyint(1) NOT NULL DEFAULT 1,
  `display` tinyint(1) NOT NULL DEFAULT 1,
  `trainers` longtext NOT NULL,
  `learnableattacks` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `places`
--

INSERT INTO `places` (`id`, `name`, `image`, `description`, `planet`, `actions`, `items`, `npcs`, `x`, `y`, `travelable`, `display`, `trainers`, `learnableattacks`) VALUES
(1, 'Canyon', 'cynyon', 'Coming Soon', 'Erde', '1;2;3;4;5;11;38;39', '', '', 490, 200, 0, 0, '', ''),
(2, 'Westliche Hauptstadt', 'westlichehauptstadt', 'Die Hauptstadt des Westens. Hier befindet sich auch die Capsule Corp.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;75', '69', 140, 185, 1, 1, '', ''),
(3, 'Muskelturm', 'muskelturm', 'Ein Stützpunkt der Red Ribbon Army im Norden. Der Turm wird von General White bewacht.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11', '61;62;64', 500, 10, 1, 1, '', ''),
(4, 'Check-In Station', 'jenseits', 'Die Check-In Station, zu der alle tote Lebewesen kommen.', 'Jenseits', '1;2;3;4;5;11;38;39;61', '1;2;4;5;6;7;8;9;10;11;12;13', '104', 434, 300, 1, 1, '', ''),
(5, 'Hölle', '', 'Coming Soon', 'Jenseits', '1;2;3;4;5;11;38;39', '', '', 200, 400, 0, 0, '', ''),
(6, 'Wald', 'wald', 'Ein kleiner Wald, in dem viele wilde Tiere leben.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;18;29;30;31;32', '1', 447, 250, 1, 1, '', ''),
(7, 'Hütte', 'huette', 'Eine kleine Hütte, die für eine Person ausreicht.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;18;29;30;31;32', '', 430, 245, 1, 1, '', ''),
(8, 'Ebene', 'ebene', 'Eine leere Ebene, die nur von Bergen und Wald umgeben ist.', 'Erde', '1;2;3;4;5;11;38;39', '1;2', '2', 445, 230, 1, 1, '', ''),
(9, 'Meer', 'meer', 'Das Meer ist der passende Ort für einen Urlaub.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5', '', 460, 268, 1, 1, '', ''),
(10, 'Admin Island', 'arena', 'Ein Ort der zu Testzwecken erschaffen wurde. Zutritt nur für Befugte!', 'Erde', '1;2;3;4;5;11;38;39', '1;2;3;4;5;6;7;8;9;10;11;13;14;16;17;18;19;20;21;22;23;24;25;26;27;28;29;30;31;32;33;34;35;36;37;38;39;40;41;42;43;44;45;46;47;48;49;50;51;52;53;54;76;77;78;79;80;81;82;83;84;85;86;87;88;89;90;91;92;95;96;97;98;99;100;101;102;103;104;105;106;107;108;109;110;111;112;116;117;118;119;125;126;127;128;129;130;131;132;133;134;135;136;147;148;149;151;152;153;154;155;156;157;158;159;160;161;166;167;168;169;170;172;173;184;185;186;187;188;189;190;191;192;193;198;199;200;201;202;203;204;205;206;207;208;209;210;215;216;217;218;219;220', '1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20;21;22;24;25;26;27;28;29;30;31;32;33;34;35;36;37;38;39;40;41;42;43;44;45;46;95;102;103;107;108;109;110;113;114;115;116;117;118;119;120;121;122;123;124;125;126;127;128;129;130;131;132;133;134', 550, 430, 0, 0, '1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20;21;22;24;25;26;27;28;29;30;31;32;33;34;35;36;37;38;39;40;41;42;43;44;45;46', '1;2;3;4;5;6;7;23;24;25;26;27;28;29;30;31;32;33;34;35;49;50;51;52;53;54;55;56;57;58;59;60;61;62;63;64;65;66;67;68;69;70;71;72;73;74;75;76;77;78;79;80;81;82;83;84;85;86;87;88;89;90;91;92;93;94;95;96;97;98;99;100;101;102;103;104;105;106;107;108;109;110;111;112;113;114;115;116;117;118;119;120;121;122;123;124;125;126;127;128;129;130;131;132;133;134;135;136;137;138;139;140;141;142;143;144;145;146;147;148;149;150;151;152;153;154;155;156;157;158;159;160;161;162;163;164;165;167;168;169;170;171;172;173;174;175;176;177;178;179;180;181;182;184;185;186;187;188;189;190;191;192;193;194;195;196;197;198;199;200;201;202;203;204;205;206;207;208;209;210;211;212;213;214;215;216;217;218;371;372;374'),
(11, 'Auf Reise', '', '', 'Erde', '1;2;3;4;5;11;38;39', '', '', 0, 0, 0, 0, '', ''),
(12, 'Kame Haus', 'kame', 'Das Kame House ist ein kleines, pinkes Haus, welches auf der Kame-Insel steht. Hier wohnt der Herr der Schildkröten.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;203', '100;101', 502, 288, 1, 1, '', ''),
(13, 'Olongs Reich', 'oolongshaus', 'Ein Ort des Friedens und der Ruhe.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7', '', 420, 200, 1, 1, '', ''),
(14, 'Papayainsel', 'papayainsel', 'Auf der Papayainsel findet Das Große Turnier statt. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13;86;87;88', '54;55;56;57;58;82;83;84;85;86;97;98;99', 305, 395, 1, 1, '', '37'),
(15, 'Satan City', 'satan', 'Satan City ist eine recht neue, aber schon sehr bewohnte, Stadt. In dieser Stadt lebt Mister Satan mit seiner Tochter Videl. ', 'Erde', '1;2;3;4;5;11;38;39', '99;100;101;102', '', 450, 170, 0, 0, '', ''),
(16, 'Trainingsinsel', 'trainingsinsel', 'Eine Insel die zum trainieren benutzt werden kann.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;77;78;79;80;81;190', '10', 485, 332, 1, 1, '', ''),
(17, 'Das Verlassene Dorf', 'verlassenedorf', 'Ein Dorf, mit vielen Häusern, aber es befinden sich keine Menschen auf der Straße.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;28;33;34;35;36', '12;13;48', 450, 200, 1, 1, '12;13', '287'),
(18, 'Wüste', 'wueste', 'Die Wüste ein Ort der Banditen und der dürre. Ein Ort ohne Wasser und Hoffnung', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9', '8;9', 367, 172, 1, 1, '', '288'),
(19, 'Quittenwald', 'quittenwald', 'Ein heiliger Wald indem der Quittenturm steht.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '70;71', 0, 200, 1, 1, '', ''),
(20, 'Quittenturm', 'quittenturm', 'Eine Aussichtsplattform, die an der Spitze des Turmes ist.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 15, 195, 1, 1, '', ''),
(22, 'Raum von Geist und Zeit', 'rvguz', 'Der Raum von Geist und Zeit, in dem die Zeit langsamer läuft als außerhalb.', 'Erde', '1;2;3;4;5;11;38;39', '', '8;9', 20, 190, 0, 0, '', ''),
(23, 'Südliche Hauptstadt', 'southcity', 'Die südlichste Stadt wo Menschen Leben ist oh Wunder, die Südliche Hauptstadt.', 'Erde', '1;2;3;4;5;11;38;39', '20', '', 240, 380, 0, 0, '', ''),
(24, 'Nördliche Hauptstadt ', 'ncity', 'Nördliche Haupstadt ist eine sehr große Stadt in dessen nehe auch Dr. Geros Labor liegt.', 'Erde', '1;2;3;4;5;11;38;39', '', '', 270, 20, 0, 0, '', ''),
(25, 'Dr. Geros Labor', 'Dr.G', 'Dr. Geros Labor liegt in einer Höhle tief im nördlichen Gebirge in der Nähe der Nördlichen Hauptstadt.', 'Erde', '1;2;3;4;5;11;38;39', '', '', 300, 10, 0, 0, '', ''),
(26, 'Schloss im Wald', 'castel', 'Die böse Aura, die dieses Schloss ausstrahlt, lässt sogar den stärksten Krieger erschaudern.', 'Erde', '1;2;3;4;5;11;38;39', '117;118', '32;33;34', 200, 350, 0, 0, '', ''),
(27, 'Yahhoy', 'Yahhoy', 'Stadt am Meer von der eine Fähre zur Papayainsel fährt.', 'Erde', '1;2;3;4;5;11;38;39', '21;121;122', '', 10, 100, 0, 0, '', ''),
(28, 'Trainingsberg', 'trainingsberg', 'Ein Berg, an dem man gut trainieren kann. Aber nicht muss. Viele Trainierende merken während ihrer Meditation auf dem Berg, dass es effektiver ist, nur den Geist zu trainieren und später durch Sparring die Muckis aufzupumpen.', 'Erde', '1;2;3;4;5;11;22;38;39', '1;2;4;5;6;7;8;9;10;11', '95', 470, 345, 0, 0, '', ''),
(29, 'Pinguinhausen', 'pinguinhausen', 'Eine kleines Dorf auf einer kleinen Insel. Hier leben merkwürdige Menschen.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11', '68', 540, 320, 1, 1, '', ''),
(30, 'Jingledorf', 'jingledorf', 'Ein kleines Dorf in dem es kalt und verschneit ist.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11', '60', 485, 30, 1, 1, '', ''),
(32, 'Prinz Pilafs Schloss', 'pilafschloss', 'Ein großes Schloss. Welche Gefahren wohl dort lauern?\r\n', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9', '17;18;19', 280, 200, 1, 1, '', '36'),
(33, 'Parsley City', '', 'Eine Stadt aus der Rauch empor steigt. Vielleicht gibts Probleme?', 'Erde', '1;2;3;4;5;11;38;39', '', '', 180, 150, 0, 0, '', ''),
(34, 'Südliche Hauptstadt', '', 'Eine Demokratische Stadt mit vielen Einwohnern', 'Erde', '1;2;3;4;5;11;38;39', '', '', 150, 130, 0, 0, '', ''),
(35, 'Ingwerstadt', '', 'Eine Kleinstadt, in der überall Klamotten rumliegen. Was hier wohl geschehen ist?', 'Erde', '1;2;3;4;5;11;38;39', '', '', 150, 100, 0, 0, '', ''),
(36, 'Nams Dorf', 'hatchi', 'Kimax668 hatte keine lust mir eine zu geben.', 'Erde', '1;2;3;4;5;11;38;39', '', '', 10, 320, 0, 0, '', ''),
(37, 'Girans Dorf', 'pika', 'Comming Soon\r\n', 'Erde', '1;2;3;4;5;11;38;39', '', '', 2, 280, 0, 0, '', ''),
(38, 'Uranai Babas Palast', 'uranaibaba', 'Ein großen Palast in dem die Wahrsagerin Uranai Baba lebt. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '76;77;78;79;80', 50, 340, 1, 1, '', ''),
(39, 'Kampf Arena', '', 'Eine Arena die scheinbar fürs Kämpfen gemacht ist. Wer die wohl gebaut hat?', 'Erde', '1;2;3;4;5;11;38;39', '', '', 180, 80, 0, 0, '', ''),
(40, 'Amenbo Insel', 'Amenbo', 'Eine bevölkerte Insel, scheint als würde sie Angegriffen werden.', 'Erde', '1;2;3;4;5;11;38;39', '', '', 220, 420, 0, 0, '', ''),
(41, 'Bratpfannenberg', '', 'Gerüchte sagen es lebt ein Teufel auf dem Berg. Ob das stimmt?', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7', '', 330, 300, 0, 0, '', ''),
(42, 'Piratenhöhle', 'piratenhoehle', 'Eine Höhle die von Piraten bewohnt wird.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;116;117;118;119', '65;66;67', 540, 270, 1, 1, '', ''),
(43, 'Paradise', '', '', 'Himmel', '1;2;3;4;5;11;38;39', '', '', 490, 200, 0, 0, '', ''),
(50, 'Zentrale', 'Fehlt', 'Willkommen auf dem Clan Planeten. Dies ist der zentrale Punkt an dem jeder ankommt.', 'DBBG Team', '1;2;3;4;5;11;38;39', '', '', 230, 200, 0, 0, '', ''),
(51, 'Bergweg', 'bergweg', 'Ein Weg der zwischen den Bergen führt.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;28;37;38;39;40', '3', 465, 245, 1, 1, '', '286'),
(52, 'Der Bratpfannenberg', 'feuerberg', 'Ein Berg der in Flammen steht.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9', '', 367, 285, 1, 1, '', ''),
(53, 'Die Pilzstadt', 'pilzstadt', 'Eine Stadt die in Mitten eines Waldes aus Pilzen gebaut worden ist.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;75', '50', 320, 235, 1, 1, '', ''),
(54, 'Brown Country', 'browncountry', 'Eine Stadt in der Wüste. Sie ist sehr leer, bis auf ein Saloon.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9', '28', 412, 265, 1, 1, '', ''),
(55, 'Wüsten-Stützpunkt', 'wuestenstuetzpunkt', 'Ein Stützpunkt der Red Ribbon Army in der Wüste.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;28;33;34;35;36', '59', 450, 130, 1, 1, '', '287'),
(56, 'Unterwasser', 'unterwasser', 'Der Grund des Meeres.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11', '', 525, 266, 1, 1, '', ''),
(57, 'Stadtstraße', 'stadtstrasse', 'Eine Straße die zu einer Stadt führt.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11', '81', 45, 375, 1, 1, '65', ''),
(59, 'RR-Hauptquartier', 'rrhauptquartier', 'Das Hauptquartier der Red Ribbon Army.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '74;75', -40, 225, 1, 1, '65', ''),
(60, 'Yajirobis Prärie', 'yajirobisprärie', 'Ein, von der Zivilisation verschonter, Dschungel. Hier sind eine Vielfalt von exotischer Kreaturen und Vegetationen aufzufinden. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '88;89;90;94', 205, 395, 1, 1, '', ''),
(61, 'Eislabyrinth', 'eislabyrinth', 'Eine menschenleere Eisödnis. Viele, die dieses Labyrinth betraten, wurden anschließend nie wieder gesehen. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '91', 25, -20, 1, 1, '', ''),
(62, 'King Castle', 'kingcastle', 'Die Hauptstadt der Erde und die meist bevölkerte Stadt der Welt. Hier residiert der König der Welt. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13;166;167;168;169;170', '92;93', 215, 105, 1, 1, '', ''),
(63, 'Gottespalast', 'gottespalast', 'Eine fliegende Plattform, die sich über dem Quittenturm befindet. Hier soll Gott, der Erschaffer der Dragonballs, leben. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '96', 15, 175, 1, 1, '', ''),
(64, 'Meister Kaios Planet', 'meisterkaiosplanet', 'Der Planet von Meister Kaio', 'Jenseits', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 75, 100, 0, 1, '', '6'),
(66, 'Wildnis', 'wildnis', 'Eine von überwiegend wilden Tieren bewohnte Landschaft.', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11', '103', 485, 80, 1, 1, '', ''),
(67, 'Paprika-Ödnis', 'paprikaoednis', 'Eine menschenleere Ödnis, welche sich gut als Schlachtfeld eignet. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '107;108', 140, 130, 1, 1, '', ''),
(68, 'Gizard-Ödnis', 'gizardoednis', 'Eine von Gebirgen dominierte Ödnis, welche von jeglichen Leben verlassen wurde. ', 'Erde', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '109;110', 160, 60, 1, 1, '', ''),
(69, 'Kleine Insel', 'kleineinsel', 'Eine kleine Insel mit wenigen Bäumen.', 'Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 300, 425, 1, 1, '', ''),
(70, 'Spitze Berge', 'spitzeberge', 'Spitze Berge auf denen man gut trainieren kann.', 'Yardrat', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 250, 100, 1, 1, '', ''),
(71, 'Namek-Dorf', 'namekdorf', 'Ein Dorf der Namekianer.', 'Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 360, 310, 1, 1, '', ''),
(72, 'Haus des Ältesten', 'oberhaus', 'Das Haus des Oberältesten der Namekianer.', 'Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 420, 50, 1, 1, '', ''),
(73, 'Namekianische Ebene', 'namekebene', 'Eine Ebene auf die Frieza sein Raumschiff platziert hat.', 'Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '113;114;115;118;119;120;121;122;124', 175, 75, 1, 1, '', ''),
(74, 'Inselgruppe', 'inselgruppe', 'Viele kleinere Inseln auf Namek.', 'Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 125, 225, 1, 1, '', ''),
(75, 'Namekianische Berge', 'namekberge', 'Viele Berge die sich auf Namek befinden.', 'Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 275, 150, 1, 1, '', ''),
(76, 'Ajisa Feld', 'ajisafeld', 'Ein Feld von Ajisa.', 'Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 395, 340, 1, 1, '', ''),
(77, 'Landepunkt', 'fakelandepunkt', 'Der Ankunftsort auf Namek.', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 445, 350, 1, 1, '', ''),
(78, 'Tentakel-See', 'ajisafeld', 'Ein Feld von Ajisa.', 'Fake-Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 260, 190, 1, 1, '', ''),
(79, 'Landepunkt', 'ajisafeld', 'Ein Feld von Ajisa.', 'Fake-Namek', '1;2;3;4;5;11;38;39', '1;2;4;5;6;7;8;9;10;11;12;13', '', 395, 340, 1, 1, '', ''),
(80, 'Namekianisches Dorf', 'fakedorf', 'Ein augenscheinlich bewohntes Dorf auf dem Planeten Namek.', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 335, 375, 1, 1, '', ''),
(81, 'Namekianischer Fluss', 'fakefluss', 'Ein idyllisch ruhiger Fluss mit leichter Strömung.', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 390, 307, 1, 1, '', ''),
(82, 'Glitzernder See', 'glitzersee', 'Ein glitzernd schöner See voller Geheimnisse.', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 250, 200, 1, 1, '', ''),
(83, 'Wald am Fuße des Berges', 'waldamberg', 'Ein Wald, in dessen Nähe sich ein riesiger Berg befindet. ', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 60, 270, 1, 1, '', ''),
(84, 'Schloss des Riesen', 'bergschloss', 'Ein Schloss ganz weit oben auf einem riesigen Berg. Wer könnte hier wohnen?', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 78, 234, 1, 1, '', ''),
(85, 'Eishöhle', 'eishohle', 'Eine Höhle an einem sehr kalten Ort.', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 35, 350, 1, 1, '', ''),
(86, 'Waldstück', 'fakewald', 'Ein riesiges Gebiet voll mit Wald.\r\nEs lauern Gefahren aus der Urzeit.', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 370, 136, 1, 1, '', ''),
(87, 'Alte Ruinen', 'alteruinen', 'Verlassene alte Ruinen.\r\nAus welchem Grund hat man sie verlassen?', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 462, 55, 1, 1, '', ''),
(88, 'Säuresee', 'sauresee', 'Ein See der mit Vorsicht zu genießen ist.', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 275, 55, 1, 1, '', ''),
(89, 'Tornadowüste', 'tornadowuste', 'Eine Wüstenlandschaft.\r\nAus der Ferne sind hier gigantische Tornados zu beobachten.\r\n', 'Namek.', '1;2;3;4;5;11;38;39', '215;216;217;218;219;220', '', 100, 15, 1, 1, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `planet`
--

CREATE TABLE `planet` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `startingplace` varchar(90) NOT NULL,
  `travelable` tinyint(1) NOT NULL,
  `x` int(3) NOT NULL,
  `y` int(3) NOT NULL,
  `description` longtext NOT NULL,
  `display` tinyint(1) NOT NULL,
  `image` varchar(90) NOT NULL,
  `minstory` int(4) NOT NULL,
  `maxstory` int(4) NOT NULL,
  `mapimage` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `planet`
--

INSERT INTO `planet` (`id`, `name`, `startingplace`, `travelable`, `x`, `y`, `description`, `display`, `image`, `minstory`, `maxstory`, `mapimage`) VALUES
(1, 'Erde', 'Westliche Hauptstadt', 1, 25, 320, 'Dies ist der Heimatplanet der Menschen. Die Menschen sind eine sehr intelligente und Technik-affine Rasse.', 1, 'space_erde', 0, 0, 'erde'),
(2, 'Jenseits', 'Check-In Station', 0, 0, 0, '', 0, '', 0, 0, ''),
(3, 'Namek', 'Kleine Insel', 1, 155, 85, 'Hier leben die friedlichen Namekianer. Sie sind die Erschaffer der Dragonballs.', 1, 'space_namek', 200, 0, 'namek'),
(4, 'Yardrat', 'Spitze Berge', 0, 330, 225, 'Dieser Planet wird von Bewohnern bevölkert, die sich mit der Momentanen Teleportation auskennen.', 1, 'space_yardrat', 0, 0, 'yardrat'),
(5, 'Namek.', 'Landepunkt', 1, 100, 200, 'Hier leben die friedlichen Namekianer. Sie sind die Erschaffer der Dragonballs.', 1, 'space_namek', 0, 200, 'namek'),
(6, 'Fake-Namek', 'Fake-Landepunkt', 1, 100, 200, 'Dieser Planet ist eigentlich nicht Namek.', 1, 'space_fakenamek', 201, 0, 'fakenamek');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pms`
--

CREATE TABLE `pms` (
  `id` int(30) NOT NULL,
  `sendername` varchar(30) NOT NULL,
  `senderimage` varchar(255) NOT NULL,
  `senderid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `receivername` varchar(30) NOT NULL,
  `text` longtext NOT NULL,
  `time` datetime NOT NULL,
  `read` tinyint(1) NOT NULL,
  `topic` longtext NOT NULL,
  `ishtml` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `race` varchar(90) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `skilltree`
--

CREATE TABLE `skilltree` (
  `id` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `race` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `angle` int(3) NOT NULL,
  `col` int(2) NOT NULL,
  `row` int(2) NOT NULL,
  `needattacks` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `learnable` tinyint(4) NOT NULL,
  `neededpoints` int(3) NOT NULL,
  `level` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `skilltree`
--

INSERT INTO `skilltree` (`id`, `attack`, `race`, `type`, `angle`, `col`, `row`, `needattacks`, `learnable`, `neededpoints`, `level`) VALUES
(1, 4, '', 1, 0, 8, 5, '', 1, 1, 60),
(4, 0, '', 1, 0, 8, 6, '', 0, 0, 0),
(5, 23, 'Saiyajin', 1, 0, 8, 7, '4;22', 1, 1, 0),
(6, 0, '', 1, 0, 8, 8, '', 0, 0, 0),
(7, 24, 'Saiyajin', 1, 0, 8, 9, '23', 1, 1, 0),
(8, 0, 'Saiyajin', 1, 45, 9, 8, '', 0, 0, 0),
(9, 25, 'Saiyajin', 1, 0, 10, 9, '23', 1, 1, 0),
(10, 0, '', 1, 0, 8, 10, '', 0, 0, 0),
(11, 0, 'Saiyajin', 1, -45, 7, 10, '', 0, 0, 0),
(12, 0, 'Saiyajin', 1, 0, 10, 10, '', 0, 0, 0),
(13, 26, 'Saiyajin', 1, 0, 6, 11, '24', 1, 1, 0),
(14, 27, 'Saiyajin', 1, 0, 8, 11, '24', 1, 1, 0),
(15, 28, 'Saiyajin', 1, 0, 10, 11, '25', 1, 1, 0),
(16, 0, 'Saiyajin', 1, 45, 7, 12, '', 0, 0, 0),
(17, 29, 'Saiyajin', 1, 0, 6, 13, '26;27', 1, 1, 0),
(18, 0, 'Saiyajin', 1, -45, 9, 12, '', 0, 0, 0),
(19, 0, '', 1, 0, 8, 12, '', 0, 0, 0),
(20, 30, 'Saiyajin', 1, 0, 8, 13, '26;27;28', 1, 1, 0),
(21, 0, 'Saiyajin', 1, -45, 7, 12, '', 0, 0, 0),
(22, 0, 'Saiyajin', 1, 0, 6, 12, '', 0, 0, 0),
(23, 0, 'Saiyajin', 1, 0, 10, 12, '', 0, 0, 0),
(24, 31, 'Saiyajin', 1, 0, 10, 13, '28', 1, 1, 0),
(25, 0, 'Saiyajin', 1, 0, 6, 14, '', 0, 0, 0),
(26, 0, 'Saiyajin', 1, 45, 7, 14, '', 0, 0, 0),
(27, 0, 'Saiyajin', 1, -45, 7, 14, '', 0, 0, 0),
(28, 0, '', 1, 0, 8, 14, '', 0, 0, 0),
(29, 0, 'Saiyajin', 1, 0, 10, 14, '', 0, 0, 0),
(30, 32, 'Saiyajin', 1, 0, 6, 15, '29;30', 1, 1, 0),
(31, 33, 'Saiyajin', 1, 0, 8, 15, '29;30', 1, 1, 0),
(32, 34, 'Saiyajin', 1, 0, 10, 15, '31', 1, 1, 0),
(33, 0, '', 1, 0, 8, 16, '', 0, 0, 0),
(34, 0, 'Saiyajin', 1, -45, 9, 16, '', 0, 0, 0),
(35, 0, 'Saiyajin', 1, 45, 7, 16, '', 0, 0, 0),
(36, 35, '', 1, 0, 8, 17, '32;33;34;53;69;85;105;106;123;124;140;156', 1, 1, 0),
(37, 38, 'Saiyajin', 2, 0, 0, 0, '', 1, 1, 0),
(38, 0, '', 2, 0, 0, 1, '', 0, 0, 0),
(39, 39, 'Saiyajin', 2, 0, 0, 2, '38', 1, 1, 0),
(40, 0, '', 2, 0, 0, 3, '', 0, 0, 0),
(41, 40, 'Saiyajin', 2, 0, 0, 4, '39', 1, 1, 0),
(42, 0, '', 2, 0, 0, 5, '', 0, 0, 0),
(43, 41, 'Saiyajin', 2, 0, 0, 6, '40', 1, 1, 0),
(44, 0, '', 2, 0, 0, 7, '', 0, 0, 0),
(45, 42, 'Saiyajin', 2, 0, 0, 8, '41', 1, 1, 0),
(46, 0, '', 2, 0, 0, 9, '', 0, 0, 0),
(47, 43, 'Saiyajin', 2, 0, 0, 10, '42', 1, 1, 0),
(48, 0, '', 2, 0, 0, 11, '', 0, 0, 0),
(49, 44, 'Saiyajin', 2, 0, 0, 12, '43', 1, 1, 0),
(50, 0, '', 2, 0, 0, 13, '', 0, 0, 0),
(51, 45, 'Saiyajin', 2, 0, 0, 14, '44', 1, 1, 0),
(52, 0, '', 2, 0, 0, 15, '', 0, 0, 0),
(53, 46, 'Saiyajin', 2, 0, 0, 16, '45', 1, 1, 0),
(54, 0, '', 2, 0, 0, 17, '', 0, 0, 0),
(55, 47, 'Saiyajin', 2, 0, 0, 18, '46', 1, 1, 0),
(56, 0, '', 2, 0, 0, 19, '', 0, 0, 0),
(57, 48, 'Saiyajin', 2, 0, 0, 20, '47', 1, 1, 0),
(58, 49, 'Mensch', 1, 0, 8, 7, '4', 1, 1, 0),
(59, 50, 'Mensch', 1, 0, 8, 9, '49', 1, 1, 0),
(60, 51, 'Mensch', 1, 0, 8, 11, '50', 1, 1, 0),
(61, 52, 'Mensch', 1, 0, 8, 13, '51', 1, 1, 0),
(62, 53, 'Mensch', 1, 0, 8, 15, '52', 1, 1, 0),
(63, 54, 'Mensch', 2, 0, 0, 0, '', 1, 1, 0),
(64, 58, 'Mensch', 2, 0, 0, 2, '54', 1, 1, 0),
(65, 61, 'Mensch', 2, 0, 0, 4, '58', 1, 1, 0),
(66, 55, 'Mensch', 2, 0, 0, 6, '61', 1, 1, 0),
(67, 56, 'Mensch', 2, 0, 0, 8, '55', 1, 1, 0),
(68, 57, 'Mensch', 2, 0, 0, 10, '56', 1, 1, 0),
(69, 60, 'Mensch', 2, 0, 0, 12, '57', 1, 1, 0),
(70, 63, 'Mensch', 2, 0, 0, 14, '60', 1, 1, 0),
(71, 59, 'Mensch', 2, 0, 0, 16, '63', 1, 1, 0),
(72, 62, 'Mensch', 2, 0, 0, 18, '59', 1, 1, 0),
(73, 64, 'Mensch', 2, 0, 0, 20, '62', 1, 1, 0),
(74, 65, 'Freezer', 1, 0, 8, 7, '4', 1, 1, 0),
(75, 66, 'Freezer', 1, 0, 8, 9, '65', 1, 1, 0),
(76, 67, 'Freezer', 1, 0, 8, 11, '66', 1, 1, 0),
(77, 68, 'Freezer', 1, 0, 8, 13, '67', 1, 1, 0),
(78, 69, 'Freezer', 1, 0, 8, 15, '68;107', 1, 1, 0),
(79, 70, 'Freezer', 2, 0, 0, 0, '', 1, 1, 0),
(80, 71, 'Freezer', 2, 0, 0, 2, '70', 1, 1, 0),
(81, 72, 'Freezer', 2, 0, 0, 4, '71', 1, 1, 0),
(82, 73, 'Freezer', 2, 0, 0, 6, '72', 1, 1, 0),
(83, 74, 'Freezer', 2, 0, 0, 8, '73', 1, 1, 0),
(84, 75, 'Freezer', 2, 0, 0, 10, '74', 1, 1, 0),
(85, 76, 'Freezer', 2, 0, 0, 12, '75', 1, 1, 0),
(86, 77, 'Freezer', 2, 0, 0, 14, '76', 1, 1, 0),
(87, 78, 'Freezer', 2, 0, 0, 16, '77', 1, 1, 0),
(88, 79, 'Freezer', 2, 0, 0, 18, '78', 1, 1, 0),
(89, 80, 'Freezer', 2, 0, 0, 20, '79', 1, 1, 0),
(90, 81, 'Kaioshin', 1, 0, 8, 7, '4', 1, 1, 0),
(91, 82, 'Kaioshin', 1, 0, 8, 9, '81', 1, 1, 0),
(92, 83, 'Kaioshin', 1, 0, 8, 11, '82', 1, 1, 0),
(93, 84, 'Kaioshin', 1, 0, 8, 13, '83', 1, 1, 0),
(94, 85, 'Kaioshin', 1, 0, 8, 15, '84', 1, 1, 0),
(95, 86, 'Kaioshin', 2, 0, 0, 0, '', 1, 1, 0),
(96, 87, 'Kaioshin', 2, 0, 0, 2, '86', 1, 1, 0),
(97, 88, 'Kaioshin', 2, 0, 0, 4, '87', 1, 1, 0),
(98, 89, 'Kaioshin', 2, 0, 0, 6, '88', 1, 1, 0),
(99, 90, 'Kaioshin', 2, 0, 0, 8, '89', 1, 1, 0),
(100, 91, 'Kaioshin', 2, 0, 0, 10, '90', 1, 1, 0),
(101, 92, 'Kaioshin', 2, 0, 0, 12, '91', 1, 1, 0),
(102, 93, 'Kaioshin', 2, 0, 0, 14, '92', 1, 1, 0),
(103, 94, 'Kaioshin', 2, 0, 0, 16, '93', 1, 1, 0),
(104, 95, 'Kaioshin', 2, 0, 0, 18, '94', 1, 1, 0),
(105, 96, 'Kaioshin', 2, 0, 0, 20, '95', 1, 1, 0),
(106, 97, 'Android', 1, 0, 8, 7, '4', 1, 1, 0),
(107, 98, 'Android', 1, 0, 10, 7, '4', 1, 1, 0),
(108, 0, 'Android', 1, 45, 9, 6, '', 0, 0, 0),
(109, 99, 'Android', 1, 0, 8, 9, '97', 1, 1, 0),
(110, 100, 'Android', 1, 0, 10, 9, '98', 1, 1, 0),
(111, 0, 'Android', 1, 0, 10, 8, '', 0, 0, 0),
(112, 101, 'Android', 1, 0, 8, 11, '99', 1, 1, 0),
(113, 102, 'Android', 1, 0, 10, 11, '100', 1, 1, 0),
(114, 0, 'Android', 1, 0, 10, 10, '', 0, 0, 0),
(115, 103, 'Android', 1, 0, 8, 13, '101', 1, 1, 0),
(116, 104, 'Android', 1, 0, 10, 13, '102', 1, 1, 0),
(117, 0, 'Android', 1, 0, 10, 12, '', 0, 0, 0),
(118, 105, 'Android', 1, 0, 8, 15, '103', 1, 1, 0),
(119, 106, 'Android', 1, 0, 10, 15, '104', 1, 1, 0),
(120, 0, 'Android', 1, 0, 10, 14, '', 0, 0, 0),
(121, 0, 'Android', 1, -45, 9, 16, '', 0, 0, 0),
(122, 107, 'Freezer', 1, 0, 10, 13, '67', 1, 1, 0),
(123, 0, 'Freezer', 1, -45, 9, 14, '', 0, 0, 0),
(124, 0, 'Freezer', 1, 45, 9, 12, '', 0, 0, 0),
(125, 108, 'Android', 2, 0, 0, 0, '', 1, 1, 0),
(126, 109, 'Android', 2, 0, 0, 2, '108', 1, 1, 0),
(127, 110, 'Android', 2, 0, 0, 4, '109', 1, 1, 0),
(128, 111, 'Android', 2, 0, 0, 6, '110', 1, 1, 0),
(129, 112, 'Android', 2, 0, 0, 8, '111', 1, 1, 0),
(130, 113, 'Android', 2, 0, 0, 10, '112', 1, 1, 0),
(131, 114, 'Android', 2, 0, 0, 12, '113', 1, 1, 0),
(132, 115, 'Android', 2, 0, 0, 14, '114', 1, 1, 0),
(133, 116, 'Android', 2, 0, 0, 16, '115', 1, 1, 0),
(134, 117, 'Android', 2, 0, 0, 18, '116', 1, 1, 0),
(135, 118, 'Android', 2, 0, 0, 20, '117', 1, 1, 0),
(136, 119, 'Majin', 1, 0, 8, 7, '4', 1, 1, 0),
(137, 120, 'Majin', 1, 0, 8, 9, '119', 1, 1, 0),
(138, 121, 'Majin', 1, 0, 8, 11, '120', 1, 1, 0),
(139, 122, 'Majin', 1, 0, 8, 13, '121', 1, 1, 0),
(140, 123, 'Majin', 1, 0, 8, 15, '122', 1, 1, 0),
(141, 0, 'Majin', 1, -45, 9, 16, '', 0, 0, 0),
(142, 0, 'Majin', 1, 45, 9, 14, '', 0, 0, 0),
(143, 124, 'Majin', 1, 0, 10, 15, '122', 1, 1, 0),
(144, 125, 'Majin', 2, 0, 0, 0, '', 1, 1, 0),
(145, 126, 'Majin', 2, 0, 0, 2, '125', 1, 1, 0),
(146, 127, 'Majin', 2, 0, 0, 4, '126', 1, 1, 0),
(147, 128, 'Majin', 2, 0, 0, 6, '127', 1, 1, 0),
(148, 129, 'Majin', 2, 0, 0, 8, '128', 1, 1, 0),
(149, 130, 'Majin', 2, 0, 0, 10, '129', 1, 1, 0),
(150, 131, 'Majin', 2, 0, 0, 12, '130', 1, 1, 0),
(151, 132, 'Majin', 2, 0, 0, 14, '131', 1, 1, 0),
(152, 133, 'Majin', 2, 0, 0, 16, '132', 1, 1, 0),
(153, 134, 'Majin', 2, 0, 0, 18, '133', 1, 1, 0),
(154, 135, 'Majin', 2, 0, 0, 20, '134', 1, 1, 0),
(155, 136, 'Demon', 1, 0, 8, 7, '4', 1, 1, 0),
(156, 137, 'Demon', 1, 0, 8, 9, '136', 1, 1, 0),
(157, 138, 'Demon', 1, 0, 8, 11, '137', 1, 1, 0),
(158, 139, 'Demon', 1, 0, 8, 13, '138', 1, 1, 0),
(159, 140, 'Demon', 1, 0, 8, 15, '139', 1, 1, 0),
(160, 141, 'Demon', 2, 0, 0, 0, '', 1, 1, 0),
(161, 142, 'Demon', 2, 0, 0, 2, '141', 1, 1, 0),
(162, 143, 'Demon', 2, 0, 0, 4, '142', 1, 1, 0),
(163, 144, 'Demon', 2, 0, 0, 6, '143', 1, 1, 0),
(164, 145, 'Demon', 2, 0, 0, 8, '144', 1, 1, 0),
(165, 146, 'Demon', 2, 0, 0, 10, '145', 1, 1, 0),
(166, 147, 'Demon', 2, 0, 0, 12, '146', 1, 1, 0),
(167, 148, 'Demon', 2, 0, 0, 14, '147', 1, 1, 0),
(168, 149, 'Demon', 2, 0, 0, 16, '148', 1, 1, 0),
(169, 150, 'Demon', 2, 0, 0, 18, '149', 1, 1, 0),
(170, 151, 'Demon', 2, 0, 0, 20, '150', 1, 1, 0),
(171, 152, 'Namekianer', 1, 0, 8, 7, '4', 1, 1, 0),
(172, 153, 'Namekianer', 1, 0, 8, 9, '152', 1, 1, 0),
(173, 154, 'Namekianer', 1, 0, 8, 11, '153', 1, 1, 0),
(174, 155, 'Namekianer', 1, 0, 8, 13, '154', 1, 1, 0),
(175, 156, 'Namekianer', 1, 0, 8, 15, '155', 1, 1, 0),
(176, 157, 'Namekianer', 2, 0, 0, 0, '', 1, 1, 0),
(177, 158, 'Namekianer', 2, 0, 0, 2, '157', 1, 1, 0),
(178, 159, 'Namekianer', 2, 0, 0, 4, '158', 1, 1, 0),
(179, 160, 'Namekianer', 2, 0, 0, 6, '159', 1, 1, 0),
(180, 161, 'Namekianer', 2, 0, 0, 8, '160', 1, 1, 0),
(181, 162, 'Namekianer', 2, 0, 0, 10, '161', 1, 1, 0),
(182, 163, 'Namekianer', 2, 0, 0, 12, '162', 1, 1, 0),
(183, 164, 'Namekianer', 2, 0, 0, 14, '163', 1, 1, 0),
(184, 165, 'Namekianer', 2, 0, 0, 16, '164', 1, 1, 0),
(185, 166, 'Namekianer', 2, 0, 0, 18, '165', 1, 1, 0),
(186, 167, 'Namekianer', 2, 0, 0, 20, '166', 1, 1, 0),
(187, 168, '', 2, 0, 14, 0, '', 1, 1, 0),
(188, 0, '', 2, 0, 14, 1, '', 0, 0, 0),
(189, 169, '', 2, 0, 14, 2, '168', 1, 1, 0),
(190, 0, '', 2, 0, 14, 3, '', 0, 0, 0),
(191, 170, '', 2, 0, 14, 4, '169', 1, 1, 0),
(192, 0, '', 2, 0, 14, 5, '', 0, 0, 0),
(193, 171, '', 2, 0, 14, 6, '170', 1, 1, 0),
(194, 0, '', 2, 0, 14, 7, '', 0, 0, 0),
(195, 172, '', 2, 0, 14, 8, '171', 1, 1, 0),
(196, 0, '', 2, 0, 14, 9, '', 0, 0, 0),
(197, 173, '', 2, 0, 14, 10, '172', 1, 1, 0),
(198, 0, '', 2, 0, 14, 11, '', 0, 0, 0),
(199, 174, '', 2, 0, 14, 12, '173', 1, 1, 0),
(200, 0, '', 2, 0, 14, 13, '', 0, 0, 0),
(201, 175, '', 2, 0, 14, 14, '174', 1, 1, 0),
(202, 0, '', 2, 0, 14, 15, '', 0, 0, 0),
(203, 176, '', 2, 0, 14, 16, '175', 1, 1, 0),
(204, 0, '', 2, 0, 14, 17, '', 0, 0, 0),
(205, 177, '', 2, 0, 14, 18, '176', 1, 1, 0),
(206, 0, '', 2, 0, 14, 19, '', 0, 0, 0),
(207, 178, '', 2, 0, 14, 20, '177', 1, 1, 0),
(208, 179, '', 2, 0, 2, 0, '', 1, 1, 0),
(209, 0, '', 2, 0, 2, 1, '', 0, 0, 0),
(210, 180, '', 2, 0, 2, 2, '179', 1, 1, 0),
(211, 0, '', 2, 0, 2, 7, '', 0, 0, 0),
(212, 181, '', 2, 0, 2, 6, '182', 1, 1, 0),
(213, 0, '', 2, 0, 2, 3, '', 0, 0, 0),
(214, 183, '', 2, 0, 2, 8, '182', 1, 1, 0),
(215, 0, '', 2, 0, 2, 9, '', 0, 0, 0),
(216, 184, '', 2, 0, 2, 10, '183', 1, 1, 0),
(217, 0, '', 2, 0, 2, 11, '', 0, 0, 0),
(218, 185, '', 2, 0, 2, 12, '184', 1, 1, 0),
(219, 0, '', 2, 0, 2, 11, '', 0, 0, 0),
(220, 187, '', 2, 0, 2, 14, '185', 1, 1, 0),
(221, 0, '', 2, 0, 2, 17, '', 0, 0, 0),
(222, 188, '', 2, 0, 2, 16, '187', 1, 1, 0),
(223, 0, '', 2, 0, 2, 19, '', 0, 0, 0),
(224, 189, '', 2, 0, 2, 20, '192', 1, 1, 0),
(225, 192, '', 2, 0, 2, 18, '188', 1, 1, 0),
(226, 0, '', 2, 0, 2, 15, '', 0, 0, 0),
(227, 0, '', 2, 0, 2, 13, '', 0, 0, 0),
(228, 182, '', 2, 0, 2, 4, '180', 1, 1, 0),
(229, 191, '', 2, 0, 4, 12, '184;204', 1, 1, 0),
(230, 0, '', 2, 0, 4, 13, '', 0, 0, 0),
(231, 193, '', 2, 0, 4, 14, '191', 1, 1, 0),
(232, 0, '', 2, 0, 4, 15, '', 0, 0, 0),
(233, 0, '', 2, 0, 4, 17, '', 0, 0, 0),
(234, 186, '', 2, 0, 4, 16, '193', 1, 1, 0),
(235, 194, '', 2, 0, 4, 18, '186', 1, 1, 0),
(236, 0, '', 2, 0, 4, 19, '', 0, 0, 0),
(237, 195, '', 2, 0, 4, 20, '194', 1, 1, 0),
(238, 0, '', 2, 0, 2, 5, '', 0, 0, 0),
(239, 0, '', 2, 45, 3, 11, '', 0, 0, 0),
(244, 0, '', 2, 45, 15, 13, '', 0, 0, 0),
(245, 196, '', 2, 0, 16, 14, '174', 1, 1, 0),
(246, 0, '', 2, 0, 16, 15, '', 0, 0, 0),
(247, 197, '', 2, 0, 16, 16, '196', 1, 1, 0),
(248, 0, '', 2, 0, 16, 17, '', 0, 0, 0),
(249, 198, '', 2, 0, 16, 18, '197', 1, 1, 0),
(250, 0, '', 2, 0, 16, 19, '', 0, 0, 0),
(251, 199, '', 2, 0, 16, 20, '198', 1, 1, 0),
(252, 200, '', 2, 0, 6, 0, '', 1, 1, 0),
(253, 0, '', 2, 0, 6, 1, '', 0, 0, 0),
(254, 201, '', 2, 0, 6, 2, '200', 1, 1, 0),
(255, 0, '', 2, 0, 6, 3, '', 0, 0, 0),
(256, 202, '', 2, 0, 6, 4, '201', 1, 1, 0),
(257, 0, '', 2, 0, 6, 5, '', 0, 0, 0),
(258, 203, '', 2, 0, 6, 6, '202;211', 1, 1, 0),
(259, 0, '', 2, 0, 6, 7, '', 0, 0, 0),
(260, 190, '', 2, 0, 6, 8, '203', 1, 1, 0),
(261, 0, '', 2, 0, 6, 9, '', 0, 0, 0),
(262, 204, '', 2, 0, 6, 10, '190;212', 1, 1, 0),
(263, 0, '', 2, 0, 6, 11, '', 0, 0, 0),
(264, 205, '', 2, 0, 6, 12, '204', 1, 1, 0),
(265, 0, '', 2, 0, 6, 13, '', 0, 0, 0),
(266, 206, '', 2, 0, 6, 14, '205', 1, 1, 0),
(267, 0, '', 2, 0, 6, 15, '', 0, 0, 0),
(268, 207, '', 2, 0, 6, 16, '206', 1, 1, 0),
(269, 0, '', 2, 0, 6, 17, '', 0, 0, 0),
(270, 208, '', 2, 0, 6, 18, '207', 1, 1, 0),
(271, 0, '', 2, 0, 6, 19, '', 0, 0, 0),
(272, 209, '', 2, 0, 6, 20, '208', 1, 1, 0),
(273, 0, '', 2, -45, 5, 11, '', 0, 0, 0),
(274, 210, '', 2, 0, 8, 2, '200;217', 1, 1, 0),
(275, 0, '', 2, 45, 7, 1, '', 0, 0, 0),
(276, 0, '', 2, 0, 8, 3, '', 0, 0, 0),
(277, 211, '', 2, 0, 8, 4, '210', 1, 1, 0),
(278, 0, '', 2, -45, 7, 5, '', 0, 0, 0),
(279, 0, '', 2, 45, 7, 7, '', 0, 0, 0),
(280, 212, '', 2, 0, 8, 8, '203', 1, 1, 0),
(281, 0, '', 2, -45, 7, 9, '', 0, 0, 0),
(282, 0, '', 2, 45, 7, 13, '', 0, 0, 0),
(283, 213, '', 2, 0, 8, 14, '206;223', 1, 1, 0),
(284, 0, '', 2, 0, 8, 15, '', 0, 0, 0),
(285, 214, '', 2, 0, 8, 16, '213', 1, 1, 0),
(286, 0, '', 2, 0, 8, 17, '', 0, 0, 0),
(287, 215, '', 2, 0, 8, 18, '214', 1, 1, 0),
(288, 0, '', 2, 0, 8, 19, '', 0, 0, 0),
(289, 216, '', 2, 0, 8, 20, '215', 1, 1, 0),
(290, 217, '', 2, 0, 10, 0, '', 1, 1, 0),
(291, 0, '', 2, 0, 10, 1, '', 0, 0, 0),
(292, 0, '', 2, -45, 9, 1, '', 0, 0, 0),
(293, 218, '', 2, 0, 10, 2, '217', 1, 1, 0),
(294, 0, '', 2, 0, 10, 3, '', 0, 0, 0),
(295, 219, '', 2, 0, 10, 4, '218', 1, 1, 0),
(296, 0, '', 2, 0, 10, 5, '', 0, 0, 0),
(297, 220, '', 2, 0, 10, 6, '219', 1, 1, 0),
(298, 0, '', 2, 0, 10, 7, '', 0, 0, 0),
(299, 221, '', 2, 0, 10, 8, '220', 1, 1, 0),
(300, 0, '', 2, 0, 10, 9, '', 0, 0, 0),
(301, 222, '', 2, 0, 10, 10, '221', 1, 1, 0),
(302, 0, '', 2, 0, 10, 11, '', 0, 0, 0),
(303, 223, '', 2, 0, 10, 12, '222', 1, 1, 0),
(304, 0, '', 2, 0, 10, 13, '', 0, 0, 0),
(305, 0, '', 2, -45, 9, 13, '', 0, 0, 0),
(306, 224, '', 2, 0, 10, 14, '223', 1, 1, 0),
(307, 0, '', 2, 0, 10, 15, '', 0, 0, 0),
(308, 225, '', 2, 0, 10, 16, '224', 1, 1, 0),
(309, 0, '', 2, 0, 10, 17, '', 0, 0, 0),
(310, 226, '', 2, 0, 10, 18, '225', 1, 1, 0),
(311, 0, '', 2, 0, 10, 19, '', 0, 0, 0),
(312, 227, '', 2, 0, 10, 20, '226', 1, 1, 0),
(313, 228, '', 2, 0, 12, 0, '', 1, 1, 0),
(314, 0, '', 2, 0, 12, 1, '', 0, 0, 0),
(315, 229, '', 2, 0, 12, 2, '228', 1, 1, 0),
(316, 0, '', 2, 0, 12, 3, '', 0, 0, 0),
(317, 230, '', 2, 0, 12, 4, '229', 1, 1, 0),
(318, 0, '', 2, 0, 12, 5, '', 0, 0, 0),
(319, 231, '', 2, 0, 12, 6, '230', 1, 1, 0),
(320, 0, '', 2, 0, 12, 7, '', 0, 0, 0),
(321, 232, '', 2, 0, 12, 8, '231', 1, 1, 0),
(322, 0, '', 2, 0, 12, 9, '', 0, 0, 0),
(323, 233, '', 2, 0, 12, 10, '232', 1, 1, 0),
(324, 0, '', 2, 0, 12, 11, '', 0, 0, 0),
(325, 234, '', 2, 0, 12, 12, '233', 1, 1, 0),
(326, 0, '', 2, 0, 12, 13, '', 0, 0, 0),
(327, 235, '', 2, 0, 12, 14, '234', 1, 1, 0),
(328, 0, '', 2, 0, 12, 15, '', 0, 0, 0),
(329, 236, '', 2, 0, 12, 16, '235', 1, 1, 0),
(330, 0, '', 2, 0, 12, 17, '', 0, 0, 0),
(331, 237, '', 2, 0, 12, 18, '236', 1, 1, 0),
(332, 0, '', 2, 0, 12, 19, '', 0, 0, 0),
(333, 238, '', 2, 0, 12, 20, '237', 1, 1, 0),
(343, 244, '', 3, 0, 10, 6, '', 1, 1, 0),
(345, 240, '', 3, 0, 8, 4, '19;250', 1, 1, 0),
(347, 251, '', 3, 0, 10, 6, '240', 1, 1, 0),
(349, 256, '', 3, 0, 10, 8, '249;251', 1, 1, 0),
(350, 0, '', 3, -45, 9, 7, '', 0, 0, 0),
(351, 245, '', 3, 0, 8, 10, '241;256', 1, 1, 0),
(352, 19, '', 3, 0, 8, 2, '255', 1, 1, 0),
(354, 255, '', 3, 0, 8, 0, '', 1, 1, 0),
(378, 0, '', 3, 0, 8, 1, '', 0, 0, 0),
(379, 255, '', 3, 0, 10, 2, '19', 1, 1, 0),
(382, 0, '', 3, 0, 8, 3, '', 0, 0, 0),
(383, 250, '', 3, 0, 10, 2, '255', 1, 1, 0),
(384, 0, '', 3, -45, 9, 3, '', 0, 0, 0),
(385, 0, '', 3, 45, 9, 1, '', 0, 0, 0),
(387, 249, '', 3, 0, 8, 6, '240', 1, 1, 0),
(388, 0, '', 3, 45, 9, 5, '', 0, 0, 0),
(389, 0, '', 3, 0, 8, 5, '', 0, 0, 0),
(391, 241, '', 3, 0, 8, 8, '249;251', 1, 1, 0),
(392, 0, '', 3, 45, 9, 7, '', 0, 0, 0),
(393, 0, '', 3, 0, 10, 7, '', 0, 0, 0),
(394, 0, '', 3, 0, 8, 7, '', 0, 0, 0),
(395, 252, '', 3, 0, 10, 10, '241;256', 1, 1, 0),
(396, 264, '', 4, 0, 8, 2, '5', 1, 1, 0),
(397, 0, '', 4, 45, 9, 1, '', 0, 0, 0),
(398, 265, '', 4, 0, 8, 6, '326', 1, 1, 0),
(399, 0, '', 4, 0, 8, 3, '', 0, 0, 0),
(400, 266, '', 4, 0, 8, 10, '260', 1, 1, 0),
(401, 5, '', 4, 0, 8, 0, '', 1, 1, 0),
(402, 0, '', 4, 0, 8, 1, '', 0, 0, 0),
(403, 326, '', 4, 0, 8, 4, '264;16', 1, 1, 0),
(404, 0, '', 4, -45, 9, 3, '', 0, 0, 0),
(405, 260, '', 4, 0, 8, 8, '265;267', 1, 1, 0),
(407, 261, '', 4, 0, 8, 12, '266;268', 1, 1, 0),
(408, 0, '', 4, 0, 8, 9, '', 0, 0, 0),
(409, 262, '', 4, 0, 8, 16, '329;259', 1, 1, 0),
(410, 16, '', 4, 0, 10, 2, '5', 1, 1, 0),
(412, 267, '', 4, 0, 10, 6, '326', 1, 1, 0),
(413, 0, '', 4, 0, 8, 5, '', 0, 0, 0),
(414, 268, '', 4, 0, 10, 10, '260', 1, 1, 0),
(415, 0, '', 4, 0, 8, 7, '', 0, 0, 0),
(416, 269, '', 4, 0, 10, 14, '261', 1, 1, 0),
(417, 0, '', 4, -45, 9, 7, '', 0, 0, 0),
(418, 270, '', 4, 0, 10, 18, '262', 1, 1, 0),
(419, 329, '', 4, 0, 8, 14, '261', 1, 1, 0),
(421, 21, '', 5, 0, 8, 2, '12', 1, 1, 0),
(422, 0, '', 5, 0, 8, 1, '', 0, 0, 0),
(423, 283, '', 5, 0, 8, 6, '325', 1, 1, 0),
(424, 0, '', 5, 0, 4, 3, '', 0, 0, 0),
(425, 284, '', 5, 0, 8, 10, '279', 1, 1, 0),
(426, 12, '', 5, 0, 8, 0, '', 1, 1, 0),
(427, 0, '', 5, 0, 8, 3, '', 0, 0, 0),
(428, 325, '', 5, 0, 8, 4, '21;17', 1, 1, 0),
(430, 279, '', 5, 0, 8, 8, '283;275', 1, 1, 0),
(432, 280, '', 5, 0, 8, 12, '284;276', 1, 1, 0),
(434, 281, '', 5, 0, 8, 16, '327;277', 1, 1, 0),
(435, 17, '', 5, 0, 10, 2, '12', 1, 1, 0),
(436, 0, '', 5, -45, 9, 3, '', 0, 0, 0),
(437, 275, '', 5, 0, 10, 6, '325', 1, 1, 0),
(438, 0, '', 5, 0, 8, 5, '', 0, 0, 0),
(439, 276, '', 5, 0, 10, 10, '279', 1, 1, 0),
(440, 0, '', 5, 45, 9, 9, '', 0, 0, 0),
(441, 277, '', 5, 0, 10, 14, '280', 1, 1, 0),
(442, 278, '', 5, 0, 10, 18, '281', 1, 1, 0),
(443, 0, '', 5, 0, 8, 9, '', 0, 0, 0),
(444, 9, '', 5, 0, 4, 0, '', 1, 1, 0),
(445, 0, '', 5, 0, 4, 1, '', 0, 0, 0),
(446, 271, '', 5, 0, 4, 2, '9', 1, 1, 0),
(447, 0, '', 5, 0, 8, 7, '', 0, 0, 0),
(448, 273, '', 5, 0, 4, 4, '271', 1, 1, 0),
(449, 327, '', 5, 0, 8, 14, '280', 1, 1, 0),
(450, 0, '', 4, 0, 8, 11, '', 0, 0, 0),
(451, 0, '', 4, 0, 8, 13, '', 0, 0, 0),
(452, 0, '', 4, 0, 8, 15, '', 0, 0, 0),
(453, 0, '', 4, 45, 9, 9, '', 0, 0, 0),
(455, 0, '', 4, 45, 9, 13, '', 0, 0, 0),
(456, 0, '', 5, 45, 9, 1, '', 0, 0, 0),
(457, 0, '', 5, 45, 9, 5, '', 0, 0, 0),
(460, 0, '', 5, -45, 9, 7, '', 0, 0, 0),
(461, 0, '', 5, 0, 8, 11, '', 0, 0, 0),
(462, 0, '', 5, -45, 9, 11, '', 0, 0, 0),
(464, 0, '', 5, 0, 8, 13, '', 0, 0, 0),
(465, 0, '', 5, 0, 8, 15, '', 0, 0, 0),
(466, 0, '', 4, 0, 8, 17, '', 0, 0, 0),
(467, 330, '', 4, 0, 8, 18, '262', 1, 1, 0),
(468, 263, '', 4, 0, 8, 20, '330;270', 1, 1, 0),
(469, 0, '', 4, 0, 8, 19, '', 0, 0, 0),
(470, 18, '', 4, 0, 12, 0, '', 1, 1, 0),
(471, 0, '', 4, 45, 9, 5, '', 0, 0, 0),
(474, 0, '', 4, -45, 9, 11, '', 0, 0, 0),
(476, 0, '', 4, -45, 9, 15, '', 0, 0, 0),
(477, 0, '', 4, -45, 9, 19, '', 0, 0, 0),
(478, 0, '', 4, 45, 9, 17, '', 0, 0, 0),
(479, 0, '', 5, 0, 8, 17, '', 0, 0, 0),
(480, 328, '', 5, 0, 8, 18, '281', 1, 1, 0),
(481, 0, '', 5, 0, 8, 19, '', 0, 0, 0),
(482, 282, '', 5, 0, 8, 20, '328;278', 1, 1, 0),
(483, 0, '', 5, 45, 9, 13, '', 0, 0, 0),
(484, 0, '', 5, -45, 9, 15, '', 0, 0, 0),
(485, 0, '', 5, 45, 9, 17, '', 0, 0, 0),
(486, 0, '', 5, -45, 9, 19, '', 0, 0, 0),
(487, 3, '', 5, 0, 14, 0, '', 1, 1, 0),
(488, 0, '', 3, 0, 8, 9, '', 0, 0, 0),
(489, 0, '', 3, 0, 10, 9, '', 0, 0, 0),
(490, 0, '', 3, 45, 9, 9, '', 0, 0, 0),
(491, 0, '', 3, -45, 9, 9, '', 0, 0, 0),
(492, 242, '', 3, 0, 8, 12, '252;245', 1, 1, 0),
(493, 257, '', 3, 0, 10, 12, '252;245', 1, 1, 0),
(494, 0, '', 3, 0, 8, 11, '', 0, 0, 0),
(495, 0, '', 3, 0, 10, 11, '', 0, 0, 0),
(496, 0, '', 3, 45, 9, 11, '', 0, 0, 0),
(497, 0, '', 3, -45, 9, 11, '', 0, 0, 0),
(498, 246, '', 3, 0, 8, 14, '242;257', 1, 1, 0),
(499, 253, '', 3, 0, 10, 14, '242;257', 1, 1, 0),
(500, 0, '', 3, 0, 8, 13, '', 0, 0, 0),
(501, 0, '', 3, 0, 10, 13, '', 0, 0, 0),
(502, 0, '', 3, -45, 9, 13, '', 0, 0, 0),
(503, 0, '', 3, 45, 9, 13, '', 0, 0, 0),
(504, 243, '', 3, 0, 8, 16, '253;246', 1, 1, 0),
(505, 258, '', 3, 0, 10, 16, '253;246', 1, 1, 0),
(506, 0, '', 3, 0, 8, 15, '', 0, 0, 0),
(507, 0, '', 3, 0, 10, 15, '', 0, 0, 0),
(508, 0, '', 3, -45, 9, 15, '', 0, 0, 0),
(509, 0, '', 3, 45, 9, 15, '', 0, 0, 0),
(510, 259, '', 3, 0, 8, 18, '243;258', 1, 1, 0),
(511, 0, '', 3, 0, 8, 17, '', 0, 0, 0),
(512, 0, '', 3, -45, 9, 17, '', 0, 0, 0),
(513, 248, '', 3, 0, 8, 20, '259', 1, 1, 0),
(514, 254, '', 3, 0, 10, 20, '259', 1, 1, 0),
(515, 0, '', 3, 0, 8, 19, '', 0, 0, 0),
(516, 0, '', 3, 45, 9, 19, '', 0, 0, 0),
(517, 22, 'Saiyajin', 1, 0, 10, 5, '', 1, 1, 60),
(518, 0, 'Saiyajin', 1, -45, 9, 6, '', 0, 0, 0),
(519, 15, '', 4, 0, 14, 0, '', 1, 3, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `statslist`
--

CREATE TABLE `statslist` (
  `id` int(11) NOT NULL,
  `acc` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` int(11) NOT NULL,
  `win` int(11) NOT NULL,
  `loose` int(11) NOT NULL,
  `draw` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `dailywin` int(11) NOT NULL,
  `dailyloose` int(11) NOT NULL,
  `dailydraw` int(11) NOT NULL,
  `dailytotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `story`
--

CREATE TABLE `story` (
  `id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `titel` varchar(90) CHARACTER SET utf8 NOT NULL,
  `npc` int(11) NOT NULL,
  `supportnpc` int(11) NOT NULL,
  `text` longtext CHARACTER SET utf8 NOT NULL,
  `levelup` tinyint(1) NOT NULL,
  `place` varchar(90) CHARACTER SET utf8 NOT NULL,
  `planet` varchar(90) CHARACTER SET utf8 NOT NULL,
  `zeni` int(10) NOT NULL,
  `items` longtext CHARACTER SET utf8 NOT NULL,
  `survivalrounds` int(4) NOT NULL,
  `survivalteam` int(2) NOT NULL,
  `survivalwinner` int(2) NOT NULL,
  `action` int(11) NOT NULL,
  `healthratio` int(3) NOT NULL,
  `healthratioteam` int(2) NOT NULL,
  `healthratiowinner` int(2) NOT NULL,
  `startinghealthratioplayer` int(3) NOT NULL,
  `startinghealthratioenemy` int(3) NOT NULL,
  `skillpoints` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `story`
--

INSERT INTO `story` (`id`, `type`, `titel`, `npc`, `supportnpc`, `text`, `levelup`, `place`, `planet`, `zeni`, `items`, `survivalrounds`, `survivalteam`, `survivalwinner`, `action`, `healthratio`, `healthratioteam`, `healthratiowinner`, `startinghealthratioplayer`, `startinghealthratioenemy`, `skillpoints`) VALUES
(1, 1, 'Der Start', 5, 0, '[img]img/storyimages/story001.png[/img]\r\nUnsanft wird !player von seinem knurrenden Magen aus dem Schlaf gerissen, der ihn dann sogleich in die Küche treibt um seinen Hunger zu stillen, jedoch ist der Ofen aus und Feuerholz ist zu allem Übel auch keins mehr da. Kurzerhand mach er sich auf den Weg um welches im Wald zu sammeln.', 0, 'Wald', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(2, 1, 'Der Baum', 5, 0, '[img]img/storyimages/story002.png[/img]\r\n!player entdeckt im Wald einen Baum mit Äpfeln, auf den er sich gemütlich macht und einen Apfel isst.', 0, 'Wald', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(3, 2, 'Der Angriff', 1, 0, '[img]img/storyimages/story003.png[/img]\r\n!player lässt einen Apfel vom Baum fallen, wodurch ein Tiger getroffen wird und den Spieler nun wütend angreift.', 1, 'Wald', 'Erde', 250, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(4, 1, 'Rückreise', 5, 0, '[img]img/storyimages/story004.png[/img]\r\nNachdem !player den Tiger erfolgreich in die Flucht geschlagen hat, macht !player sich wieder auf den Weg zurück zur Hütte, um das gesammelte Brennholz zu benutzen.', 0, 'Hütte', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(5, 2, 'Das Auto', 6, 0, '[img]img/storyimages/story005.png[/img]\r\nWährend !player gerade das Brennholz in die Hütte bringen wollte, wird !player von einem schnellen Monster angegriffen.', 1, 'Hütte', 'Erde', 500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(6, 1, 'Die Fremde', 5, 0, '[img]img/storyimages/story006.png[/img]\r\nNachdem !player das schnelle Monster besiegt hat, kommt aus dem Monster ein Mädchen hervor. Das Mädchen stellt sich als Bulma vor und erklärt !player was ein Auto ist.', 0, 'Hütte', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(7, 1, 'Das Gewissen', 5, 0, '[img]img/storyimages/story007.png[/img]\r\nAus schlechtem Gewissen, wegen dem kaputten Auto, nimmt !player Bulma mit zur Hütte. Auf dem Weg dorthin erzählt Bulma etwas über die Suche nach den Dragonballs. Begeistert von ihrer Erzählung, entschließt !player, Bulma zu begleiten.', 0, 'Hütte', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(8, 1, 'Die Reise Beginnt', 5, 0, '[img]img/storyimages/story008.png[/img]Als sich beide auf den Weg machen wollen, bringt Bulma wie von Zauberhand einen Roller hervor, der ihnen das Reisen leichter macht.', 0, 'Ebene', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(9, 1, 'Das Geschäft', 5, 0, '[img]img/storyimages/story009.png[/img]Sie sind noch nicht lange unterwegs, als Bulma anhält um sich hinter einem Felsen zu erleichtern. ', 0, 'Ebene', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(10, 2, 'Der Angriff eines Dinosauriers', 2, 0, '[img]img/storyimages/story010.png[/img]\r\nAuf einmal ertönt ein Schrei, !player sieht wie Bulma von einem riesen Dinosaurier angegriffen wird und eilt ihr sofort zur Hilfe.', 1, 'Ebene', 'Erde', 1000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(11, 1, 'Das Treffen', 5, 0, '[img]img/storyimages/story011.png[/img]Vom Schock erholt machen sich die Beiden wieder auf den Weg, als sie auf eine Schildkröte treffen, die sie bittet, sie zum Meer zu bringen. Beide willigen ein.', 0, 'Bergweg', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(12, 2, 'Der Überfall', 3, 0, '[img]img/storyimages/story012.png[/img] Auf dem Weg zum Meer werden die Beiden plötzlich von einen Dieb überrascht, der sie auffordert, die Schildkröte zu übergeben.', 1, 'Bergweg', 'Erde', 1500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(13, 1, 'Zum Meer', 5, 0, '[img]img/storyimages/story013.png[/img]Nachdem !player den Bärenbandit besiegt hat, setzen sie ihren Weg zum Meer weiter fort.', 0, 'Meer', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(14, 1, 'Das Meer', 5, 0, '[img]img/storyimages/story014.png[/img]Am Meer angekommen bedankt sich die Schildkröte für die Begleitung und bittet die Beiden, einen Moment zu warten. ', 0, 'Meer', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(15, 1, 'Der Fremde', 5, 0, '[img]img/storyimages/story015.png[/img]Sie schwimmt für einen kurzen Augenblick weg und kommt einige Zeit später mit einem Passagier auf ihren Panzer zurück.', 0, 'Meer', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(16, 1, 'Die Wolke', 11, 0, '[img]img/storyimages/story016.png[/img]Danke, dass ihr auf meine Schildkröte aufgepasst habt. Als Geschenk möchte ich euch diese Wolke schenken.', 0, 'Meer', 'Erde', 0, '3@1', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(17, 1, 'Der Abschied', 5, 0, '[img]img/storyimages/story017.png[/img]\r\n!player und Bulma verabschieden sich von dem Herrn der Schildkröten und machen sich auf die weitere Suche nach den Dragonballs.', 0, 'Meer', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(18, 1, 'Das Verlassene Dorf', 5, 0, '[img]img/storyimages/story018.png[/img] Auf der Suche nach den Dragonballs stolpern die Beiden auf ein Dorf, mit vielen Häusern, jedoch ohne Menschen auf der Straße. Sie beschließen, in ein Haus zu gehen.', 0, 'Das Verlassene Dorf', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(19, 2, 'Plötzlicher Angriff', 48, 0, '[img]img/storyimages/story019.png[/img] \r\nAls !player die Tür öffnet, wird er aus dem Hinterhalt von einer Axt angegriffen.', 0, 'Das Verlassene Dorf', 'Erde', 2000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(20, 1, 'Entführung der Töchter', 48, 0, '[img]img/storyimages/story020.png[/img] Es tut mir Leid, ich dachte Sie wären Oolong! Bitte, helfen Sie uns! Oolong ist ein Gestaltwandler und er will unsere Töchter entführen. Achtung, er ist schon auf den Weg.', 0, 'Das Verlassene Dorf', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(21, 2, 'Der Oger', 12, 0, '[img]img/storyimages/story021.png[/img]Wo sind meine süßen Mädchen? Ich habe euch Blumen mitgebracht, kommt doch her! Ich beiße auch nicht, außer ihr möchtet es.', 1, 'Das Verlassene Dorf', 'Erde', 3000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(22, 2, 'Der Stier', 13, 0, '[img]img/storyimages/story022.png[/img] Ha, ich kann mich immernoch verwandeln! Du besiegst mich jetzt niemals!', 1, 'Das Verlassene Dorf', 'Erde', 3000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(23, 1, 'Das Schwein', 7, 0, '[img]img/storyimages/story023.png[/img] Es tut mir Leid! Ich werde euch zu den Mädchen führen.', 0, 'Das Verlassene Dorf', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(24, 1, 'Die Mädchen', 5, 0, '[img]img/storyimages/story024.png[/img]\r\nOolong führt !player und die Dorfbewohner zu seinem Haus. Das Haus ist riesig. Die Gruppe betritt es.', 0, 'Olongs Reich', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(25, 1, 'Die Rettung?', 5, 0, '[img]img/storyimages/story025.png[/img]\r\n\r\nDen Mädchen geht es im Haus prächtig. Sie entspannen, haben genug zu essen und müssen nichts tun.\r\nSie sind freiwillig nicht zurück gekommen, weil es ihnen im Haus so gut geht.\r\nDie Gruppe ist erleichtert und macht sich auf die weitere Suche nach den Dragonballs.', 0, 'Olongs Reich', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(26, 1, 'Durch die Wüste', 5, 0, '[img]img/storyimages/story026.png[/img]\r\n\r\nOolong schließt sich der Gruppe an und sie reisen durch eine Wüste. Bulma und Oolong sind von der Hitze erschöpft. Plötzlich verschwindet Bulma.', 0, 'Wüste', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(27, 2, 'Die diebische Katze', 9, 0, '[img]img/storyimages/story027.png[/img]\r\n\r\nFalls ihr eure Freundin wiedersehen wollt, gebt uns euer ganzes Geld und euer Besitz!', 1, 'Wüste', 'Erde', 3500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(28, 1, 'Yamchu', 5, 0, '[img]img/storyimages/story028.png[/img]\r\n\r\n!player kann Pool leicht besiegen, jedoch tritt nun Yamchu hervor und stellt sich !player entgegen. Er sieht Pool und wird daraufhin noch wütender.', 0, 'Wüste', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(29, 2, 'Kampf mit Yamchu', 8, 0, '[img]img/storyimages/story029.png[/img]\r\n\r\nStell dich mir! Ich bin bereit für einen Kampf.', 1, 'Wüste', 'Erde', 4000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(30, 1, 'Der Weg geht weiter', 5, 0, '[img]img/storyimages/story030.png[/img]\r\n\r\nDie Diebe lassen Bulma frei und verschwinden. Somit macht sich die Gruppe weiter auf der Suche nach den Dragonballs. Sie werden jedoch von Yamchu und Pool aus weiter Entfernung verfolgt.', 0, 'Wüste', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(31, 1, 'Ein brennender Berg', 5, 0, '[img]img/storyimages/story031.png[/img]\r\n\r\nAuf den Weg begegnen sie einen Berg, der komplett von Flammen umgeben ist. !player und Bulma staunen. Sie wollen sich den Berg näher anschauen.', 0, 'Der Bratpfannenberg', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(32, 2, 'Das Feuer', 49, 0, '[img]img/storyimages/story032.png[/img]\r\n\r\nDas Feuer lodert und brennt stark. !player stellt sich dem Feuer entgegen und beginnt den Kampf.', 1, 'Der Bratpfannenberg', 'Erde', 0, '', 100, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(33, 1, 'Ende des Feuers', 5, 0, '[img]img/storyimages/story033.png[/img]\r\n\r\nWährend !player gegen das Feuer kämpft, kommt der Herr der Schildkröten, sammelt Energie und entlässt ein Kamehameha, welches das komplette Feuer und den Berg zerstört.\r\nDie Gruppe macht sich also weiter auf der Suche nach den Dragonballs.', 0, 'Der Bratpfannenberg', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(34, 1, 'Die Pilzstadt', 5, 0, '[img]img/storyimages/story034.png[/img]\r\n\r\nDie Gruppe kommt auf ihren Weg in einer Pilzstadt. Sie hören von den Bürgern, dass die Karottenbande hier herrscht. Also suchen sie den Anführer.', 0, 'Die Pilzstadt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(35, 2, 'Das Karottenmonster', 50, 0, '[img]img/storyimages/story035.png[/img]\r\n\r\nNanu, wer seit denn ihr? Wollt ihr meine Hand schütteln?', 1, 'Die Pilzstadt', 'Erde', 4500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(36, 1, 'Neue Verbündete', 5, 0, '[img]img/storyimages/story036.png[/img]\r\n\r\nYamchu und Pool sammeln die Gruppe auf und Bulma kann sie überzeugen, dass die Gruppe mitgenommen wird. Zusammen reisen sie weiter. In der Ferne sehen sie ein Schloss.', 0, 'Prinz Pilafs Schloss', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(37, 2, 'Das Schloss von Pilaf', 51, 0, '[img]img/storyimages/story037.png[/img]\r\n\r\nDie Gruppe betritt das Schloss. daraufhin schließt sich die Tür und die Wände greifen die Gruppe an. Ebenfalls rollt eine Kugel auf sie zu.', 1, 'Prinz Pilafs Schloss', 'Erde', 5000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(38, 1, 'Das Training beginnt', 5, 0, '[img]img/storyimages/story038.png[/img]\r\n\r\n!player zerstört das komplette Schloss. Die Gruppe konnte sich gerade noch vor den Trümmern retten.\r\nDurch den harten Kampf hat !player gemerkt, dass er noch viel trainieren muss.\r\nAlso macht er sich auf den Weg zum Herrn der Schildkröten.', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(39, 1, 'Der Rivale', 5, 0, '[img]img/storyimages/story039.png[/img]\r\n\r\nAm Haus angekommen trifft !player auf Krillin. Sie beide wollen vom Herrn der Schildkröten trainiert werden. Doch bevor das Training beginnen kann, sollen sie eine hübsche Frau finden.', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(40, 1, 'Die hübsche Frau', 5, 0, '[img]img/storyimages/story040.png[/img]\r\n\r\nZusammen machen sie sich auf der Suche. In einer Stadt in der Wüste finden sie eine Frau, die gerade von der Polizei gesucht wird. Sie retten die Frau und nehmen sie mit.', 0, 'Brown Country', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(41, 2, 'Die wütende Frau', 28, 0, '[img]img/storyimages/story041.png[/img]\r\n\r\nBeim Herrn der Schildkröten angekommen betritt Lunch das Haus, während die anderen draußen warten. Plötzlich hört man ein Nießen und eine blonde Frau mit einem Maschinengewehr kommt aus dem Haus und greift an.', 1, 'Kame Haus', 'Erde', 5500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(42, 1, 'Die Trainingsinsel', 5, 0, '[img]img/storyimages/story042.png[/img]\r\n\r\nLunch verwandelt sich durch ein Niesen zurück. Sie entschuldigt sich und wird nun beim Herrn der Schildkröten leben. Herr der Schildkröten ist zufrieden und möchte die beiden trainieren.\r\nDafür bringt er sie auf eine Insel.', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(43, 1, 'Suche nach dem Stein', 5, 0, '[img]img/storyimages/story043.png[/img]\r\n\r\nKrillin und !player beginnen das Training beim großen Herr der Schildkröten. Nach einem kleinen Wettrennen zeigt der Herr der Schildkröten seinen beiden Schülern, dass sie die menschlichen Grenzen überschreiten müssen. Als nächstes Training nimmt er einen Stein und wirft ihn in den großen Wald auf der Insel. Diesen Stein müssen !player und Krillin suchen. Der Schnellere bekommt etwas zum Abendessen.', 0, 'Trainingsinsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(44, 1, 'Stein gefunden', 5, 0, '[img]img/storyimages/story044.png[/img]\r\n\r\n!player findet den Stein schneller. Daraufhin zeigt er ihn Krillin um ihm zu zeigen, dass es sich nicht um eine Fälschung handelt. Krillin schnappt sich den Stein und rennt davon.', 0, 'Trainingsinsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(45, 2, 'Kampf um den Stein', 10, 0, '[img]img/storyimages/story045.png[/img]\r\n\r\n!player kämpft gegen Krillin um den Stein. Der Gewinner bekommt den Stein und damit auch etwas zum Abendessen.\r\n', 1, 'Trainingsinsel', 'Erde', 6000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(46, 1, 'Der Gewinner beim Steinwettkampf', 5, 0, '[img]img/storyimages/story046.png[/img]\r\n\r\nKrillin wirft nach seiner Niederlage einen Stein zurück in den Wald worauf !player sofort den Stein suchen ging. Den richtigen Stein behält er aber wodurch er den Wettkampf gewinnt und etwas zum Essen bekommt.', 0, 'Trainingsinsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(47, 1, 'Das Festmahl', 5, 0, '[img]img/storyimages/story047.png[/img]\r\n\r\nZurück beim Herrn der Schildkröten trifft !player die Anderen, welche bereits beim Abendessen sind, da Krillin den Wettkampf zuvor gewonnen hat. Für !player gibt es nichts zum Essen. Am nächsten Tag geht es weiter mit dem Training.', 0, 'Trainingsinsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(48, 3, 'Die Milchlieferanten', 5, 0, '[img]img/storyimages/story048.png[/img]\r\n\r\nAuf der Trainingsinsel angekommen geht es endlich los. Das Training und die Vorbereitung für die Weltmeisterschaft beginnt. !player und Krillin sollen jeden Tag die Milch ausliefern und dies jeweils zu Fuß. Dazu kommen andere Arbeiten wie das Aushelfen auf einer Baustelle sowie jeden Tag das Schwimmen in einem See. !player und Krillin möchten lieber die Grundlagen der Kampftechnik lernen. Der Herr der Schildkröte erklärt ihnen aber, dass sie dafür zuerst Kraft und Geschwindigkeit aufbauen müssen.', 0, 'Trainingsinsel', 'Erde', 0, '', 0, 0, 0, 51, 0, 0, 0, 100, 100, 0),
(49, 1, 'Die Stärkung nach dem Training', 5, 0, '[img]img/storyimages/story049.png[/img]\r\n\r\nNach diesem anstrengenden Training wird es Zeit für ein Abendessen', 0, 'Trainingsinsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(50, 1, 'Das Training ist zu Ende', 11, 0, '[img]img/storyimages/story050.png[/img]\r\n\r\nIhr werdet überrascht sein, ich kann euch praktisch nichts mehr beibringen. Ihr könnt bereits alles. Ihr seid am Ende eures Trainings angelangt. Eure Augen, eure Hände, eure Füsse, jeder eurer Muskeln ist jetzt hart wie Stahl. Ihr versteht bestimmt, dass ich euch nichts mehr beibringen kann. Die Weltmeisterschaft beginnt bald.', 0, 'Trainingsinsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(51, 1, 'Die Weltmeisterschaft - Ankunft', 5, 0, '[img]img/storyimages/story051.png[/img]\r\n\r\nBei der Weltmeisterschaft angekommen treffen !player und Krillin auf  Bulma, Oolong, Yamchu und Pool. Sie begrüßen sich gegenseitig. Die Anmeldefrist für die Weltmeisterschaft läuft bald ab, deshalb macht sich !player schnell auf um sich anzumelden.', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(52, 2, 'Die Weltmeisterschaft - Qualifikationsrunde', 55, 0, '[img]img/storyimages/story052.png[/img]\r\n\r\nWas für eine Ehre soll ich denn erringen wenn ich gegen eine Mücke gewinne?', 1, 'Papayainsel', 'Erde', 6500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(53, 1, 'Die Weltmeisterschaft - Die Endrunden', 5, 0, '[img]img/storyimages/story053.png[/img]\r\n\r\nVon Sieg zu Sieg kämpft sich !player immer weiter bis in die Endrunde.\r\n!player qualifizierte sich dafür erfolgreich wo er als erstes auf Gilian, den fliegenden Drachen treffen wird.', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(54, 2, 'Die Weltmeisterschaft - Das Viertelfinal', 56, 0, '[img]img/storyimages/story054.png[/img]\r\n\r\nDu wärst besser nach Hause gegangen und hättest dein Fläschchen getrunken!', 1, 'Papayainsel', 'Erde', 7000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(55, 1, 'Der Sieg über Gilian', 5, 0, '[img]img/storyimages/story055.png[/img]\r\n\r\nNachdem !player Gilian erfolgreich besiegte ging es bereits in die Halbfinal Runde.\r\nDort wartet Nam auf !player.', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(56, 2, 'Der Kampf gegen Nam', 57, 0, '[img]img/storyimages/story056.png[/img]\r\n\r\nIch tue alles um das Preisgeld zu gewinnen und mit vollen Wassertanks in mein Dorf zurückzukehren.', 1, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(57, 1, 'Der Sieg gegen Nam', 5, 0, '[img]img/storyimages/story057.png[/img]\r\n\r\nNachdem Sieg über Nam zeigt Jacky Chun ihm einen Brunnen und gibt Nam eine Kapsel mit der er unbegrenzt viel Wasser transportieren kann. Nam wollte vom Preisgeld lediglich Wasser für sein von der Dürre geplagten Dorf kaufen und wusste nicht, dass er dieses umsonst von einem Brunnen in der Nähe holen kann.', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(58, 2, 'Das grosse Finale', 58, 0, '[img]img/storyimages/story058.png[/img]\r\n\r\nDas grosse Finale beginnt. Der Gegner ist Jacky Chun, der sehr an den Herrn der Schildkröte erinnert. Jacky Chun gewann in den Endrunden mit Leichtigkeit bereits gegen Yamchu und Krillin. Der Kampf um das grosse Preisgeld kann beginnen.', 1, 'Papayainsel', 'Erde', 8000, '', 0, 0, 0, 0, 50, 1, 0, 100, 100, 0),
(59, 1, 'Und der Gewinner heisst Jacky Chun', 5, 0, '[img]img/storyimages/story059.png[/img]\r\n\r\nNach einem sehr umkämpften Finale gewinnt Jacky Chun knapp das Finale. !player belegt somit den 2. Platz an der Weltmeisterschaft.', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(60, 1, 'Aufbruch', 5, 0, '[img]img/storyimages/story060.png[/img]\r\n\r\n!player und seine Freunde gehen jeweils getrennte Wege, da !player sich erneut auf die Suche nach den Dragonballs machen möchte.', 0, 'Wüsten-Stützpunkt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(61, 1, 'Die Red Ribbon Armee', 5, 0, '[img]img/storyimages/story061.png[/img]\r\n\r\nAuf der Suche nach den Dragonballs trifft !player auf einen Red Ribbon Stützpunkt in der Wüste an. Denn in der Umgebung befand sich ein Dragonball, welchen auch die Angehörigen der Red Ribbon Armee suchten. !player fand diesen Dragonball dank des genauen Radars jedoch schneller. Dies bemerkten jedoch auch die Red Ribbon Leute.', 0, 'Wüsten-Stützpunkt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(62, 2, 'Oberst Silver', 59, 0, '[img]img/storyimages/story062.png[/img]\r\nWir haben eine Armee und die beste Ausstattung die es gibt. Wie hast du den Dragonball so schnell gefunden? Ich bin Oberst Silver von der berüchtigten Red Ribbon Armee, gib mir den Dragonball und sag mir wie du die Dragonballs so schnell auffindest!', 1, 'Wüsten-Stützpunkt', 'Erde', 8500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(63, 1, 'Aufbruch Richtung Norden', 5, 0, '[img]img/storyimages/story063.png[/img]\r\nNachdem !player Oberst Silver besiegt hat macht er sich auf in Richtung Norden zum nächsten Dragonball.', 0, 'Jingledorf', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(64, 1, 'Der Muskelturm', 5, 0, '[img]img/storyimages/story064.png[/img]\r\n\r\nIn Jingledorf angekommen erfährt !player, dass die Red Ribon Armee einen Stützpunkt in der Nähe Namens Muskelturm besitzen. Dort befindet sich der Bürgermeister in Gefangenschaft sowie vermutlich ein Dragonball.', 0, 'Jingledorf', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(65, 2, 'Der Überfall', 60, 0, '[img]img/storyimages/story065.png[/img]\r\n\r\nWährend !player den Dragonball sucht, haben sich Soldaten im Dorf eingefunden und sich positioniert.', 1, 'Jingledorf', 'Erde', 9000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(66, 1, 'Aufbruch zum Muskelturm', 5, 0, '[img]img/storyimages/story066.png[/img]\r\n\r\nNach diesem Überfall entschloss sich !player, den Bürgermeister zu befreien.', 0, 'Muskelturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(67, 2, 'Leutnant Metallic', 61, 0, '[img]img/storyimages/story067.png[/img]\r\n\r\nLeutnant Metallic heisst dich willkommen. Zum Bürgermeister? Da musst du zuerst an mir vorbei Kleiner.', 1, 'Muskelturm', 'Erde', 10000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(68, 1, 'Der Cyborg ist besiegt', 5, 0, '[img]img/storyimages/story068.png[/img]\r\n\r\nWährend dem Kampf stellte sich schnell heraus, dass Leutnant Metallic eigentlich ein Cyborg ist. Als endlich die Batterien leer waren begibt sich !player schnell zur nächsten Etage, bevor sich das Monster wieder bewegt.', 0, 'Muskelturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(69, 2, 'Ninja Lila', 62, 0, '[img]img/storyimages/story069.png[/img]\r\n\r\n!player betritt eine neue Ebene im Turm und befindet sich in einem Wald. Daraufhin wird !player von hinten angegriffen.', 1, 'Muskelturm', 'Erde', 10500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(70, 1, 'Die Turmspitze', 5, 0, '[img]img/storyimages/story070.png[/img]\r\n\r\nAngekommen an der Spitze des Muskelturm trifft !player auf Leutnant White. Dieser betätigt aber einen Knopf weshalb sich eine Falltüre öffnet. !player fällt durch die Falltüre und fällt eine Etage runter.', 0, 'Muskelturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(71, 2, 'Das schreckliche Monster', 63, 0, '[img]img/storyimages/story071.png[/img]\r\n\r\nIm Keller trifft !player auf einmal auf ein riesen großes Monster, das aus einer Gummimasse besteht und sehr hungrig zu seien scheint. ', 1, 'Muskelturm', 'Erde', 11000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(72, 1, 'Zurück im Kontrollraum', 5, 0, '[img]img/storyimages/story072.png[/img]\r\n\r\n!player macht sich nun auf den Weg zurück zu den Kontrollraum. Dort angekommen, sieht er wie General White den Bürgermeister gefangen hält.', 0, 'Muskelturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(73, 2, 'Kampf mit White', 64, 0, '[img]img/storyimages/story073.png[/img]\r\n\r\nNach deinen Kampf mit Buyon bist du bestimmt erschöpft. Nun mache ich dich fertig!', 1, 'Muskelturm', 'Erde', 11500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(74, 1, 'Der Fall des Turmes', 5, 0, '[img]img/storyimages/story074.png[/img]\r\n\r\nGeneral White ist besiegt und durch den Kampf stürzt der Turm ein. \r\nNun macht sich !player auf, die weiteren Dragonballs zu suchen. Da jedoch der Radar im Kampf beschädigt wurde, sucht !player zunächst Bulma auf, da diese ihn reparieren könnte. ', 0, 'Muskelturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(75, 1, 'Die Westliche Hauptstadt', 5, 0, '[img]img/storyimages/story075.png[/img]\r\n\r\nAngekommen in der Westlichen Hauptstadt stellt sich heraus, dass Bulma zu finden eine schwerere Aufgabe darstellt, als zunächst gedacht. Beim Befragen der Passanten, kommt !player an einen Straßenboxer vorbei.', 0, 'Westliche Hauptstadt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(76, 2, 'Die 100.000 Zeni Challenge', 69, 0, '[img]img/storyimages/story076.png[/img]\r\n\r\nWer traut sich als Nächster? 100.000 Zeni für den, der mich besiegen kann. Genau, ich sagte 100.000! Kommen Sie, ich erwarte Sie schon!” Da ein Bisschen Taschengeld die Suche nach Bulma beschleunigen könnte, beschließt !player, die Herausforderung anzunehmen.', 0, 'Westliche Hauptstadt', 'Erde', 100000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(77, 1, 'Ein schneller Gewinn', 5, 0, '[img]img/storyimages/story077.png[/img]\r\n\r\nDen Gegner besiegt und mit dem Preisgeld in der Tasche, macht sich !player weiter auf die Suche nach seiner Freundin. Dank der Hilfe eines netten Polizistens, findet er diese auch schließlich am anderen Ende der Stadt. ', 0, 'Westliche Hauptstadt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(78, 1, 'Wiedersehen mit Bulma', 5, 0, '[img]img/storyimages/story078.png[/img]\r\n\r\nMit zwei, drei schnellen Eingriffen, konnte Bulma den Radar reparieren und begleitet nun !player auf seiner Suche nach den Dragonballs.', 0, 'Westliche Hauptstadt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(79, 1, 'Unterwasser', 5, 0, '[img]img/storyimages/story079.png[/img]\r\n\r\nDer nächste Dragonball soll sich Unterwasser befinden. !player trifft sich mit Bulma und Krillin und zusammen reisen sie Unterwasser.\r\n', 0, 'Unterwasser', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(80, 1, 'Uboot Verfolgung', 5, 0, '[img]img/storyimages/story080.png[/img]\r\n\r\nDoch während !player sich Unterwasser befindet wird er von General Blue und seiner Mannschaft in einem Uboot verfolgt.\r\n', 0, 'Unterwasser', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(81, 1, 'Die Piratenhöhle', 5, 0, '[img]img/storyimages/story081.png[/img]\r\n\r\n!player kommt in einer Höhle an und betritt diese. Dort ist zunächst nur ein langer beleuchteter Gang zu sehen. ', 0, 'Piratenhöhle', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(82, 2, 'Piraten-Roboter', 65, 0, '[img]img/storyimages/story082.png[/img]\r\n\r\nPlötzlich erscheint ein riesiger Piraten-Roboter der !player mit seinen Waffen angreift.\r\n', 1, 'Piratenhöhle', 'Erde', 12000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(83, 1, 'Der zerstörte Roboter', 5, 0, '[img]img/storyimages/story083.png[/img]\r\n\r\nDer Roboter ist besiegt und !player kämpft sich weiter durch die Höhle durch.\r\nWährenddessen laufen Bulma und Krillin einen anderen Weg.\r\n', 0, 'Piratenhöhle', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(84, 2, 'Ein Oktopus', 66, 0, '[img]img/storyimages/story084.png[/img]\r\n\r\nDaraufhin begegnet !player einen großen blauen Oktopus, der so gleich !player angreift.', 1, 'Piratenhöhle', 'Erde', 12500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(85, 1, 'Der Schatz', 5, 0, '[img]img/storyimages/story085.png[/img]\r\n\r\n!player besiegt den Oktopus und geht zurück zu Bulma und Krillin. Die Beiden haben mittlerweile den Schatz gefunden. Jedoch taucht General Blue auf.', 0, 'Piratenhöhle', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(86, 2, 'General Blue', 67, 0, '[img]img/storyimages/story086.png[/img]\r\n\r\nNun ist es an der Zeit dass ich dich besiege und mir eure Dragonballs nehme!', 1, 'Piratenhöhle', 'Erde', 13000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(87, 1, 'Die Höhle stürzt ein', 5, 0, '[img]img/storyimages/story087.png[/img]\r\n\r\nNach den Kampf beginnt die Höhle einzustürzen. !player, Bulma und Krillin rennen hinaus und finden noch einen Dragonball, den sie mitnehmen.', 0, 'Piratenhöhle', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(88, 1, 'Die Jagd nach Blue', 5, 0, '[img]img/storyimages/story088.png[/img]\r\n\r\nAls die drei wieder an der Oberfläche ankamen, konnte General Blue sie überlisten und schnappte sich die Dragonballs. Mit den Dragonballs flieht er zur nächsten Insel. ', 0, 'Pinguinhausen', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(89, 1, 'Pinguinhausen', 5, 0, '[img]img/storyimages/story089.png[/img]\r\n\r\nBlue kommt in einen Dorf an mit merkwürdigen Menschen. Dort wird Blue von einen kleinen Mädchen besiegt.', 0, 'Pinguinhausen', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(90, 1, 'Arale', 5, 0, '[img]img/storyimages/story090.png[/img]\r\n\r\nDas Mädchen ist Arale und sie freundet sich schnell mit !player an. !player erhält die Dragonballs zurück und macht sich auf die Suche, nach den nächsten Dragonball.', 0, 'Quittenwald', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(91, 1, 'Das neue Land', 5, 0, '[img]img/storyimages/story091.png[/img]\r\n\r\n!player findet sich in einem ruhigen Wald wieder, als man plötzlich Schüsse hört. !player nähert sich einer kleinen Lichtung, welche von zwei Personen bewohnt wird und unter Beschuss steht.', 0, 'Quittenwald', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(92, 2, 'Oberst Yellow', 70, 0, '[img]img/storyimages/story092.png[/img]\r\n\r\nDarf ich bitten, her mit dem Dragonball! Das ist ein Befehl!', 1, 'Quittenwald', 'Erde', 14500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(93, 1, 'Der Quittenturm', 5, 0, '[img]img/storyimages/story093.png[/img]\r\n\r\nNachdem !player Oberst Yellow und die Red Ribbon Armee in die Flucht geschlagen hat, erfährt !player vom Quittenturm und vom magischem Wasser. Doch bevor !player den Turm erklimmen kann, erscheint ein mysteriöser und starker Feind.', 0, 'Quittenwald', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(94, 2, 'Der stärkste Söldner: Tao BaiBai', 71, 0, '[img]img/storyimages/story094.png[/img]\r\n\r\nDie Red Ribbon Armee schickt mich, sie hält dich für einen Störenfried. Händige mir den Dragonball aus und dir wird nichts passieren!', 0, 'Quittenwald', 'Erde', 15000, '', 0, 0, 0, 0, 50, 1, 0, 100, 100, 0),
(95, 3, 'Die Turmbesteigung', 5, 0, '[img]img/storyimages/story095.png[/img]\r\n\r\n!player wurde fast vom Söldner getötet. Upa, der scheinbar einzige Überlebende dieser Begegnung, wollte !player die letzte Ehre erweisen und !player bestatten, doch dieser rührt sich noch. Da !player merkt, dass man selbst noch viel zu lernen hat, beschließt !player den Quittenturm zu besteigen und das magische Wasser zu trinken.', 0, 'Quittenwald', 'Erde', 0, '', 0, 0, 0, 56, 0, 0, 0, 100, 100, 0),
(96, 1, 'Der Quittenturm', 5, 0, '[img]img/storyimages/story096.png[/img]\r\n\r\n!player hat fast die Spitze des Turms, eine kreisrunden Plattform, erreicht. Dort angekommen, will !player nach dem magischen Wasser suchen. ', 0, 'Quittenturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(97, 2, 'Kampf mit Korin', 25, 0, '[img]img/storyimages/story097.png[/img]\r\n\r\nAuf der Plattform angekommen, trifft !player auf einen Kater. Der Kater stellt sich als Meister Korin vor, Bewacher des magischen Wassers.\r\n“Wenn du das magische Wasser haben möchtest, dann musst du dich zunächst beweisen.”', 1, 'Quittenturm', 'Erde', 15000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(98, 1, 'Das magische Wasser', 5, 0, '[img]img/storyimages/story098.png[/img]\r\n\r\n“Du hast dich bewiesen und darfst nun vom magischen Wasser trinken. Doch zunächst muss ich dir gestehen, dass es sich hierbei um ganz gewöhnliches Wasser handelt.” !player stellt zu seinem Erstaunen fest, dass nicht das Trinken, sondern das Erlangen des Wassers einem die Stärke verliehen hat. Nun ist !player bereit, dem Söldner noch einmal entgegen zu treten.  ', 0, 'Quittenturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 1),
(99, 1, 'Zurück zum Wald', 5, 0, '[img]img/storyimages/story099.png[/img]\r\n\r\nDen Turm hinabgestiegen und zurück auf der Lichtung angekommen, wird !player bereits vom siegessicheren Söldner erwartet. \r\n', 0, 'Quittenwald', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(100, 2, 'Rematch mit Tao BaiBai', 71, 0, '[img]img/storyimages/story100.png[/img]\r\n\r\nIch bin ehrlich überrascht, dich vor mir zu sehen. Das beweist nicht nur Mut, sondern auch eine gewisse Zähigkeit. Meinen Energiestrahl hat bisher noch nie jemanden widerstanden und dieses Mal werde ich darauf achten, dass es auch so bleibt!', 1, 'Quittenwald', 'Erde', 16000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(101, 1, 'Tao BaiBai ist besiegt', 5, 0, '[img]img/storyimages/story101.png[/img]\r\n\r\nNach einem langen Schlagabtausch, konnte !player schlussendlich siegreich aus dem Duell rausgehen. Der Söldner ist Geschichte und mit den wiedererlangten Dragonballs, geht es nun zum Hauptquartier der Red Ribbon Armee. ', 0, 'RR-Hauptquartier', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(102, 1, 'Ein hinterlistiger Plan', 5, 0, '[img]img/storyimages/story102.png[/img]\r\n\r\nLaut dem Radar, befinden sich zwei Dragonballs irgendwo auf dem Gelände des Hauptquartiers der Red Ribbon Armee. Doch Kommandant Red, der ebenfalls über ein Radar verfügt, wartet schon auf die Ankunft von !player. ', 0, 'RR-Hauptquartier', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(103, 2, 'Adjutant Black', 74, 0, '[img]img/storyimages/story103.png[/img]\r\n\r\nBevor !player den Kommandanten zur Rede stellen kann, stellt sich zunächst sein Assistent, Adjutant Black, in den Weg. “Ich weiß, dass du wegen den Dragonballs hier bist, aber das kannst du schnell wieder vergessen. Die bekommst du nicht. Deine Reise endet hier!.”', 1, 'RR-Hauptquartier', 'Erde', 16500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(104, 1, 'Das Ende vom Kommandanten', 5, 0, '[img]img/storyimages/story104.png[/img]\r\n\r\nDer Falle von Kommandant Red entkommen, belauschen !player und Adjutant Black den Kommandanten, welcher offenbart, was er sich von den Dragonballs erwünscht. Enttäuscht über seinen Kommandanten, wird dieser von Black erschossen, welcher somit die Führung der Red Ribbon Armee übernimmt. ', 0, 'RR-Hauptquartier', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(105, 2, 'Die Kampfrüstung', 75, 0, '[img]img/storyimages/story105.png[/img]\r\n\r\nDa der Vorschlag, gemeinsam über die Welt zu regieren, von !player abgelehnt wurde, stellt sich Black dem finalen Kampf, aber nicht, ohne vorher in seine neue Kampfrüstung zu schlüpfen. ', 1, 'RR-Hauptquartier', 'Erde', 17000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(106, 1, 'Die Red Ribbon Army ist besiegt', 5, 0, '[img]img/storyimages/story106.png[/img]\r\n\r\nNachdem nun alle Offiziere der Red Ribbon Armee besiegt wurden und sechs der sieben Dragonballs sich im Besitz von !player befinden, macht sich !player, zusammen mit seinen Freunden, auf den Weg, den letzten Dragonball zu finden. Da dieser jedoch nicht auf dem Radar angezeigt wird, bleibt !player keine andere Wahl, als die Wahrsagerin Uranai Baba aufzusuchen. ', 0, 'Uranai Babas Palast', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(107, 1, 'Ankunft in Uranai Babas Palast', 5, 0, '[img]img/storyimages/story107.png[/img]\r\n\r\nAm Palast der Wahrsagerin angekommen, müssen !player und seine Freunde feststellen, dass die Dienste der Wahrsagerin entweder mit einer Unsumme an Zeni oder dem Besiegen ihrer fünf Wächter, wahrzunehmen sind. Überzeugt von der, durch die letzte Reise neu gewonnenen Stärke, entscheidet sich !player für die letztere Variante.', 0, 'Uranai Babas Palast', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(108, 1, 'Die Wächter', 5, 0, '[img]img/storyimages/story108.png[/img]\r\n\r\nDoch die fünf Wächter scheinen nicht von dieser Welt zu sein und überraschen mit besonderen Fähigkeiten und merkwürdigen Taktiken. So kommt es, dass zwar zwei Wächter besiegt wurden, aber nur noch !player als einziger Kämpfer vom Team übrig bleibt. ', 0, 'Uranai Babas Palast', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(109, 2, 'Die Mumie', 78, 0, '[img]img/storyimages/story109.png[/img]\r\n\r\nDer dritte Wächter, eine zum Leben wiedererweckte Mumie, betritt die Arena. “Weißt du wie lange ich davon geträumt habe, mir die Beine zu vertreten? Und dann kommt mir so ein Würstchen wie du unter, das ist sehr erheiternd!”', 1, 'Uranai Babas Palast', 'Erde', 18000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(110, 2, 'Ein Teufel', 79, 0, '[img]img/storyimages/story110.png[/img]\r\n\r\nDie Mumie erledigt, bleibt !player keiner Zeit sich ausruhen. Der vierte Wächter, Akkuman, macht sich zum Kampf bereit.\r\n“Du Abschaum wagst es dich mir, dem leibhaftigen Teufel, in den Weg zu stellen? Ich schick dich zu mir nach Hause in die Hölle! ”', 1, 'Uranai Babas Palast', 'Erde', 18500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(111, 2, 'Der fünfte Wächter', 80, 0, '[img]img/storyimages/story111.png[/img]\r\n\r\nMit dem vierten Wächter besiegt, haben nun beide Seiten jeweils nur noch einen Kämpfer übrig. Als letzter Gegner betritt ein maskierte Mann die Arena. \r\n“Ich bin der Auffassung, wir sollten uns erst einmal vorstellen. Obwohl, verschieben wir das doch lieber nach dem Kampf. Viel Erfolg, du wirst es brauchen!”', 1, 'Uranai Babas Palast', 'Erde', 19000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(112, 1, 'Der letzte Dragonball', 5, 0, '[img]img/storyimages/story112.png[/img]\r\n\r\nDer letzte Wächter war eine harte Nuss, aber letztendlich konnte !player auch ihn bezwingen. Wie versprochen, offenbarte Uranai Baba die Position des letzten Dragonballs, der sich überraschenderweise ganz in der Nähe befand.  ', 0, 'Stadtstraße', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(113, 2, 'Prinz Pilafs Revanche', 81, 0, '[img]img/storyimages/story113.png[/img]\r\n\r\nPilaf und seine Gehilfen haben es geschafft, in den Besitz eines Dragonballs zu gelangen und mit Hilfe einer besonderen Box, diesen vor dem Radar zu verstecken. Doch dank der magischen Fähigkeiten der Uranai Baba, konnte !player diesen ausfindig machen. \r\nJetzt gilt es nur noch, ihnen diesen abzunehmen. Doch dafür muss !player erst an der neusten Kreation von Pilaf, einer riesigen Maschine, vorbei.', 1, 'Stadtstraße', 'Erde', 19500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(114, 1, 'Zurück zum Palast', 5, 0, '[img]img/storyimages/story114.png[/img]\r\n\r\nDie Maschine zerlegt und mit dem letzten Dragonball im Besitz, macht sich !player auf zu Uranai Baba, um dort den legendären Drachen zu beschwören. ', 0, 'Uranai Babas Palast', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(115, 1, 'Der Wunsch', 5, 0, '[img]img/storyimages/story115.png[/img]\r\n\r\nMit allen sieben Dragonballs beisammen, beschwört !player den legendären Drachen Shenlong, um sich einen Wunsch erfüllen zu lassen.  ', 0, 'Uranai Babas Palast', 'Erde', 0, '150@1', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(116, 1, 'Das nächste größe Turnier', 5, 0, '[img]img/storyimages/story116.png[/img]\r\n\r\nNachdem der Drache verschwunden ist, macht sich auch !player für das nächste Abenteuer bereit: Das kommende Große Turnier!', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(117, 1, 'Zurück auf den Papayainseln', 5, 0, '[img]img/storyimages/story117.png[/img]\r\n\r\nAngekommen auf dem Turniergelände, trifft !player auf Killin und Yamchu, welche auch am Turnier teilnehmen werden. Auch zwei Schüler von Meister Shen, dem Erzfeind von Meister Roshi, haben sich angemeldet. ', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(118, 2, 'Die Vorrunden', 82, 0, '[img]img/storyimages/story118.png[/img]\r\n\r\nNach seiner letzten Niederlage im Finale, hat sich !player fest vorgenommen dieses Mal zu Siegen. Doch schon die Vorrunde scheint deutlich schwieriger zu werden, als beim letzten Mal. Der erste Gegner, den es zu besiegen gilt, ist ein ehemaliger Sieger des Turniers: King Chapa', 1, 'Papayainsel', 'Erde', 20000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(119, 2, 'Das Viertelfinale!', 83, 0, '[img]img/storyimages/story119.png[/img]\r\n\r\nDurch den Sieg gegen King Chapa, hat sich !player für die Endrunde qualifiziert. Auch Krillin und Yamchu, sowie Chiaotzu und Tenshinhan, die beiden Schüler von Meister Shen, haben es erfolgreich ins Viertelfinale geschafft. Der nächste Gegner, Pamput, wartet bereits siegessicher in der Arena.', 1, 'Papayainsel', 'Erde', 20500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(120, 2, 'Freund und Rivale', 84, 0, '[img]img/storyimages/story120.png[/img]\r\n\r\nIm Halbfinale angekommen, wartet nun ein Freund und Rivale, Krillin, auf !player. Auch dieser hat seit ihrem letzten Kampf deutlich an Stärke und Erfahrung hinzugewonnen.', 1, 'Papayainsel', 'Erde', 21000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(121, 2, 'Das Finale gegen Tenshinhan', 86, 0, '[img]img/storyimages/story121.png[/img]\r\n\r\nNach dem spannenden Kampf im Halbfinale gegen Krillin, muss !player nun im Finale gegen Tenshinhan ran. Beide Finalisten haben bis hierhin herausragende Leistungen gezeigt und ihr Können unter Beweis gestellt. Doch nur einer kann der neue Champion werden!', 1, 'Papayainsel', 'Erde', 21500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(122, 1, 'Der Sieger des 22. Großen Turniers', 5, 0, '[img]img/storyimages/story122.png[/img]\r\n\r\nNach einem langen und harten Kampf konnte Tenshinhan !player schlussendlich besiegen, indem er den Kampfring zerstörte und ein Aus erzwang. Somit ist Tenshinhan der Sieger des 22. Großen Turniers!', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 1),
(123, 1, 'Krillins Tod', 5, 0, '[img]img/storyimages/story123.png[/img]\r\n\r\nPlötzlich war ein lauter Schrei zu hören. Beim Suchen des Verursachers, stieß !player auf den leblosen Körper von Krillin. Der Täter, ein grünes geflügeltes Monster, flüchtete mit dem Dragonball von Krillin in der Hand. Mit Hilfe des Radars nahm !player die Verfolgung auf. ', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(124, 2, 'Ein neuer Feind', 94, 0, '[img]img/storyimages/story125.png[/img]\r\n\r\nNach einem kurzem Flug, hat !player es geschafft, den Täter noch vor dem Verlassen der Insel abzufangen. Das Monster stellt sich als Tamburin vor, ein Diener vom Oberteufel Piccolo. Bevor !player jedoch mehr in Erfahrung bringen kann, greift Tamburin an!', 0, 'Papayainsel', 'Erde', 23000, '', 0, 0, 0, 0, 75, 1, 0, 50, 100, 0),
(125, 1, 'Die Jagd nach Tamurin', 5, 0, '[img]img/storyimages/story124.png[/img]\r\n\r\nDa !player noch erschöpft vom Finale war, stellte sich der Kampf als ziemlich einseitig heraus. Tamburin ließ !player zum Sterben zurück, jedoch konnte sich !player, nach kurzer Zeit, von den Verletzungen erholen und nimmt nun erneut die Verfolgung auf.', 0, 'Yajirobis Prärie', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(126, 1, 'Ankunft im Dschungel', 5, 0, '[img]img/storyimages/story126.png[/img]\r\n\r\nBeim überfliegen der lokalen Prärie, bemerkt !player, dass sich ganz in der Nähe ein Dragonball befinden muss. In der Hoffnung, dass es sich hierbei um Tamburin handelt, landet !player in der Nähe des Signals, jedoch ist hier nur ein scheinbar verlassenes Lager zu sehen. Noch hungrig vom Finale bedient sich !player an dem dortigen Essen.', 0, 'Yajirobis Prärie', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(127, 2, 'Freund oder Feind?', 88, 0, '[img]img/storyimages/story127.png[/img]\r\n\r\nNachdem !player den ganzen Vorrat verschlungen hat, taucht auch der Bewohner des Lagers auf, welcher !player für einen Dieb hält und sich zum Angriff bereit macht.', 1, 'Yajirobis Prärie', 'Erde', 22000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(128, 1, 'Yajirobis Dragonball', 5, 0, '[img]img/storyimages/story128.png[/img]\r\n\r\nDer Schlagabtausch der Beiden wird unterbrochen, als !player den Dragonball des Bewohners bemerkt, welchen er um den Hals trägt. Der Unbekannte stellt sich als Yajirobi vor und fand den Dragonball auf einen seiner Reisen durch die Welt. Da Tamburin nach den Dragonballs sucht, versucht !player Yajirobi zu überreden, den Dragonball abzugeben. ', 0, 'Yajirobis Prärie', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(129, 2, 'Tamburins Bruder, Zimbel!', 89, 0, '[img]img/storyimages/story129.png[/img]\r\n\r\nDoch bevor Yajirobi darauf antworten kann, taucht ein weiterer Diener des Oberteufels auf, Zimbel. Auch dieser zögert nicht lange und geht direkt zum Angriff über.', 1, 'Yajirobis Prärie', 'Erde', 22500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(130, 2, 'Revanche gegen Tamburin!', 94, 0, '[img]img/storyimages/story130.png[/img]\r\n\r\nMit Zimbels Tod, beschließt Yajirobi !player seinen Dragonball abzugeben, da er befürchtet Ziel weiterer Angriffe zu werden. Doch bevor !player sich verabschieden und die Suche nach Tamburin fortsetzen kann, wird !player von genau diesem angegriffen, welcher den Tod seines Bruders rächen soll.', 1, 'Yajirobis Prärie', 'Erde', 23000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(131, 1, 'Rache für Krillin', 5, 0, '[img]img/storyimages/story131.png[/img]\r\n\r\nAusgeruht und voller Energie, stellt Tamburin keinen Gegner für !player da und wird problemlos von diesem besiegt. Krillin gerächt und den Dragonball zurückgewonnen, möchte !player sich nun zurück zum Turniergelände aufmachen, als plötzlich ein komisches Flugobjekt landet.', 0, 'Yajirobis Prärie', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(132, 2, 'Kampf gegen den Oberteufel', 90, 0, '[img]img/storyimages/story132.png[/img]\r\n\r\nAus diesem steigt eine merkwürdige grüne Person aus, welche sich als Oberteufel Piccolo vorstellt. Der Oberteufel hat bereits fünf der sieben Dragonball zusammen und möchte sich nun, die restlichen Beiden von !player holen.', 1, 'Yajirobis Prärie', 'Erde', 24000, '', 0, 0, 0, 0, 50, 1, 0, 100, 100, 0),
(133, 1, 'Wunsch des Oberteufels', 5, 0, '[img]img/storyimages/story133.png[/img]\r\n\r\n!player ist chancenlos im Kampf gegen den Oberteufel und liegt nach dem Kampf im Sterben. Der Oberteufel hat währenddessen alle Dragonballs zusammen und beschwört den heiligen Drachen Shenlong, um sich wieder jung und in Höchstform zu wünschen. Nach dem Wunsch tötet er diesen, zerstört damit die Dragonballs und macht sich auf, die Welt zu erobern.', 0, 'Yajirobis Prärie', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(134, 1, 'Neue Entschlossenheit', 5, 0, '[img]img/storyimages/story134.png[/img]\r\n\r\nYajirobi, der sich die ganze Zeit in der Nähe versteckt hielt, schnappt sich !player und macht sich zum Quittenturm auf, um dort nach Hilfe zu suchen. ', 0, 'Quittenturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(135, 1, 'Das göttliche Wasser', 5, 0, '[img]img/storyimages/story135.png[/img]\r\n\r\nBeim Quittenturm angekommen, wird !player von Meister Korin geheilt und erfährt, dass dieser nichts mehr zu Lehren hat. Jedoch erzählt er von der Legende des göttlichen Wassers und die wundersame Stärke, aber auch die Gefahren, die die Suche nach dem Wasser mit sich bringt. Mit keiner anderen Wahl, macht sich !player auf die Suche nach dem göttlichen Wasser.', 0, 'Eislabyrinth', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(136, 1, 'Das Eislabyrinth', 5, 0, '[img]img/storyimages/story136.png[/img]\r\n\r\nIm Labyrinth angekommen, stellt !player fest, dass dies ein seltsamer Ort ist. Das kalte Klima, die Dunkelheit und die komischen einheimischen Kreaturen, treiben !player immer weiter ins Innere des Labyrinths. Nach einem langen Hin und Her, schafft es !player ins Zentrum des Labyrinths zu gelangen.', 0, 'Eislabyrinth', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(137, 2, 'Die Finsternis im Labyrinth', 91, 0, '[img]img/storyimages/story137.png[/img]\r\n\r\nDort angekommen trifft !player überraschenderweise auf alte Bekannte sowie Muten Roshi. Diese wollen !player zum Bleiben bewegen, jedoch durchschaut !player die Illusionen und wird daraufhin vom finsteren Muten Roshi angegriffen.', 1, 'Eislabyrinth', 'Erde', 24500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(138, 3, 'Sieg über die Finsternis', 5, 0, '[img]img/storyimages/story138.png[/img]\r\n\r\nNach dem Sieg über den Doppelgänger, stellt sich dieser als Finsternis, Hüter des göttlichen Wassers, vor. Dieser empfindet !player nun als würdig das Wasser zu trinken, warnt jedoch nochmal vor der tödlichen Gefahr. Um den Oberteufel besiegen zu können, entschließt sich !player das göttliche Wasser zu trinken.', 0, 'Eislabyrinth', 'Erde', 0, '', 0, 0, 0, 57, 0, 0, 0, 100, 100, 0),
(139, 1, 'Neue Stärke', 5, 0, '[img]img/storyimages/story139.png[/img]\r\n\r\n!player hat das göttliche Wasser überlebt und ist nun so stark wie nie zuvor. Mit der neu gewonnenen Stärke, ist !player nun bereit den Oberteufel ein für alle mal zu besiegen. Doch um diesen ausfindig zu machen, benötigt !player erneut die Hilfe von Meister Korin.', 0, 'Quittenturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(140, 1, 'Die Herrschaft des Oberteufels', 5, 0, '[img]img/storyimages/story140.png[/img]\r\n\r\nBei Korin angekommen erfährt !player, dass der Oberteufel King Castle, die Hauptstadt der Welt, eingenommen hat und von dort aus nun die gesamte Welt regiert. Um rechtzeitig dort anzukommen, bevor den Menschen noch mehr Leid zugefügt wird, schenkt Meister Korin !player eine verbesserte Jindujun.', 0, 'King Castle', 'Erde', 0, '171@1', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(141, 2, 'Der letzte Diener, Trommel!', 92, 0, '[img]img/storyimages/story141.png[/img]\r\n\r\nIn der Hauptstadt angekommen, kann !player die Angst und Anspannung der Bewohner spüren. Auf dem Weg zum König trifft !player auf Tenshinhan, welcher gegen den letzten Diener des Oberteufels kämpft und zu verlieren scheint. Um nicht noch einen Freund zu verlieren, mischt sich !player in den Kampf ein.', 1, 'King Castle', 'Erde', 25000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(142, 2, 'Die finale Schlacht!', 93, 0, '[img]img/storyimages/story142.png[/img]\r\n\r\nNachdem nun auch der letzte Diener besiegt wurde, stellt sich nun der gestärkte Oberteufel in den Weg von !player, um !player ein für alle mal auszulöschen.', 1, 'King Castle', 'Erde', 26000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(143, 1, 'Der Tod des Oberteufels', 5, 0, '[img]img/storyimages/story143.png[/img]\r\n\r\nNach einem erbitterten Kampf, schaffte es !player den Oberteufel zu bezwingen und zu töten. Nun ist endlich wieder Frieden auf der Welt eingekehrt. Jedoch sind die Dragonballs zerstört und mit ihnen die Möglichkeit, die Opfer des Oberteufels und seiner Diener, wiederzubeleben. Auf der Suche nach einer Lösung, macht sich !player auf den Weg zum Quittenturm, um Meister Korin um Rat zu fragen.', 0, 'Quittenturm', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0);
INSERT INTO `story` (`id`, `type`, `titel`, `npc`, `supportnpc`, `text`, `levelup`, `place`, `planet`, `zeni`, `items`, `survivalrounds`, `survivalteam`, `survivalwinner`, `action`, `healthratio`, `healthratioteam`, `healthratiowinner`, `startinghealthratioplayer`, `startinghealthratioenemy`, `skillpoints`) VALUES
(144, 1, 'Der Erschaffer der Dragonballs', 5, 0, '[img]img/storyimages/story144.png[/img]\r\n\r\nBei Korin angekommen, erzählt dieser !player von Gott, dem Erschaffer der Dragonballs. Dieser haust in einem Palast über dem Quittenturm, empfängt jedoch nur Gäste, welche sich als würdig erwiesen haben. Mit keiner anderen Wahl, macht sich !player auf dem Weg zu Gottespalast.', 0, 'Gottespalast', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(145, 2, 'Der stärkste Kämpfer', 96, 0, '[img]img/storyimages/story145.png[/img]\r\n\r\nDort angekommen erwartet !player bereits eine komische Gestalt namens Mr. Popo. Dieser soll der stärkste Kämpfer auf Erden sein und lässt nur jene Gott treffen, welche sich im Kampf als würdig erwiesen haben.', 0, 'Gottespalast', 'Erde', 26500, '', 0, 0, 0, 0, 50, 1, 0, 100, 100, 0),
(146, 3, 'Training mit Mr. Popo', 5, 0, '[img]img/storyimages/story146.png[/img]\r\n\r\nMr. Popo empfindet !player als unwürdig, da ihm die nötige Disziplin fehlt, um ihn jemals im Kampf schlagen zu können. !player bittet ihn daraufhin als Training, weiter gegen ihn Kämpfen zu dürfen.', 0, 'Gottespalast', 'Erde', 0, '', 0, 0, 0, 58, 0, 0, 0, 100, 100, 0),
(147, 1, 'Treffen mit Gott', 5, 0, '[img]img/storyimages/story147.png[/img]\r\n\r\nGott, welcher das Training von !player beobachtete, entschied sich, sich !player zu offenbaren. Er erzählt !player, dass er und Piccolo einmal Eins waren und dass die Reinkarnation des Oberteufels momentan auf Erden wandert.', 0, 'Gottespalast', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(148, 3, 'Training mit Gott', 5, 0, '[img]img/storyimages/story148.png[/img]\r\n\r\nDieser trainiert für das kommende große Turnier, um dort Rache an !player nehmen zu können. Gott schlägt !player vor, hier im Palast weiter zu trainieren, um sich auf die kommende Bedrohung vorzubereiten. Währenddessen würde Gott die Opfer des Oberteufels und seiner Diener, mit den neu geschaffenen Dragonballs, zurück ins Leben rufen.', 0, 'Gottespalast', 'Erde', 0, '', 0, 0, 0, 59, 0, 0, 0, 100, 100, 0),
(149, 1, 'Auf zum Turnier!', 5, 0, '[img]img/storyimages/story149.png[/img]\r\n\r\nNach dem Training mit Gott, fühlt sich !player nun bereit für das kommende große Turnier und freut sich dort die alte Gruppe aus Freunden und Rivalen wieder zu treffen. ', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(150, 1, 'Das 23. große Turnier', 5, 0, '[img]img/storyimages/story150.png[/img]\r\n\r\nAngekommen auf der Papayainsel, trifft !player endlich alle wieder. Yamchu und Krillin entschieden sich erneut ebenfalls dazu, am Turnier teilzunehmen. Gemeinsam geht es nun weiter, die Vorrunde des 23. großen Turniers zu bestreiten!', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(151, 2, 'Bekannter Gegner', 82, 0, '[img]img/storyimages/story151.png[/img]\r\n\r\nIn der Vorrunde trifft !player auf einen ehemaligen Gegner, King Chapa! Dieser möchte seine letzte Niederlage gegen !player wiedergutmachen und dieses Mal die Endrunde erreichen!', 0, 'Papayainsel', 'Erde', 26500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(152, 1, 'Für die Endrunde qualifiziert', 5, 0, '[img]img/storyimages/story152.png[/img]\r\n\r\nDurch sein letztes Abenteuer, ist !player um einiges stärker geworden, sodass King Chapa keinerlei Chance hatte. Mit dem Sieg, zieht !player in die Endrunde ein. Auch Krillin und Yamchu haben es geschafft, ihre Gegner zu besiegen und in die Endrunde einzuziehen.', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(153, 2, 'Die Tochter des Rinderteufels', 97, 0, '[img]img/storyimages/story153.png[/img]\r\n\r\nIm Viertelfinale, tritt !player gegen eine junge Frau an, welche sich als Chichi, die Tochter des Rinderteufels, vorstellt. Sie bedankt sich bei !player, für die damalige Hilfe beim Bekämpfen des Feuers und macht sich für den Kampf bereit.', 1, 'Papayainsel', 'Erde', 27000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(154, 2, 'Rematch mit Tenshinhan', 98, 0, '[img]img/storyimages/story154.png[/img]\r\n\r\nMit dem Sieg über Chichi, geht es nun weiter für !player ins Halbfinale. Dort wartet Tenshinhan bereits. Beide Kämpfer freuen sich auf ihr Rematch und nehmen ihre Kampfposition ein.', 1, 'Papayainsel', 'Erde', 28000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(155, 2, 'Das Finale gegen Piccolo', 99, 0, '[img]img/storyimages/story155.png[/img]\r\n\r\nTenshinhan besiegt, geht es nun weiter ins Finale. Piccolo, der es ebenfalls ins Finale geschafft hat, freut sich auf die Chance, !player im Kampf zu schlagen und sich endlich rächen zu können.', 1, 'Papayainsel', 'Erde', 28500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(156, 1, 'Der Sieger des Turniers!', 5, 0, '[img]img/storyimages/story156.png[/img]\r\n\r\nNach einem langen und erbitterten Kampf, schafft es !player Piccolo zu besiegen und ist somit der Sieger und neuer Champion des Turniers! Statt jedoch Piccolo zu töten, lässt !player diesen am Leben, da dieser nicht vollkommen böse zu seien scheint. Verwirrt von dieser Aktion verlässt Piccolo die Gruppe, aber schwört vorher, !player eines Tages zu besiegen.', 0, 'Papayainsel', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 1),
(157, 1, 'Ende der Saga!', 5, 0, '[img]img/storyimages/story157.png[/img]\r\n\r\nAls frischgebackener Champion beschließt !player, erst einmal eine Weile um die Welt zu reisen, um mehr Erfahrungen zu sammeln und neue spannende Abenteuer zu erleben.', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(158, 1, 'Der Start der Saga', 5, 0, '[img]img/storyimages/story158.png[/img]\r\n\r\nNach einer lange Reise um die Welt, entschließt sich !player dazu, Meister Roshi besuchen zu gehen. Dort angekommen trifft !player nicht nur auf den alten Meister, sondern auch auf Krillin und Yamchu, welche hier trainiert haben. ', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(159, 2, 'Trainingskampf gegen Yamchu', 100, 0, '[img]img/storyimages/story159.png[/img]\r\n\r\nUm zu sehen, wie stark !player geworden ist, entschließt Meister Roshi !player gegen Yamchu und Krillin antreten zu lassen. Den Anfang macht hierbei Yamchu!', 1, 'Kame Haus', 'Erde', 29000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(160, 2, 'Trainingskampf gegen Krillin', 101, 0, '[img]img/storyimages/story160.png[/img]\r\n\r\nNach dem Sieg über Yamchu, muss !player sich nun Krillin stellen. Dieser hat hart trainiert und freut sich im Kampf, die Früchte seiner Arbeit zeigen zu können!', 1, 'Kame Haus', 'Erde', 30000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(161, 1, 'Ankunft des Fremden', 5, 0, '[img]img/storyimages/story161.png[/img]\r\n\r\nZufrieden mit den Kämpfen und seinen Schülern, beschließt Meister Roshi ein Fest zu veranstalten, um die Ankunft von !player gebührend zu feiern. Doch bevor die Planung dafür beginnen kann, landet ein mysteriöser Mann auf der Insel. ', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(162, 1, 'Ein Saiyajin?!', 5, 0, '[img]img/storyimages/story162.png[/img]\r\n\r\nDieser stellt sich als Radditz vor, ein Saiyajin und Soldat der Freezer Armee, welche die nördlichen Galaxien tyrannisiert. Er ist auf der Erde um die Bevölkerung auszulöschen und den Planeten an den Meistbietenden zu verkaufen. ', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(163, 2, 'Kampf gegen Radditz', 103, 0, '[img]img/storyimages/story163.png[/img]\r\n\r\nDoch zuvor muss er die stärksten Kämpfer auf dem Planeten beseitigen. Um seine Freunde und den Planeten zu beschützen, stellt sich !player Radditz zum Kampf! ', 0, 'Kame Haus', 'Erde', 35000, '', 0, 0, 0, 0, 50, 1, 0, 100, 100, 0),
(164, 1, 'Das Angebot', 5, 0, '[img]img/storyimages/story164.png[/img]\r\n\r\nRadditz dominiert den Kampf und schafft es mühelos !player zu schlagen. Doch die Stärke von !player möchte er nicht verschwenden, weshalb er !player anbietet, für ihn zu kämpfen. Er gibt !player Bedenkzeit und die Koordinaten ihres Treffpunktes, bevor er verschwindet.', 0, 'Kame Haus', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(165, 1, 'Zwei Rivalen', 5, 0, '[img]img/storyimages/story165.png[/img]\r\n\r\n!player denkt keine Sekunde daran, das Angebot anzunehmen, aber alleine sind die Chancen auf einen Sieg minimal. In seiner Verzweiflung, taucht plötzlich Piccolo auf, welcher den Kampf beobachtet hat und eine Allianz vorschlägt, um den Besucher aus dem All zu vernichten. Mit keiner Alternativen, stimmt !player der Allianz zu und macht sich auf den Weg zum Treffpunkt. ', 0, 'Wildnis', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(166, 2, 'Ein tödlicher Kampf', 103, 102, '[img]img/storyimages/story166.png[/img]\r\n\r\nBei Radditz angekommen, lehnt !player sein Angebot für ihn zu Kämpfen ab, was dieser bedauert. Er macht !player klar, dass er sich nun nicht mehr zurückhalten muss und dass dieser, trotz Unterstützung, diesen Kampf nicht überleben wird!', 1, 'Wildnis', 'Erde', 35000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(167, 3, 'Tod eines Helden', 5, 0, '[img]img/storyimages/story167.png[/img]\r\n\r\nTrotz Unterstützung unterliegt !player im Kampf und sieht als einzige Möglichkeit, sich selbst für den Sieg zu opfern. Piccolo zögert nicht lange und schafft es beide mit einer mächtigen Technik zu töten. Zufrieden mit dem Ergebnis, schließt !player erschöpft die Augen.', 0, 'Wildnis', 'Erde', 0, '', 0, 0, 0, 63, 0, 0, 0, 100, 100, 0),
(168, 1, 'Ankunft im Jenseits', 5, 0, '[img]img/storyimages/story168.png[/img]\r\n\r\nAls !player diese wieder öffnet, findet er sich vollkommen unverletzt an einem merkwürdigen Ort wieder. Bevor !player diesen erkunden kann, wird er von Gott aufgehalten, welcher ihm erklärt, dass dies das Jenseits sei.', 0, 'Check-In Station', 'Jenseits', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(169, 1, 'Die drohende Gefahr', 5, 0, '[img]img/storyimages/story169.png[/img]\r\n\r\nEr erzählt außerdem, dass die Gefahr mit Radditz Tod noch nicht vorüber sei, denn zwei weitere Saiyajins seien bereits auf den Weg zur Erde, welche um ein Vielfaches stärker sein sollen als Radditz. Um !player darauf vorzubereiten, möchte Gott diesen zu Meister Kaio schicken. ', 0, 'Check-In Station', 'Jenseits', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(170, 2, 'Der Richter des Jenseits', 104, 0, '[img]img/storyimages/story170.png[/img]\r\n\r\nDoch zuvor müsse man die Erlaubnis von Enma Daio einholen, dem Richter des Jenseits. Dieser habe ebenfalls unter Meister Kaio trainiert und lässt nur diese zu ihm, welche sich im Kampf als würdig erwiesen haben. ', 1, 'Check-In Station', 'Jenseits', 35000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(171, 3, 'Der Schlangenpfad', 5, 0, '[img]img/storyimages/story171.png[/img]\r\n\r\nBeeindruckt von der Stärke von !player, lässt Enma Daio diesen den zweiten Test bestreiten: den Schlangenpfad! Dieser ist Millionen von Kilometern lang, aber auch die einzige Verbindung zu Meister Kaios Planeten.', 0, 'Check-In Station', 'Jenseits', 0, '', 0, 0, 0, 62, 0, 0, 0, 100, 100, 0),
(172, 1, 'Meister Kaios Planet', 5, 0, '[img]img/storyimages/story172.png[/img]\r\n\r\nAm Ende des Pfades angekommen, kann !player den kleinen Planeten von Meister Kaio sehen. Dort angekommen wartet bereits Meister Kaio, welcher !player zunächst erklärt, dass auf seinem Planeten eine 10-fach höhere Gravitation, als auf der Erde, herrscht.', 0, 'Meister Kaios Planet', 'Jenseits', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(173, 2, 'Der erste Test', 105, 0, '[img]img/storyimages/story173.png[/img]\r\n\r\nEr ist einverstanden !player zu trainieren, aber erst wenn dieser zwei Test besteht. Der erste Test besteht darin, seinen Affen, Bananas, zu fangen!', 1, 'Meister Kaios Planet', 'Jenseits', 36000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(174, 2, 'Der zweite Test', 106, 0, '[img]img/storyimages/story174.png[/img]\r\n\r\nBananas gefangen geht es nun weiter mit dem zweiten Test. Dieser besteht darin Gregory, den zweiten Begleiter von Meister Kaio, mit einem massiven Hammer zu treffen!', 1, 'Meister Kaios Planet', 'Jenseits', 37000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(175, 1, 'Die Kaioken', 5, 0, '[img]img/storyimages/story175.png[/img]\r\n\r\nDurch das bestehen beider Tests, hat sich !player damit qualifiziert, die geheime Technik von Meister Kaio, die Kaioken, zu lernen. Doch noch während !player sich die Technik aneignet, wird dieser von Uranai Baba kontaktiert, welche !player mit den Dragonballs wiederbeleben möchte, da die beiden Saiyajins bereits auf der Erde angekommen sind.', 0, 'Meister Kaios Planet', 'Jenseits', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(176, 3, 'Der Abschied', 5, 0, '[img]img/storyimages/story176.png[/img]\r\n\r\nMit keiner anderen Wahl, unterbricht !player das Training, bedankt sich bei Meister Kaio und macht sich auf den Weg zurück zu Enma Daio, wo Gott bereits auf diesen wartet.', 0, 'Meister Kaios Planet', 'Jenseits', 0, '', 0, 0, 0, 64, 0, 0, 0, 100, 100, 0),
(177, 1, 'Wieder am Leben', 5, 0, '[img]img/storyimages/story177.png[/img]\r\n\r\nWieder am Leben, befindet sich !player im Gottespalast und wird von Gott unterrichtet, was in der Zwischenzeit alles geschehen ist und dass die Anderen bereits gegen die Saiyajins kämpfen.', 0, 'Gottespalast', 'Erde', 0, '102@10', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(178, 1, 'Auf zum Schlachtfeld', 5, 0, '[img]img/storyimages/story178.png[/img]\r\n\r\nDiese befinden sich momentan in der Paprika-Ödnis und haben bereits eine Großstadt zerstört. Damit nichts weiteres passieren kann, macht sich !player sofort auf den Weg, aber nicht ohne zuvor noch einige Senzus von Meister Korin abzuholen.', 0, 'Paprika-Ödnis', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(179, 2, 'Die Konfrontation', 107, 0, '[img]img/storyimages/story179.png[/img]\r\n\r\nDort angekommen muss !player leider feststellen, dass alle außer Krillin im Kampf gestorben sind, einschließlich Tenshinhan und Piccolo. Voller Zorn geht !player direkt auf die beiden Saiyajins los, aber diese bekämpfen keinen Krieger, welcher nicht zuerst einen ihrer Pflanzenmänner besiegt hat.', 1, 'Paprika-Ödnis', 'Erde', 37500, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(180, 2, 'Der brutale Nappa', 108, 0, '[img]img/storyimages/story180.png[/img]\r\n\r\nDen Pflanzenmann schnell beseitigt, macht sich !player für den richtigen Kampf bereit. Beeindruckt von dessen Stärke, stellt sich sich der größere Saiyajin als Nappa vor und verspricht es zu versuchen, !player nicht lange leiden zu lassen.', 1, 'Paprika-Ödnis', 'Erde', 38000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(181, 1, 'Nappas Tod', 5, 0, '[img]img/storyimages/story181.png[/img]\r\n\r\nNappa geschlagen, liegt dieser fassungslos und kampfunfähig auf den Boden. Doch bevor !player ihm den Gnadenstoß verleihen kann, wird dieser von seinem eigenen Partner getötet. Vegeta, der verbleibende Saiyajin, möchte nun selbst gegen !player antreten, aber nicht ohne zuvor zu einem passenderen Schlachtfeld zu wechseln.', 0, 'Gizard-Ödnis', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(182, 2, 'Der Prinz der Saiyajins', 109, 0, '[img]img/storyimages/story182.png[/img]\r\n\r\nIn der bergigen Ödnis angekommen, erzählt Vegeta !player von seiner Vergangenheit und seiner Abstammung und dass dieser keinerlei Chance gegen ihn hat. !player, welcher immer noch wütend über die Tode seiner Freunde ist, ignoriert diesen und stürmt auf ihn zu!', 1, 'Gizard-Ödnis', 'Erde', 39000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(183, 1, 'Das Potential der Saiyajins', 5, 0, '[img]img/storyimages/story183.png[/img]\r\n\r\nZu Vegetas Überraschung geht der Kampf ausgeglichen aus, was den Prinzen beschämt und seinen Stolz kränkt. Um dem Gesindel zu zeigen, welcher Unterschied zwische ihnen herrscht, beschließt Vegeta das volle Potential der Saiyajins zu entfesseln und verwandelt sich in einen riesigen Wehraffen.', 0, 'Gizard-Ödnis', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 1),
(184, 2, 'Kampf der Titanen', 110, 0, '[img]img/storyimages/story184.png[/img]\r\n\r\nZunächst scheint es so, als ob der Plan des Prinzen auf geht, denn !player ist nun klar unterlegen. Jedoch schafft es !player, sich an das Training mit Meister Kaio zu erinnern und ist nun in der Lage, die Kaioken zu meistern!', 1, 'Gizard-Ödnis', 'Erde', 40000, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(185, 1, 'Das Ende des Prinzen?', 5, 0, '[img]img/storyimages/story185.png[/img]\r\n\r\nMit Hilfe der Kaioken, hat es !player geschafft Vegeta zu besiegen, welcher mit letzter Kraft zu fliehen versucht. Auch wenn dessen Taten unverzeihlich waren, beschließt !player diesen laufen zu lassen. Vegeta, den diese Gnade noch weiter beschämt, schwört eines Tages zurückzukehren um sich zu rächen, bevor er den Planeten endgültig verlässt.', 0, 'Gizard-Ödnis', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(186, 2, 'Was nun?', 5, 0, '[img]img/storyimages/story186.png[/img]\r\n\r\nDie Erde wurde zwar erneut erfolgreich gerettet, jedoch war der Preis, der gezahlt wurde, sehr hoch. Nicht nur, dass beinahe alle Kämpfer für die Erde im Kampf gestorben sind, so sind auch die Dragonballs mit dem Tod von Piccolo zerstört worden. Um zu entscheiden, wie es nun weitergehen soll, beschließt !player zur Westlichen Hauptstadt zu reisen, um dort mit Bulma und den anderen die nächsten Schritte zu planen.', 0, 'Westliche Hauptstadt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0),
(187, 1, 'ToDo', 5, 0, 'ToDo', 0, 'Westliche Hauptstadt', 'Erde', 0, '', 0, 0, 0, 0, 0, 0, 0, 100, 100, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `titel`
--

CREATE TABLE `titel` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(6) NOT NULL,
  `description` longtext NOT NULL,
  `type` int(3) NOT NULL,
  `typecondition` int(11) NOT NULL,
  `typenpc` int(11) NOT NULL,
  `typefight` int(1) NOT NULL,
  `typeaction` int(11) NOT NULL,
  `typesort` int(2) NOT NULL,
  `typeattack` int(11) NOT NULL,
  `star` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `titel`
--

INSERT INTO `titel` (`id`, `name`, `color`, `description`, `type`, `typecondition`, `typenpc`, `typefight`, `typeaction`, `typesort`, `typeattack`, `star`) VALUES
(1, '[Admin]', '0066ff', 'Der Admin des Spieles.', 0, 0, 0, 0, 0, 0, 0, 'stern3'),
(2, '[Designer]', '04B4AE', 'Der Designer des Spieles.', 0, 0, 0, 0, 0, 0, 0, ''),
(3, '[Moderator]', 'aa22ff', 'Ein Moderator des Spieles.', 0, 0, 0, 0, 0, 0, 0, ''),
(4, '[Artist]', '088A08', 'Der Artist des Spieles.', 0, 0, 0, 0, 0, 0, 0, ''),
(5, '[Test]', 'FF0000', 'Ein Testaccount um das Spiel zu testen.', 0, 0, 0, 0, 0, 0, 0, ''),
(6, 'Tiger-Jäger', 'DBA901', 'Der Spieler hat einige Tiger getötet.', 1, 100, 1, -1, 0, 0, 0, 'stern'),
(7, 'Schwächling', 'DBA901', 'Der Spieler ist selbst gegen einen Tiger zu schwach.', 1, 100, 1, -1, 0, 1, 0, 'stern'),
(8, 'Schlafmütze', 'DBA901', 'Der Spieler schläft sehr gerne.', 3, 100, 0, -1, 38, 0, 0, 'stern'),
(9, 'Sieger', 'DBA901', 'Der Spieler hat an einen Tag die meisten Siege erhalten.', 5, 1, 0, -1, 0, 4, 0, 'stern'),
(10, 'Neandertaler', 'DBA901', 'Der Spieler hat sehr viele Rüstungen des Tigers erlangt.', 1, 100, 1, 5, 0, 0, 0, 'stern'),
(11, 'Gestärkter', 'DBA901', 'Der Spieler hat einen Wunsch geäußert, wodurch er stärker geworden ist.', 4, 2, 0, -1, 0, 0, 0, 'stern'),
(12, '[BoT]', 'dbbb2a', 'Ein Bot von einer Webseite wie Google', 0, 0, 0, 0, 0, 0, 0, ''),
(13, 'Sparringpartner', 'DBA901', 'Der Spieler hat oft Sparring mit einen anderen Spieler gemacht.', 3, 200, 0, -1, 31, 0, 0, 'stern'),
(14, 'Reisender', 'DBA901', 'Der Spieler ist schon weit gereist.', 3, 100, 0, -1, 12, 0, 0, 'stern'),
(15, 'Tiger-Schlächter', 'DBA901', 'Der Spieler hat eine Menge Tiger getötet.', 1, 1000, 1, -1, 0, 0, 0, 'stern'),
(16, 'Tiger-Massaker', 'DBA901', 'Der Spieler hat unzählige Tiger getötet.', 1, 10000, 1, -1, 0, 0, 0, 'stern'),
(17, 'Tiger-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Tiger. ', 1, 100000, 1, -1, 0, 0, 0, 'stern'),
(18, 'Tiger', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Tiger verbracht, dass er sich selbst nun für einen Tiger hält. ', 1, 1000000, 1, -1, 0, 0, 0, 'stern2'),
(19, 'Pterodactyl-Jäger', 'DBA901', 'Der Spieler hat einige Pterodactyl getötet.', 1, 100, 2, -1, 0, 0, 0, 'stern'),
(20, 'Pterodactyl-Schlächter', 'DBA901', 'Der Spieler hat eine Menge Pterodactyl getötet.', 1, 1000, 2, -1, 0, 0, 0, 'stern'),
(21, 'Pterodactyl-Massaker', 'DBA901', 'Der Spieler hat unzählige Pterodactyl getötet.', 1, 10000, 2, -1, 0, 0, 0, 'stern'),
(22, 'Pterodactyl-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Pterodactyl. ', 1, 100000, 2, -1, 0, 0, 0, 'stern'),
(23, 'Pterodactyl', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Pterodactyl verbracht, dass er sich selbst nun für einen Pterodactyl hält.  ', 1, 1000000, 2, -1, 0, 0, 0, 'stern2'),
(24, 'Bärendieb-Jäger', 'DBA901', 'Der Spieler hat einige Male den Bärendieb getötet.', 1, 100, 3, -1, 0, 0, 0, 'stern'),
(25, 'Bärendieb-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren den Bärendieb getötet.', 1, 1000, 3, -1, 0, 0, 0, 'stern'),
(26, 'Bärendieb-Massaker', 'DBA901', 'Der Spieler hat unzählige Male den Bärendieb getötet.', 1, 10000, 3, -1, 0, 0, 0, 'stern'),
(27, 'Bärendieb-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Bärendieb. ', 1, 100000, 3, -1, 0, 0, 0, 'stern'),
(28, 'Bärendieb', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Bärendieb verbracht, dass er sich selbst nun für einen Bärendieb hält. ', 1, 1000000, 3, -1, 0, 0, 0, 'stern2'),
(29, 'Heldenhaft', 'DBA901', 'Der Spieler hat sich einer Übermacht mutig in den Weg gestellt. ', 1, 1, 5, -1, 0, 1, 0, 'stern'),
(30, 'Wahnsinnig', 'DBA901', 'Die Definition von Wahnsinn ist, immer wieder das Gleiche zu tun und andere Ergebnisse zu erwarten.', 1, 10, 5, -1, 0, 1, 0, 'stern'),
(31, 'Masochist ', 'FF0000', 'Der Spieler genießt es, aussichtslose Kämpfe zu bestreiten. ', 1, 100, 5, -1, 0, 1, 0, 'stern2'),
(32, 'Dorfbewohner-Jäger', 'DBA901', 'Der Spieler hat einige Male den Dorfbewohner besiegt.', 1, 100, 48, -1, 0, 0, 0, 'stern'),
(33, 'Verlierer', 'DBA901', 'Der Spieler hat an einen Tag die meisten Niederlagen erhalten.', 5, 1, 0, -1, 0, 5, 0, 'stern'),
(34, 'Mörder', 'DBA901', 'Der Spieler hat an einen Tag die meisten Siege in Todeskämpfen erhalten.', 5, 1, 0, 2, 0, 4, 0, 'stern'),
(35, 'Dorfbewohner-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren den Dorfbewohner besiegt.', 1, 1000, 48, -1, 0, 0, 0, 'stern'),
(36, 'Dorfbewohner-Massaker', 'DBA901', 'Der Spieler hat unzählige Male den Dorfbewohner besiegt.', 1, 10000, 48, -1, 0, 0, 0, 'stern'),
(37, 'Dorfbewohner-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Dorfbewohner. ', 1, 100000, 48, -1, 0, 0, 0, 'stern'),
(38, 'Dorfbewohner', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Dorfbewohner verbracht, dass er sich selbst nun für einen Dorfbewohner hält. ', 1, 1000000, 48, -1, 0, 0, 0, 'stern2'),
(39, 'Oger-Jäger', 'DBA901', 'Der Spieler hat einige Male den Oger besiegt.', 1, 100, 12, -1, 0, 0, 0, 'stern'),
(40, 'Oger-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren den Oger besiegt.', 1, 1000, 12, -1, 0, 0, 0, 'stern'),
(41, 'Oger-Massaker', 'DBA901', 'Der Spieler hat unzählige Male den Oger besiegt.', 1, 10000, 12, -1, 0, 0, 0, 'stern'),
(42, 'Oger-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Oger. ', 1, 100000, 12, -1, 0, 0, 0, 'stern'),
(43, 'Oger', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Oger verbracht, dass er sich selbst nun für einen Oger hält.', 1, 1000000, 12, -1, 0, 0, 0, 'stern2'),
(44, 'Stier-Jäger', 'DBA901', 'Der Spieler hat einige Male den Stier besiegt.', 1, 100, 13, -1, 0, 0, 0, 'stern'),
(45, 'Stier-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren den Stier besiegt.', 1, 1000, 13, -1, 0, 0, 0, 'stern'),
(46, 'Stier-Massaker', 'DBA901', 'Der Spieler hat unzählige Male den Stier besiegt.', 1, 10000, 13, -1, 0, 0, 0, 'stern'),
(47, 'Stier-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Stier. ', 1, 100000, 13, -1, 0, 0, 0, 'stern'),
(48, 'Stier', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Stier verbracht, dass er sich selbst nun für einen Stier hält.', 1, 1000000, 13, -1, 0, 0, 0, 'stern2'),
(49, 'Katzen-Jäger', 'DBA901', 'Der Spieler hat einige Male Pool besiegt.', 1, 100, 9, -1, 0, 0, 0, 'stern'),
(50, 'Katzen-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Pool besiegt.', 1, 1000, 9, -1, 0, 0, 0, 'stern'),
(51, 'Katzen-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Pool besiegt.', 1, 10000, 9, -1, 0, 0, 0, 'stern'),
(52, 'Katzen-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Pool. ', 1, 100000, 9, -1, 0, 0, 0, 'stern'),
(53, 'Katze', 'FF0000', 'Der Spieler hat so viel Zeit mit Pool verbracht, dass er sich selbst nun für eine Katze hält. ', 1, 1000000, 9, -1, 0, 0, 0, 'stern2'),
(54, 'Wüstenbandit-Jäger', 'DBA901', 'Der Spieler hat einige Male den Wüstenbandit-Yamchu besiegt.', 1, 100, 8, -1, 0, 0, 0, 'stern'),
(55, 'Wüstenbandit-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren den Wüstenbandit-Yamchu besiegt.', 1, 1000, 8, -1, 0, 0, 0, 'stern'),
(56, 'Wüstenbandit-Massaker', 'DBA901', 'Der Spieler hat unzählige Male den Wüstenbandit-Yamchu besiegt.', 1, 10000, 8, -1, 0, 0, 0, 'stern'),
(57, 'Wüstenbandit-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Wüstenbandit-Yamchu. ', 1, 100000, 8, -1, 0, 0, 0, 'stern'),
(58, 'Wüstenbandit', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Wüstenbandit-Yamchu verbracht, dass er sich selbst nun für einen Wüstenbanditen hält', 1, 1000000, 8, -1, 0, 0, 0, 'stern2'),
(59, 'Häschen-Jäger', 'DBA901', 'Der Spieler hat einige Male das Karottenmonster besiegt.', 1, 100, 50, -1, 0, 0, 0, 'stern'),
(60, 'Häschen-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren das Karottenmonster besiegt.', 1, 1000, 50, -1, 0, 0, 0, 'stern'),
(61, 'Häschen-Massaker', 'DBA901', 'Der Spieler hat unzählige Male das Karottenmonster besiegt.', 1, 10000, 50, -1, 0, 0, 0, 'stern'),
(62, 'Häschen', 'FF0000', 'Der Spieler hat so viel Zeit mit dem Karottenmonster verbracht, dass er sich selbst nun für ein Häschen hält.', 1, 1000000, 50, -1, 0, 0, 0, 'stern2'),
(63, 'Hunde-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Shu. ', 1, 100000, 19, -1, 0, 0, 0, 'stern'),
(64, 'Hunde-Jäger', 'DBA901', 'Der Spieler hat einige Male Shu besiegt.', 1, 100, 19, -1, 0, 0, 0, 'stern'),
(65, 'Hunde-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Shu besiegt.', 1, 1000, 19, -1, 0, 0, 0, 'stern'),
(66, 'Hunde-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Shu besiegt.', 1, 10000, 19, -1, 0, 0, 0, 'stern'),
(67, 'Hund', 'FF0000', 'Der Spieler hat so viel Zeit mit Shu verbracht, dass er sich selbst nun für einen Hund hält.', 1, 1000000, 19, -1, 0, 0, 0, 'stern2'),
(68, 'Prinzen-Jäger', 'DBA901', 'Der Spieler hat einige Male Pilaf besiegt.', 1, 100, 17, -1, 0, 0, 0, 'stern'),
(69, 'Prinzen-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Pilaf besiegt.', 1, 1000, 17, -1, 0, 0, 0, 'stern'),
(70, 'Prinzen-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Pilaf besiegt.', 1, 10000, 17, -1, 0, 0, 0, 'stern'),
(71, 'Prinzen-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Pilaf. ', 1, 100000, 17, -1, 0, 0, 0, 'stern'),
(72, 'Prinz', 'FF0000', 'Der Spieler hat so viel Zeit mit Prinz Pilaf verbracht, dass er sich selbst nun für einen Prinzen hält.', 1, 1000000, 17, -1, 0, 0, 0, 'stern2'),
(73, 'Handlanger-Jäger', 'DBA901', 'Der Spieler hat einige Male Mai besiegt.', 1, 100, 18, -1, 0, 0, 0, 'stern'),
(74, 'Handlanger-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Mai besiegt.', 1, 1000, 18, -1, 0, 0, 0, 'stern'),
(75, 'Handlanger-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Mai besiegt.', 1, 10000, 18, -1, 0, 0, 0, 'stern'),
(76, 'Handlanger-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Mai. ', 1, 100000, 18, -1, 0, 0, 0, 'stern'),
(77, 'Handlanger', 'FF0000', 'Der Spieler hat so viel Zeit mit Mai verbracht, dass er sich selbst nun für einen Handlanger hält.', 1, 1000000, 18, -1, 0, 0, 0, 'stern2'),
(78, 'Diebin-Jäger', 'DBA901', 'Der Spieler hat einige Male Lunch besiegt.', 1, 100, 28, -1, 0, 0, 0, 'stern'),
(79, 'Diebin-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Lunch besiegt.', 1, 1000, 28, -1, 0, 0, 0, 'stern'),
(80, 'Diebin-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Lunch besiegt.', 1, 10000, 28, -1, 0, 0, 0, 'stern'),
(81, 'Diebin-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Lunch. ', 1, 50000, 28, -1, 0, 0, 0, 'stern'),
(82, 'Diebin', 'FF0000', 'Der Spieler hat so viel Zeit mit Lunch verbracht, dass er sich selbst nun für eine Diebin hält.', 1, 100000, 28, -1, 0, 0, 0, 'stern2'),
(83, 'Glatzen-Jäger', 'DBA901', 'Der Spieler hat einige Male Kid Krillin besiegt.', 1, 100, 10, -1, 0, 0, 0, 'stern'),
(84, 'Glatzen-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Kid Krillin besiegt.', 1, 1000, 10, -1, 0, 0, 0, 'stern'),
(85, 'Glatzen-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Kid Krillin besiegt.', 1, 10000, 10, -1, 0, 0, 0, 'stern'),
(86, 'Glatzen-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Kid Krillin. ', 1, 50000, 10, -1, 0, 0, 0, 'stern'),
(87, 'Glatze', 'FF0000', 'Der Spieler hat so viel Zeit mit Kid Krillin verbracht, dass er sich selbst nun mit Glatze sieht. ', 1, 100000, 10, -1, 0, 0, 0, 'stern2'),
(88, 'Gestank-Jäger', 'DBA901', 'Der Spieler hat einige Male Bakterian besiegt.', 1, 100, 54, -1, 0, 0, 0, 'stern'),
(89, 'Gestank-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Bakterian besiegt.', 1, 1000, 54, -1, 0, 0, 0, 'stern'),
(90, 'Gestank-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Bakterian besiegt.', 1, 10000, 54, -1, 0, 0, 0, 'stern'),
(91, 'Gestank-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Bakterian. ', 1, 50000, 54, -1, 0, 0, 0, 'stern'),
(92, 'Gestank', 'FF0000', 'Der Spieler hat so viel Zeit mit Bakterian verbracht, dass er sich selbst nun als stinkend empfindet.', 1, 100000, 54, -1, 0, 0, 0, 'stern2'),
(93, 'Nr.69-Jäger', 'DBA901', 'Der Spieler hat einige Male die Startnummer 69 besiegt.', 1, 100, 55, -1, 0, 0, 0, 'stern'),
(94, 'Nr.69-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren die Startnummer 69 besiegt.', 1, 1000, 55, -1, 0, 0, 0, 'stern'),
(95, 'Nr.69-Massaker', 'DBA901', 'Der Spieler hat unzählige Male die Startnummer 69 besiegt.', 1, 10000, 55, -1, 0, 0, 0, 'stern'),
(96, 'Nr.69-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von der Startnummer 69. ', 1, 50000, 55, -1, 0, 0, 0, 'stern'),
(97, 'Nr.69', 'FF0000', 'Der Spieler hat so viel Zeit mit der Startnummer 69 verbracht, dass er sich selbst nun für die Startnummer 69 hält.', 1, 100000, 55, -1, 0, 0, 0, 'stern2'),
(98, 'Beast-Jäger', 'DBA901', 'Der Spieler hat einige Male Gilian besiegt.', 1, 100, 56, -1, 0, 0, 0, 'stern'),
(99, 'Beast-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Gilian besiegt.', 1, 1000, 56, -1, 0, 0, 0, 'stern'),
(100, 'Beast-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Gilian besiegt.', 1, 10000, 56, -1, 0, 0, 0, 'stern'),
(101, 'Beast-Nemesis', '', 'Der Spieler ist der Erzfeind von Gilian. ', 1, 50000, 56, -1, 0, 0, 0, 'stern'),
(102, 'Beast', 'FF0000', 'Der Spieler hat so viel Zeit mit Gilian verbracht, dass er sich selbst nun für ein Beast hält.', 1, 100000, 56, -1, 0, 0, 0, 'stern2'),
(103, 'Mönch-Jäger', 'DBA901', 'Der Spieler hat einige Male Nam besiegt.', 1, 100, 57, -1, 0, 0, 0, 'stern'),
(104, 'Mönch-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Nam besiegt.', 1, 1000, 57, -1, 0, 0, 0, 'stern'),
(105, 'Mönch-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Nam besiegt.', 1, 10000, 57, -1, 0, 0, 0, 'stern'),
(106, 'Mönch-Nemesis', '', 'Der Spieler ist der Erzfeind von Nam. ', 1, 50000, 57, -1, 0, 0, 0, 'stern'),
(107, 'Mönch', 'FF0000', 'Der Spieler hat so viel Zeit mit Nam verbracht, dass er sich selbst nun für einen Mönchen hält. ', 1, 100000, 57, -1, 0, 0, 0, 'stern2'),
(108, 'Meister-Jäger', 'DBA901', 'Der Spieler hat einige Male Jackie Chun besiegt.', 1, 100, 58, -1, 0, 0, 0, 'stern'),
(109, 'Meister-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Jackie Chun besiegt.', 1, 1000, 58, -1, 0, 0, 0, 'stern'),
(110, 'Meister-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Jackie Chun besiegt.', 1, 10000, 58, -1, 0, 0, 0, 'stern'),
(111, 'Meister-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Jackie Chun. ', 1, 50000, 58, -1, 0, 0, 0, 'stern'),
(112, 'Meister', 'FF0000', 'Der Spieler hat so viel Zeit mit Jackie Chun verbracht, dass er sich selbst nun für einen Meister hält. ', 1, 100000, 58, -1, 0, 0, 0, 'stern2'),
(113, 'King-Jäger', 'DBA901', 'Der Spieler hat einige Male King Chapa besiegt.', 1, 100, 82, -1, 0, 0, 0, 'stern'),
(114, 'King-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren King Chapa besiegt.', 1, 1000, 82, -1, 0, 0, 0, 'stern'),
(115, 'King-Massaker', 'DBA901', 'Der Spieler hat unzählige Male King Chapa besiegt.', 1, 10000, 82, -1, 0, 0, 0, 'stern'),
(116, 'King-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von King Chapa. ', 1, 50000, 82, -1, 0, 0, 0, 'stern'),
(117, 'King', 'FF0000', 'Der Spieler hat so viel Zeit mit King Chapa verbracht, dass er sich selbst nun für einen King hält. ', 1, 100000, 82, -1, 0, 0, 0, 'stern2'),
(118, 'Häschen-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind vom Karottenmonster. ', 1, 100000, 50, -1, 0, 0, 0, 'stern'),
(119, 'Filmstar-Jäger', 'DBA901', 'Der Spieler hat einige Male Pamput besiegt.', 1, 100, 83, -1, 0, 0, 0, 'stern'),
(120, 'Filmstar-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Pamput besiegt.', 1, 1000, 83, -1, 0, 0, 0, 'stern'),
(121, 'Filmstar-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Pamput besiegt.', 1, 10000, 83, -1, 0, 0, 0, 'stern'),
(122, 'Filmstar-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Pamput. ', 1, 50000, 83, -1, 0, 0, 0, 'stern'),
(123, 'Filmstar', 'FF0000', 'Der Spieler hat so viel Zeit mit Pamput verbracht, dass er sich selbst nun für einen Filmstar hält. ', 1, 100000, 83, -1, 0, 0, 0, 'stern2'),
(124, 'Blechbüchse', 'DBA901', 'Der Spieler hat 50 mal den Chip aufgewertet. ', 3, 50, 0, -1, 41, 0, 0, 'stern'),
(125, 'Gladiator', 'DBA901', 'Der Spieler hat 100 Siege in der Arena erlangt. ', 6, 100, 0, 8, 0, 0, 0, 'stern'),
(126, 'Lehrling', 'DBA901', 'Der Spieler hat 100 Niederlagen in der Arena erlangt. ', 6, 100, 0, 8, 0, 1, 0, 'stern'),
(127, 'Schlagzeug-Jäger', 'DBA901', 'Der Spieler hat einige Male Trommel besiegt.', 1, 100, 92, -1, 0, 0, 0, 'stern'),
(128, 'Schlagzeug-Schlächter', 'DBA901', 'Der Spieler hat des Öfteren Trommel besiegt.', 1, 1000, 92, -1, 0, 0, 0, 'stern'),
(129, 'Schlagzeug-Massaker', 'DBA901', 'Der Spieler hat unzählige Male Trommel besiegt.', 1, 10000, 92, -1, 0, 0, 0, 'stern'),
(130, 'Schlagzeug-Nemesis', 'DBA901', 'Der Spieler ist der Erzfeind von Trommel. ', 1, 50000, 92, -1, 0, 0, 0, 'stern'),
(131, 'Schlagzeuger', 'FF0000', 'Der Spieler hat so viel Zeit mit Trommel verbracht, dass er sich selbst nun für einen Schlagzeuger hält. ', 1, 100000, 92, -1, 0, 0, 0, 'stern2'),
(132, 'Schläger', 'DBA901', 'Der Spieler nutzt 1000x seine Fäuste.', 7, 1000, 0, -1, 0, 0, 1, 'stern'),
(133, 'Tyrann', 'DBA901', 'Der Spieler hat 30x erfolgreich den Dungeon \"Der alte Tyrann\" abgeschlossen.', 1, 30, 90, 5, 0, 0, 0, 'stern'),
(134, 'Verteidiger', 'DBA901', 'Der Spieler nutzt 1000x Verteidigen', 7, 1000, 0, -1, 0, 0, 2, 'stern'),
(135, 'Akku', 'DBA901', 'Der Spieler nutzt 1000x KP Aufladen', 7, 1000, 0, -1, 0, 0, 307, 'stern'),
(136, 'Magnet', 'DBA901', 'Der Spieler nutzt 1000x Alle Verteidigen', 7, 1000, 0, -1, 0, 0, 20, 'stern'),
(137, 'Drainer', 'DBA901', 'Der Spieler nutzt 1000x Weak Drain', 7, 1000, 0, -1, 0, 0, 12, 'stern'),
(138, 'Schwätzer', 'DBA901', 'Der Spieler nutzt 333x Weak Curse', 7, 333, 0, -1, 0, 0, 21, 'stern'),
(139, 'Lähmer', 'DBA901', 'Der Spieler nutzt 333x Paralysieren', 7, 333, 0, -1, 0, 0, 9, 'stern'),
(140, 'Blender', 'DBA901', 'Der Spieler nutzt 250x Solar Flare', 7, 250, 0, -1, 0, 0, 271, 'stern'),
(141, 'Notarzt', 'DBA901', 'Der Spieler nutzt 1000x Weak Heal', 7, 1000, 0, -1, 0, 0, 5, 'stern'),
(142, 'Spender', 'DBA901', 'Der Spieler nutzt 333x Weak Transfer', 7, 333, 0, -1, 0, 0, 264, 'stern'),
(143, 'Spiegel', 'DBA901', 'Der Spieler nutzt 1000x Ki Reflect', 7, 1000, 0, -1, 0, 0, 250, 'stern'),
(144, 'Mauer', 'DBA901', 'Der Spieler nutzt 500x Ki Barriere', 7, 500, 0, -1, 0, 0, 255, 'stern'),
(145, 'Kicker', 'DBA901', 'Der Spieler nutzt 1000x Tritt', 7, 1000, 0, -1, 0, 0, 286, 'stern'),
(146, 'Wrestler', 'DBA901', 'Der Spieler nutzt 1000x Ellbogen', 7, 1000, 0, -1, 0, 0, 287, 'stern'),
(147, 'Boxer', 'DBA901', 'Der Spieler nutzt 1000x geballte Hand', 7, 1000, 0, -1, 0, 0, 288, 'stern'),
(148, 'Jongleur', 'DBA901', 'Der Spieler nutzt 1000x Ki Ball', 7, 1000, 0, -1, 0, 0, 36, 'stern'),
(149, 'Emitter', 'DBA901', 'Der Spieler nutzt 1000x Energy Wave', 7, 1000, 0, -1, 0, 0, 37, 'stern'),
(151, 'Hilfsbereit', 'DBA901', 'Der Spieler hat dem Tester 1x geholfen', 1, 1, 95, -1, 0, 0, 0, 'stern'),
(152, 'Verstärker', 'DBA901', 'Der Spieler nutzt 333x Unlock Attack', 7, 333, 0, -1, 0, 0, 16, 'stern'),
(153, 'Manipulant', 'DBA901', 'Der Spieler nutzt 333x Manipulation Sorcery', 7, 333, 0, -1, 0, 0, 17, 'stern'),
(154, 'Kraftprotz', 'DBA901', 'Der Spieler nutzt 1000x Muscle Shield', 7, 1000, 0, -1, 0, 0, 19, 'stern'),
(155, 'Todbringer', 'DBA901', 'Der Spieler nutzt 10x Haretsu Majutsu\r\n', 7, 10, 0, -1, 0, 0, 3, 'stern'),
(156, 'Gleichstarker', 'DBA901', 'Der Spieler hat an einen Tag die meisten Unentschieden erhalten.', 5, 1, 0, -1, 0, 6, 0, 'stern'),
(157, 'Held', 'FF0000', 'Der Spieler hat Level 50 erreicht.', 2, 156, 0, 4, 0, 0, 0, 'stern2'),
(158, 'Schläger', 'FF0000', 'Der Spieler nutzt 10000x seine Fäuste.', 7, 10000, 0, -1, 0, 0, 1, 'stern2'),
(159, 'Verteidiger', 'FF0000', 'Der Spieler nutzt 10000x Verteidigen', 7, 10000, 0, -1, 0, 0, 2, 'stern2'),
(160, 'Akku', 'FF0000', 'Der Spieler nutzt 10000x KP Aufladen', 7, 10000, 0, -1, 0, 0, 307, 'stern2'),
(161, 'Magnet', 'FF0000', 'Der Spieler nutzt 10000x Alle Verteidigen', 7, 10000, 0, -1, 0, 0, 20, 'stern2'),
(162, 'Drainer', 'FF0000', 'Der Spieler nutzt 5000x Weak Drain', 7, 5000, 0, -1, 0, 0, 12, 'stern2'),
(163, 'Schwätzer', 'FF0000', 'Der Spieler nutzt 1500x Weak Curse', 7, 1500, 0, -1, 0, 0, 21, 'stern2'),
(164, 'Lähmer', 'FF0000', 'Der Spieler nutzt 1500x Paralysieren', 7, 1500, 0, -1, 0, 0, 9, 'stern2'),
(165, 'Blender', 'FF0000', 'Der Spieler nutzt 1000x Solar Flare', 7, 1000, 0, -1, 0, 0, 271, 'stern2'),
(166, 'Notarzt', 'FF0000', 'Der Spieler nutzt 5000x Weak Heal', 7, 5000, 0, -1, 0, 0, 5, 'stern2'),
(167, 'Spender', 'FF0000', 'Der Spieler nutzt 1500x Weak Transfer', 7, 1500, 0, -1, 0, 0, 264, 'stern2'),
(168, 'Spiegel', 'FF0000', 'Der Spieler nutzt 5000x Ki Reflect', 7, 5000, 0, -1, 0, 0, 250, 'stern2'),
(169, 'Mauer', 'FF0000', 'Der Spieler nutzt 2500x Ki Barriere', 7, 2500, 0, -1, 0, 0, 255, 'stern2'),
(170, 'Kicker', 'FF0000', 'Der Spieler nutzt 7500x Tritt', 7, 7500, 0, -1, 0, 0, 286, 'stern2'),
(171, 'Wrestler', 'FF0000', 'Der Spieler nutzt 7500x Ellbogen', 7, 7500, 0, -1, 0, 0, 287, 'stern2'),
(172, 'Boxer', 'FF0000', 'Der Spieler nutzt 7500x geballte Hand', 7, 7500, 0, -1, 0, 0, 288, 'stern2'),
(173, 'Jongleur', 'FF0000', 'Der Spieler nutzt 7500x Ki Ball', 7, 7500, 0, -1, 0, 0, 36, 'stern2'),
(174, 'Emitter', 'FF0000', 'Der Spieler nutzt 5000x Energy Wave', 7, 5000, 0, -1, 0, 0, 37, 'stern2'),
(175, 'Verstärker', 'FF0000', 'Der Spieler nutzt 1500x Unlock Attack', 7, 1500, 0, -1, 0, 0, 16, 'stern2'),
(176, 'Manipulant', 'FF0000', 'Der Spieler nutzt 1500x Manipulation Sorcery', 7, 1500, 0, -1, 0, 0, 17, 'stern2'),
(177, 'Kraftprotz', 'FF0000', 'Der Spieler nutzt 5000x Muscle Shield', 7, 5000, 0, -1, 0, 0, 19, 'stern2'),
(178, 'Serienmörder', 'FF0000', 'Der Spieler nutzt 100x Haretsu Majutsu\r\n', 7, 100, 0, -1, 0, 0, 3, 'stern2'),
(180, 'Kranich', 'DBA901', 'Der Spieler hat 30x erfolgreich den Dungeon \"Kranichschule\" abgeschlossen.', 1, 30, 86, 5, 0, 0, 0, 'stern'),
(181, 'Rivale', 'DBA901', 'Der Spieler hat 30x erfolgreich den Dungeon \"Ein teuflisches Finale\" abgeschlossen.', 1, 30, 99, 5, 0, 0, 0, 'stern'),
(182, 'Wache', 'DBA901', 'Der Spieler nutzt 500x Ki Guard', 7, 500, 0, -1, 0, 0, 240, 'stern'),
(183, 'Wache', 'FF0000', 'Der Spieler nutzt 2500x Ki Barriere', 7, 2500, 0, -1, 0, 0, 240, 'stern2'),
(184, 'Befreier', 'DBA901', 'Der Spieler nutzt 10x Paralyse Entfernen\r\n', 7, 10, 0, -1, 0, 0, 18, 'stern'),
(185, 'Befreier', 'FF0000', 'Der Spieler nutzt 100x Paralyse Entfernen', 7, 100, 0, -1, 0, 0, 18, 'stern2'),
(186, 'Gott', 'DBA901', 'Der Spieler nutzt 10x Wiederbeleben\r\n', 7, 10, 0, -1, 0, 0, 15, 'stern'),
(187, 'Gott', 'FF0000', 'Der Spieler nutzt 100x Wiederbeleben', 7, 100, 0, -1, 0, 0, 15, 'stern2'),
(188, 'Chirurg', 'DBA901', 'Der Spieler nutzt 1000x Medium Heal', 7, 1000, 0, -1, 0, 0, 326, 'stern'),
(189, 'Chirurg', 'FF0000', 'Der Spieler nutzt 5000x Medium Heal', 7, 5000, 0, -1, 0, 0, 326, 'stern2'),
(190, 'Energiedieb', 'DBA901', 'Der Spieler nutzt 1000x Medium Drain', 7, 1000, 0, -1, 0, 0, 325, 'stern'),
(191, 'Energiedieb', 'FF0000', 'Der Spieler nutzt 5000x Medium Drain', 7, 5000, 0, -1, 0, 0, 325, 'stern2'),
(192, 'Asozial', 'DBA901', 'Der Spieler nutzt 200x Spucken', 7, 200, 0, -1, 0, 0, 273, 'stern'),
(193, 'Asozial', 'FF0000', 'Der Spieler nutzt 800x Spucken', 7, 800, 0, -1, 0, 0, 273, 'stern2'),
(194, 'Blechbüchse', 'FF0000', 'Der Spieler hat 100 mal den Chip aufgewertet. ', 3, 100, 0, -1, 41, 0, 0, 'stern2'),
(195, 'Selbstlos', 'DBA901', 'Der Spieler ist im Kampf gegen Radditz gestorben', 2, 167, 0, -1, 63, 0, 0, 'stern'),
(196, 'Auferstanden', 'DBA901', 'Der Spieler ist aus dem Jenseits zurückgekehrt.', 2, 176, 0, -1, 64, 0, 0, 'stern'),
(197, 'Prinz', 'FF0000', 'Der Spieler hat Level 60 erreicht.', 2, 185, 0, 4, 0, 0, 0, 'stern2'),
(198, 'Fossil', 'DBA901', 'Der Spieler hat einige Male den Dinosaurier besiegt.', 1, 100, 132, -1, 0, 0, 0, 'stern'),
(199, 'Ausgestorben', 'DBA901', 'Der Spieler hat viele Male den Dinosaurier besiegt.', 1, 1000, 132, -1, 0, 0, 0, 'stern'),
(202, 'Unkrautvernichter', 'DBA901', 'Der Spieler hat einige Male den Waldvogel besiegt.', 1, 100, 134, -1, 0, 0, 0, 'stern'),
(203, 'Naturkatastrophe', 'DBA901', 'Der Spieler hat viele Male den Waldvogel besiegt.', 1, 1000, 134, -1, 0, 0, 0, 'stern'),
(204, 'Sturm', 'DBA901', 'Der Spieler hat einige Male den Tornado besiegt.', 1, 100, 133, -1, 0, 0, 0, 'stern'),
(205, 'Wirbelwind', 'DBA901', 'Der Spieler hat viele Male den Tornado besiegt.', 1, 1000, 133, -1, 0, 0, 0, 'stern'),
(206, 'Vogelart-Vernichter', 'FF0000', 'Der Spieler besiegt Waldvogel 10.000 Mal. ', 1, 10000, 134, -1, 0, 0, 0, 'stern2'),
(207, 'Dinosaurierkopf', 'FF0000', 'Der Spieler besiegt Dinosaurier 10.000 Mal. ', 1, 10000, 132, -1, 0, 0, 0, 'stern2'),
(208, 'Hurrikane', 'FF0000', 'Der Spieler bezwingt den Tornado 10.000 Mal. ', 1, 10000, 133, -1, 0, 0, 0, 'stern2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `titelprogress`
--

CREATE TABLE `titelprogress` (
  `id` int(11) NOT NULL,
  `acc` int(11) NOT NULL,
  `titel` int(11) NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tournamentfighter`
--

CREATE TABLE `tournamentfighter` (
  `id` int(11) NOT NULL,
  `fighterid` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `image` varchar(255) NOT NULL,
  `npc` tinyint(1) NOT NULL,
  `tournament` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `image` varchar(90) NOT NULL,
  `name` varchar(90) NOT NULL,
  `brackets` longtext NOT NULL,
  `starttime` datetime NOT NULL,
  `planet` varchar(90) NOT NULL,
  `place` varchar(90) NOT NULL,
  `round` int(2) NOT NULL,
  `end` tinyint(1) NOT NULL,
  `maxplayers` int(4) NOT NULL,
  `npcs` longtext NOT NULL,
  `zeni` int(11) NOT NULL,
  `items` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verlauf`
--

CREATE TABLE `verlauf` (
  `id` int(11) NOT NULL,
  `link` varchar(250) NOT NULL,
  `spieler` varchar(50) NOT NULL,
  `zeit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adminlog`
--
ALTER TABLE `adminlog`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `arenafighter`
--
ALTER TABLE `arenafighter`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `attacks`
--
ALTER TABLE `attacks`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `clans`
--
ALTER TABLE `clans`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `dragonballs`
--
ALTER TABLE `dragonballs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `fighters`
--
ALTER TABLE `fighters`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `fights`
--
ALTER TABLE `fights`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lastfights`
--
ALTER TABLE `lastfights`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `npcs`
--
ALTER TABLE `npcs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `patterns`
--
ALTER TABLE `patterns`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `planet`
--
ALTER TABLE `planet`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pms`
--
ALTER TABLE `pms`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `skilltree`
--
ALTER TABLE `skilltree`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `statslist`
--
ALTER TABLE `statslist`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `titel`
--
ALTER TABLE `titel`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `titelprogress`
--
ALTER TABLE `titelprogress`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tournamentfighter`
--
ALTER TABLE `tournamentfighter`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `verlauf`
--
ALTER TABLE `verlauf`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT für Tabelle `adminlog`
--
ALTER TABLE `adminlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `arenafighter`
--
ALTER TABLE `arenafighter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `attacks`
--
ALTER TABLE `attacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;

--
-- AUTO_INCREMENT für Tabelle `chatmessages`
--
ALTER TABLE `chatmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `clans`
--
ALTER TABLE `clans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `dragonballs`
--
ALTER TABLE `dragonballs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `fighters`
--
ALTER TABLE `fighters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `fights`
--
ALTER TABLE `fights`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT für Tabelle `lastfights`
--
ALTER TABLE `lastfights`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `News`
--
ALTER TABLE `News`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `npcs`
--
ALTER TABLE `npcs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT für Tabelle `patterns`
--
ALTER TABLE `patterns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT für Tabelle `planet`
--
ALTER TABLE `planet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `pms`
--
ALTER TABLE `pms`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `skilltree`
--
ALTER TABLE `skilltree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=520;

--
-- AUTO_INCREMENT für Tabelle `statslist`
--
ALTER TABLE `statslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `story`
--
ALTER TABLE `story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT für Tabelle `titel`
--
ALTER TABLE `titel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT für Tabelle `titelprogress`
--
ALTER TABLE `titelprogress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tournamentfighter`
--
ALTER TABLE `tournamentfighter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verlauf`
--
ALTER TABLE `verlauf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
