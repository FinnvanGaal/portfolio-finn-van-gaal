-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2025 at 03:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fgaal_php_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `deleted_reason` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `guest_id`, `name`, `comment`, `created_at`, `is_deleted`, `deleted_reason`, `deleted_at`, `likes`, `dislikes`) VALUES
(1, 51, 1, NULL, 'alice', 'De geur van kaneel tijdens het bakken was heerlijk.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(2, 51, NULL, 2, 'Gast_2', 'Met slagroom erbij nog lekkerder.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(3, 51, 3, NULL, 'charlie', 'Ik gebruikte goudreinetten, perfect voor dit recept.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(4, 51, NULL, 4, 'Gast_4', 'De bodem was mooi knapperig.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(5, 51, 5, NULL, 'emma', 'Zelfs koud smaakte het de volgende dag nog goed.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(6, 52, 1, NULL, 'alice', 'Romig en kruidig tegelijk, precies zoals in India.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(7, 52, NULL, 2, 'Gast_2', 'De saus combineerde geweldig met rijst.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(8, 52, 3, NULL, 'charlie', 'Ik gebruikte kippendijen, daardoor extra mals.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(9, 52, NULL, 4, 'Gast_4', 'Met naanbrood erbij was het een compleet feestmaal.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(10, 52, 5, NULL, 'emma', 'De smaken waren goed in balans, niet te pittig.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(11, 53, 1, NULL, 'alice', 'Eenvoudig maar heel smaakvol met buffelmozzarella.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(12, 53, NULL, 2, 'Gast_2', 'De basilicum gaf een frisse toets.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(13, 53, 3, NULL, 'charlie', 'Met wat balsamico erbij was het nog beter.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(14, 53, NULL, 4, 'Gast_4', 'Een perfecte lichte lunch op een zomerdag.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(15, 54, 1, NULL, 'alice', 'Het zuur van de limoen gaarde de vis perfect.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(16, 54, NULL, 2, 'Gast_2', 'Met wat avocado erbij werd het nog romiger.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(17, 54, 3, NULL, 'charlie', 'Heel fris en licht, ideaal voor warme dagen.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(18, 54, NULL, 4, 'Gast_4', 'De rode ui gaf net genoeg pit.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(19, 54, 5, NULL, 'emma', 'Doet me denken aan mijn vakantie in Peru.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(20, 55, 1, NULL, 'alice', 'De burger was sappig en goed gekruid.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(21, 55, NULL, 2, 'Gast_2', 'De cheddar smolt er mooi overheen.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(22, 55, 3, NULL, 'charlie', 'Met augurk en bacon erbij was het echt af.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(23, 55, NULL, 4, 'Gast_4', 'Een klassieker die altijd werkt.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(24, 55, 5, NULL, 'emma', 'Lekker snel te maken voor het avondeten.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(25, 56, 1, NULL, 'alice', 'Heerlijk luchtig en niet te zwaar.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(26, 56, NULL, 2, 'Gast_2', 'Met een vleugje sinaasappelrasp werd het bijzonder.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(27, 56, 3, NULL, 'charlie', 'Na een paar uur in de koelkast was de structuur perfect.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(28, 56, NULL, 4, 'Gast_4', 'Met slagroom en aardbeien erbij fantastisch.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(29, 56, 5, NULL, 'emma', 'Echt een ideaal dessert voor een diner.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(30, 57, 1, NULL, 'alice', 'De groenten waren nog knapperig, precies goed.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(31, 57, NULL, 2, 'Gast_2', 'Met munt en koriander werd het heel fris.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(32, 57, 3, NULL, 'charlie', 'De kikkererwten gaven een fijne bite.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(33, 57, NULL, 4, 'Gast_4', 'Heel handig gerecht voor veel personen.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(34, 57, 5, NULL, 'emma', 'Met harissa erbij lekker pittig.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(40, 59, 1, NULL, 'alice', 'De feta en olijven waren heerlijk samen.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(41, 59, NULL, 2, 'Gast_2', 'Met wat oregano smaakte het net als in Griekenland.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(42, 59, 3, NULL, 'charlie', 'Ideaal bij de barbecue.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(43, 59, NULL, 4, 'Gast_4', 'Heel fris en kleurrijk op tafel.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(44, 60, 1, NULL, 'alice', 'Veel romiger dan in de winkel.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(45, 60, NULL, 2, 'Gast_2', 'Met knoflook en citroen perfect op smaak.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(46, 60, 3, NULL, 'charlie', 'Lekker met pita en falafel erbij.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(47, 60, NULL, 4, 'Gast_4', 'Met olijfolie en paprika erop ook mooi voor het oog.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(48, 60, 5, NULL, 'emma', 'Heel makkelijk te maken en goedkoop.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(49, 61, 1, NULL, 'alice', 'De marinade was erg smaakvol.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(50, 61, NULL, 2, 'Gast_2', 'De pindasaus erbij was fantastisch.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(51, 61, 3, NULL, 'charlie', 'Ik maakte het op de barbecue, erg geslaagd.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(52, 61, NULL, 4, 'Gast_4', 'De kip bleef mals en sappig.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(53, 61, 5, NULL, 'emma', 'Mijn gasten wilden het recept hebben.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(54, 62, 1, NULL, 'alice', 'Doet denken aan IKEA, maar veel lekkerder.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(55, 62, NULL, 2, 'Gast_2', 'Met roomsaus en aardappelpuree ideaal.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(56, 62, 3, NULL, 'charlie', 'De balletjes waren stevig maar niet droog.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(57, 62, NULL, 4, 'Gast_4', 'Lingonberry jam maakte het compleet.', '2025-09-15 11:41:01', 0, NULL, NULL, 0, 0),
(58, 63, 1, NULL, 'alice', 'Lekker pittig en toch zoetig tegelijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 24, 3),
(59, 63, NULL, 2, 'Gast_2', 'De pinda’s gaven een goede crunch.', '2025-09-15 11:41:02', 0, NULL, NULL, 6, 6),
(60, 63, 3, NULL, 'charlie', 'Met rijst erbij een complete maaltijd.', '2025-09-15 11:41:02', 0, NULL, NULL, 2, 6),
(61, 63, NULL, 4, 'Gast_4', 'Heel snel klaar en veel smaak.', '2025-09-15 11:41:02', 0, NULL, NULL, 3, 2),
(62, 63, 5, NULL, 'emma', 'De saus was heerlijk kleverig.', '2025-09-15 11:41:02', 0, NULL, NULL, 5, 3),
(63, 64, 1, NULL, 'alice', 'De bodem was dun en knapperig.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(64, 64, NULL, 2, 'Gast_2', 'De kruiden gaven veel smaak.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(65, 64, 3, NULL, 'charlie', 'Met wat sla en citroen erop zoals in Turkije.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(66, 64, NULL, 4, 'Gast_4', 'Makkelijk en lekker om zelf te maken.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(67, 65, 1, NULL, 'alice', 'De vulling was rijk en kruidig.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(68, 65, NULL, 2, 'Gast_2', 'Het deeg was mooi goudbruin na het bakken.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(69, 65, 3, NULL, 'charlie', 'Met rozemarijn kreeg het extra smaak.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(70, 65, NULL, 4, 'Gast_4', 'Heel goed gerecht voor in de winter.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(71, 65, 5, NULL, 'emma', 'De saus maakte het niet droog.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(77, 67, 1, NULL, 'alice', 'Ze waren knapperig en goed gevuld.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(78, 67, NULL, 2, 'Gast_2', 'Met chilisaus erbij geweldig.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(79, 67, 3, NULL, 'charlie', 'De vulling van kip en groenten was top.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(80, 67, NULL, 4, 'Gast_4', 'Makkelijk om van tevoren te maken.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(81, 67, 5, NULL, 'emma', 'Veel beter dan uit de snackbar.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(82, 68, 1, NULL, 'alice', 'De saffraan gaf veel smaak en kleur.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 1),
(83, 68, NULL, 2, 'Gast_2', 'Met garnalen en kip erg feestelijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 1, 0),
(84, 68, 3, NULL, 'charlie', 'Doet denken aan Spanje, echt vakantiegevoel.', '2025-09-15 11:41:02', 0, NULL, NULL, 1, 0),
(85, 68, NULL, 4, 'Gast_4', 'De rijst was mooi gaar en niet plakkerig.', '2025-09-15 11:41:02', 0, NULL, NULL, 1, 0),
(86, 68, 5, NULL, 'emma', 'Met citroenpartjes erop prachtig geserveerd.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(87, 69, 1, NULL, 'alice', 'Lekker romig en zacht van smaak.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(88, 69, NULL, 2, 'Gast_2', 'Met wat room erbij werd het heerlijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(89, 69, 3, NULL, 'charlie', 'Perfect als voorgerecht in de herfst.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(90, 69, NULL, 4, 'Gast_4', 'De kruiden maakten het hartig en verwarmend.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(91, 69, 5, NULL, 'emma', 'Kinderen vonden het ook lekker.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(92, 70, 1, NULL, 'alice', 'Goed gevuld en luchtig tegelijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(93, 70, NULL, 2, 'Gast_2', 'De bodem was knapperig en stevig.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(94, 70, 3, NULL, 'charlie', 'Met spekjes en kaas echt een succes.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(95, 70, NULL, 4, 'Gast_4', 'Handig gerecht voor een lunch.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(96, 70, 5, NULL, 'emma', 'Ook koud erg smakelijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(97, 71, 1, NULL, 'alice', 'De bouillon had veel diepte van smaak.', '2025-09-15 11:41:02', 0, NULL, NULL, 2, 0),
(98, 71, NULL, 2, 'Gast_2', 'Met zachtgekookte eieren was het perfect.', '2025-09-15 11:41:02', 0, NULL, NULL, 1, 0),
(99, 71, 3, NULL, 'charlie', 'De noedels waren precies goed gaar.', '2025-09-15 11:41:02', 0, NULL, NULL, 1, 0),
(100, 71, NULL, 4, 'Gast_4', 'Doet denken aan Japan, echt authentiek.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(101, 71, 5, NULL, 'emma', 'Met paksoi en varkensvlees een heerlijke combinatie.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(102, 72, 1, NULL, 'alice', 'Lekker pittig en kruidig tegelijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(103, 72, NULL, 2, 'Gast_2', 'De kokosmelk maakte het romig.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(104, 72, 3, NULL, 'charlie', 'Met jasmijnrijst was het compleet.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(105, 72, NULL, 4, 'Gast_4', 'De groenten bleven mooi knapperig.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(106, 72, 5, NULL, 'emma', 'Niet te ingewikkeld en snel klaar.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(107, 73, 1, NULL, 'alice', 'Een echte klassieker, simpel en lekker.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(108, 73, NULL, 2, 'Gast_2', 'Met veel kaas erop het allerbeste.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(109, 73, 3, NULL, 'charlie', 'De saus was vol van smaak.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(110, 73, NULL, 4, 'Gast_4', 'Met knoflookbrood erbij perfect.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(111, 73, 5, NULL, 'emma', 'Snel klaar en altijd geslaagd.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(112, 74, 1, NULL, 'alice', 'Leuk dat iedereen zijn eigen taco kan vullen.', '2025-09-15 11:41:02', 0, NULL, NULL, 9, 3),
(113, 74, NULL, 2, 'Gast_2', 'Met guacamole erbij heerlijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 4, 6),
(114, 74, 3, NULL, 'charlie', 'De krokante schelpen waren lekker.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(115, 74, NULL, 4, 'Gast_4', 'Goed gevuld en toch makkelijk te maken.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(116, 74, 5, NULL, 'emma', 'Perfect voor een avond met vrienden.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(117, 75, 1, NULL, 'alice', 'Knapperig van buiten en zacht van binnen.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(118, 75, NULL, 2, 'Gast_2', 'Met slagroom en aardbeien geweldig.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(119, 75, 3, NULL, 'charlie', 'De geur in huis tijdens het bakken was heerlijk.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(120, 75, NULL, 4, 'Gast_4', 'De kinderen vonden het fantastisch.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(121, 75, 5, NULL, 'emma', 'Ook koud lekker als tussendoortje.', '2025-09-15 11:41:02', 0, NULL, NULL, 0, 0),
(122, 60, NULL, NULL, 'gebruiker_6852', 'Hallo', '2025-09-15 11:50:24', 0, NULL, NULL, 0, 0),
(126, 51, NULL, NULL, 'gebruiker_5890', 'Test', '2025-09-23 08:27:20', 1, 'Spam of reclame', NULL, 0, 0),
(137, 51, 7, NULL, 'isabella', 'Hallo', '2025-09-23 11:25:53', 0, NULL, NULL, 0, 0),
(138, 51, 7, NULL, 'isabella', 'Test', '2025-09-23 11:27:22', 0, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment_votes`
--

CREATE TABLE `comment_votes` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `vote` enum('like','dislike') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_votes`
--

INSERT INTO `comment_votes` (`id`, `comment_id`, `user_id`, `guest_id`, `vote`, `created_at`) VALUES
(1, 82, 7, NULL, 'dislike', '2025-10-02 10:53:48'),
(2, 83, 7, NULL, 'like', '2025-10-02 10:53:52'),
(3, 84, 7, NULL, 'like', '2025-10-02 10:53:53'),
(4, 97, NULL, NULL, 'like', '2025-10-06 08:14:51'),
(5, 97, NULL, NULL, 'like', '2025-10-06 08:14:54'),
(6, 98, NULL, NULL, 'like', '2025-10-06 08:14:57'),
(7, 99, NULL, NULL, 'like', '2025-10-06 08:14:59'),
(8, 113, NULL, NULL, 'like', '2025-10-06 08:15:07'),
(9, 112, NULL, NULL, 'like', '2025-10-06 08:15:08'),
(10, 112, NULL, NULL, 'dislike', '2025-10-06 08:15:11'),
(11, 112, NULL, NULL, 'dislike', '2025-10-06 08:15:12'),
(12, 112, NULL, NULL, 'dislike', '2025-10-06 08:15:13'),
(13, 112, NULL, NULL, 'like', '2025-10-06 08:15:14'),
(14, 112, NULL, NULL, 'like', '2025-10-06 08:15:15'),
(15, 112, NULL, NULL, 'like', '2025-10-06 08:15:15'),
(16, 112, NULL, NULL, 'like', '2025-10-06 08:15:15'),
(17, 112, NULL, NULL, 'like', '2025-10-06 08:15:16'),
(18, 112, NULL, NULL, 'like', '2025-10-06 08:15:16'),
(19, 113, NULL, NULL, 'like', '2025-10-06 08:15:17'),
(20, 113, NULL, NULL, 'dislike', '2025-10-06 08:15:18'),
(21, 113, NULL, NULL, 'dislike', '2025-10-06 08:15:18'),
(22, 113, NULL, NULL, 'dislike', '2025-10-06 08:15:19'),
(23, 113, NULL, NULL, 'like', '2025-10-06 08:15:19'),
(24, 113, NULL, NULL, 'like', '2025-10-06 08:15:19'),
(25, 113, NULL, NULL, 'dislike', '2025-10-06 08:15:20'),
(26, 113, NULL, NULL, 'dislike', '2025-10-06 08:15:20'),
(27, 113, NULL, NULL, 'dislike', '2025-10-06 08:15:21'),
(28, 112, NULL, NULL, 'like', '2025-10-06 08:15:42'),
(29, 112, NULL, NULL, 'like', '2025-10-06 08:15:42'),
(30, 61, NULL, 33, 'dislike', '2025-10-06 08:38:11'),
(31, 58, NULL, 33, 'like', '2025-10-06 08:38:15'),
(32, 59, NULL, 33, 'like', '2025-10-06 08:38:20'),
(33, 60, NULL, 33, 'like', '2025-10-06 08:38:24'),
(34, 62, NULL, 33, 'dislike', '2025-10-06 09:08:18'),
(35, 85, 7, 33, 'like', '2025-10-06 09:08:26'),
(36, 60, 7, 33, 'dislike', '2025-10-06 09:21:23'),
(37, 61, 7, 33, 'dislike', '2025-10-06 09:21:24'),
(38, 58, 7, 33, 'like', '2025-10-06 09:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `ip`, `created_at`) VALUES
(1, 'Gast_1', '192.168.0.11', '2025-09-15 11:35:48'),
(2, 'Gast_2', '192.168.0.12', '2025-09-15 11:35:48'),
(3, 'Gast_3', '192.168.0.13', '2025-09-15 11:35:48'),
(4, 'Gast_4', '192.168.0.14', '2025-09-15 11:35:48'),
(5, 'Gast_5', '192.168.0.15', '2025-09-15 11:35:48'),
(6, 'Gast_6', '192.168.0.16', '2025-09-15 11:35:48'),
(7, 'Gast_7', '192.168.0.17', '2025-09-15 11:35:48'),
(8, 'Gast_8', '192.168.0.18', '2025-09-15 11:35:48'),
(33, 'gebruiker_5407', '::1', '2025-10-06 08:32:51'),
(34, 'gebruiker_5413', '::1', '2025-10-06 09:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `image`, `slug`, `created_at`) VALUES
(51, 1, 'Traditionele Hollandse Appeltaart met Kaneel en Knapperige Korst', 'Deze klassieke Hollandse appeltaart combineert frisse goudreinetten met een vleugje kaneel en een knapperige korst. Het recept wordt al generaties doorgegeven en is een favoriet tijdens verjaardagen en feestdagen. De geur van gebakken appel en kaneel vult het huis en maakt het tot een echte traktatie. Serveer met slagroom of een bolletje vanille-ijs voor een perfecte afsluiter.', 'appeltaart.jpg', 'appeltaart', '2025-03-27 17:27:31'),
(52, 2, 'Romige Indiase Butter Chicken met Aromatische Kruiden', 'Butter Chicken is een iconisch Indiaas gerecht waarin malse stukken kip worden gestoofd in een romige tomatensaus met boter en yoghurt. De combinatie van specerijen als garam masala, komijn en gember zorgt voor diepe en rijke smaken. Dit gerecht is mild genoeg voor het hele gezin en wordt vaak geserveerd met rijst of naanbrood. Het is ideaal om te delen tijdens een gezellig diner.', 'butter-chicken.jpg', 'romige-indiase-butter-chicken-met-aromatische-kruiden', '2025-01-28 15:05:34'),
(53, 3, 'Italiaanse Caprese Salade met Mozzarella en Verse Basilicum', 'De Caprese salade is een symbool van de Italiaanse keuken en staat bekend om haar eenvoud en pure smaken. Rijpe tomaten, romige mozzarella en geurige basilicum worden op een bord afgewisseld en besprenkeld met olijfolie. Met een scheutje balsamico en een snuf zout en peper is dit een frisse en lichte salade. Perfect als voorgerecht of lichte lunch op een zomerse dag.', 'caprese.jpg', 'caprese', '2024-12-11 13:46:27'),
(54, 4, 'Frisse Peruaanse Ceviche van Witvis en Limoen', 'Ceviche is een traditioneel gerecht uit Peru waarbij verse vis wordt gegaard in het zuur van limoenen. De toevoeging van rode ui, koriander en chilipeper zorgt voor een frisse en pittige smaak. Het gerecht wordt meestal koud geserveerd en is ideaal als voorgerecht of lichte maaltijd. Het is verfrissend, gezond en boordevol eiwitten.', 'ceviche.jpg', 'ceviche', '2024-10-06 14:16:38'),
(55, 5, 'Amerikaanse Cheeseburger met Sappig Rundergehakt en Smeltende Cheddar', 'De cheeseburger is een echte klassieker uit de Amerikaanse keuken. Sappige burgers van rundergehakt worden gegrild en belegd met een smeltende plak cheddar. Met verse tomaat, knapperige sla en augurk tussen een geroosterd broodje is dit comfortfood pur sang. Heerlijk met friet of een frisse coleslaw.', 'cheeseburger.jpg', 'cheeseburger', '2025-04-03 20:45:00'),
(56, 6, 'Franse Chocolademousse met Luchtige Textuur', 'Deze Franse klassieker is een elegant dessert dat eenvoudig te maken is maar altijd indruk maakt. De mousse is licht en luchtig, maar toch intens van smaak dankzij de pure chocolade. Serveer in mooie glaasjes en garneer met slagroom of rood fruit voor een feestelijke presentatie. Een perfecte afsluiting van een diner.', 'chocolademousse.jpg', 'chocolademousse', '2025-04-03 03:36:14'),
(57, 7, 'Marokkaanse Couscous met Groenten en Kruiden', 'Couscous is een veelzijdig gerecht dat in heel Noord-Afrika wordt gegeten. Het wordt vaak gecombineerd met gestoofde groenten en een mix van specerijen zoals komijn, koriander en kaneel. Deze variant is licht en voedzaam en perfect als gezonde maaltijd. Met een beetje harissa krijgt het gerecht een pittige kick.', 'couscous.jpg', 'couscous', '2024-10-08 18:27:20'),
(59, 1, 'Authentieke Griekse Salade met Feta en Olijven', 'De Griekse salade is kleurrijk, fris en zit boordevol mediterrane smaken. Tomaten, komkommer, rode ui, feta en olijven vormen de basis en worden afgemaakt met olijfolie en oregano. Het is een eenvoudig maar smaakvol gerecht dat perfect past bij gegrild vlees of vis. Een zomerse klassieker die nooit verveelt.', 'griekse-salade.jpg', 'griekse-salade', '2024-10-04 08:04:37'),
(60, 2, 'Romige Midden-Oosterse Hummus met Tahin en Citroen', 'Hummus is een populaire dip uit het Midden-Oosten, gemaakt van kikkererwten, tahin, knoflook en citroen. Het is romig, voedzaam en past perfect bij brood of rauwe groenten. Door olijfolie en paprikapoeder toe te voegen wordt het nog smaakvoller. Hummus is bovendien vegetarisch en gezond.', 'hummus.jpg', 'hummus', '2024-12-24 06:36:58'),
(61, 3, 'Indonesische Kipsaté met Pittige Pindasaus', 'Kipsaté is een klassieker uit de Indonesische keuken en geliefd in Nederland. Gemarineerde kipspiesjes worden gegrild en geserveerd met een romige, pittige pindasaus. Het gerecht is eenvoudig te maken en altijd een succes tijdens een barbecue. Met wat kroepoek en atjar erbij wordt het compleet.', 'kipsate.jpg', 'kipsate', '2024-11-22 23:32:06'),
(62, 4, 'Zweedse Köttbullar met Roomsaus en Aardappelpuree', 'Köttbullar zijn Zweedse gehaktballetjes die beroemd zijn geworden door IKEA, maar zelfgemaakt nog lekkerder zijn. Ze worden geserveerd met een romige roomsaus, aardappelpuree en lingonberry jam. Het is een hartig en vullend gerecht dat zowel kinderen als volwassenen aanspreekt. Perfect comfortfood voor doordeweekse avonden.', 'kottbullar.jpg', 'kottbullar', '2024-10-19 16:30:46'),
(63, 5, 'Chinese Kung Pao Kip met Pinda’s en Chilipeper', 'Kung Pao is een roerbakgerecht uit Sichuan dat bekendstaat om zijn pittige en lichtzoete smaak. Kipstukjes worden gebakken met groenten, pinda’s en een smaakvolle saus op basis van sojasaus en rijstazijn. Het is een gerecht dat snel op tafel staat en barst van de smaak. Ideaal te combineren met gestoomde rijst.', 'kung-pao.jpg', 'kung-pao', '2025-08-03 02:38:40'),
(64, 6, 'Turkse Lahmacun met Kruidige Gehaktvulling', 'Lahmacun, ook wel Turkse pizza genoemd, bestaat uit een dunne deegbodem belegd met gekruid gehakt en groenten. Na het bakken wordt het vaak opgerold met verse sla en citroen. Het resultaat is een licht maar smaakvol gerecht dat ideaal is als lunch of streetfood. Een absolute favoriet in Turkije en ver daarbuiten.', 'lahmacun.jpg', 'lahmacun', '2024-10-22 02:22:08'),
(65, 7, 'Hartige Lamspastei met Groenten en Bladerdeeg', 'Deze lamspastei combineert mals lamsvlees met groenten en een rijke saus, verpakt in een laag bladerdeeg. Het is een gerecht dat zowel feestelijk als vullend is en perfect past bij een diner met vrienden of familie. De kruidige smaak van het vlees komt prachtig samen met de knapperige korst. Een klassieker uit de Britse keuken.', 'lamspastei.jpg', 'lamspastei', '2025-07-16 18:35:50'),
(67, 1, 'Krokante Loempia’s met Kip en Groenten', 'Loempia’s zijn gefrituurde deegrolletjes gevuld met een hartige mix van kip en groenten. Ze zijn knapperig van buiten en vol van smaak van binnen. Serveer met een pittige chilisaus voor een lekkere bite. Een populair hapje dat perfect is als snack of voorgerecht.', 'loempias.jpg', 'loempias', '2025-05-25 05:43:11'),
(68, 2, 'Spaanse Paella met Kip, Garnalen en Saffraanrijst', 'Paella is hét iconische gerecht uit Valencia, Spanje. Het combineert rijst met saffraan, kip, garnalen en groenten, allemaal bereid in één pan. Het resultaat is een kleurrijk en smaakvol gerecht dat perfect is om te delen. Traditioneel wordt het in een grote paellapan geserveerd tijdens feestelijke gelegenheden.', 'paella.jpg', 'paella', '2025-08-08 05:35:20'),
(69, 3, 'Romige Pompoensoep met Kruiden en Room', 'Pompoensoep is een verwarmend gerecht dat ideaal is in de herfst en winter. De pompoen wordt zachtgekookt en gepureerd tot een romige soep. Met kruiden zoals nootmuskaat en een scheut room krijgt het extra diepte. Serveer met vers brood voor een complete maaltijd.', 'pompoensoep.jpg', 'pompoensoep', '2025-02-02 01:28:17'),
(70, 4, 'Hartige Quiche met Spek, Kaas en Room', 'Quiche is een veelzijdig gerecht dat zowel warm als koud gegeten kan worden. Deze variant met spek, kaas en room is rijk en vullend. Het deeg wordt knapperig gebakken en vormt een perfecte basis voor de romige vulling. Ideaal voor brunch of lunch.', 'quiche.jpg', 'quiche', '2024-11-28 05:16:33'),
(71, 5, 'Japanse Ramen met Bouillon, Varkensvlees en Ei', 'Ramen is een populaire Japanse noedelsoep die wereldwijd geliefd is. De bouillon is rijk en smaakvol, vaak urenlang getrokken van vlees en groenten. Met noedels, zachtgekookte eieren, paksoi en plakjes varkensvlees is het een complete maaltijd. Elke kom ramen voelt als een hartverwarmende traktatie.', 'ramen.jpg', 'ramen', '2025-07-18 12:39:03'),
(72, 6, 'Thaise Rode Curry met Kip en Kokosmelk', 'Deze Thaise rode curry combineert de pittigheid van rode currypasta met de romigheid van kokosmelk. Kip en groenten worden kort mee gestoofd en nemen de volle smaak op. Het gerecht is kruidig, aromatisch en snel te bereiden. Serveer met geurige jasmijnrijst voor een complete maaltijd.', 'rode-curry.jpg', 'rode-curry', '2025-04-08 14:06:44'),
(73, 7, 'Italiaanse Spaghetti Carbonara met Spek en Parmezaan', 'Spaghetti Carbonara is een klassieker uit Rome. De saus bestaat uit eieren, Parmezaanse kaas en spek, wat zorgt voor een romige textuur zonder room. Het is een snel en eenvoudig gerecht met pure smaken. Perfect voor een doordeweekse avond als je weinig tijd hebt.', 'spaghetti.jpg', 'spaghetti', '2024-12-22 23:17:40'),
(74, 8, 'Mexicaanse Tacos met Gekruid Rundergehakt en Verse Toppings', 'Tacos zijn een essentieel onderdeel van de Mexicaanse keuken. Knapperige taco’s worden gevuld met gekruid gehakt, verse groenten en kaas. Iedereen kan zijn eigen taco samenstellen, wat het ideaal maakt voor etentjes met vrienden of familie. Met guacamole of salsa erbij zijn ze nog lekkerder.', 'tacos.jpg', 'tacos', '2025-05-06 16:49:17'),
(75, 1, 'Belgische Wafels met Knapperige Buitenlaag en Zachte Binnenkant', 'Belgische wafels staan bekend om hun luchtige structuur en krokante buitenkant. Ze worden vaak geserveerd met slagroom, vers fruit of chocolade. De geur van versgebakken wafels vult het huis en maakt dit tot een echte lekkernij. Een traktatie voor ontbijt, brunch of dessert.', 'wafels.jpg', 'wafels', '2025-01-25 04:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `serves` int(11) DEFAULT NULL,
  `total_minutes` int(11) DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `steps` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `post_id`, `serves`, `total_minutes`, `ingredients`, `steps`) VALUES
(26, 51, 8, 90, '[\"6 appels\",\"200 g bloem\",\"150 g boter\",\"150 g suiker\",\"2 eieren\",\"1 tl kaneel\"]', '[\"Verwarm oven voor op 180°C.\",\"Schil en snijd appels.\",\"Maak deeg van bloem, boter, suiker en eieren.\",\"Bekleed vorm en vul met appels en kaneel.\",\"Bak 60 minuten.\"]'),
(27, 52, 4, 60, '[\"500 g kipfilet\",\"200 ml yoghurt\",\"3 el currypasta\",\"200 ml kookroom\",\"1 ui\",\"2 tenen knoflook\",\"1 blik tomatenblokjes\"]', '[\"Marineer kip in yoghurt en currypasta.\",\"Bak ui en knoflook.\",\"Voeg kip toe en bak kort.\",\"Voeg tomaten en room toe.\",\"Laat 35 min sudderen.\"]'),
(28, 53, 2, 10, '[\"3 tomaten\",\"200 g mozzarella\",\"handvol basilicum\",\"2 el olijfolie\",\"zout\",\"peper\"]', '[\"Snijd tomaten en mozzarella.\",\"Leg om en om op bord.\",\"Garneer met basilicum.\",\"Besprenkel met olijfolie, zout en peper.\"]'),
(29, 54, 4, 30, '[\"400 g witvis\",\"4 limoenen\",\"1 rode ui\",\"1 rode peper\",\"koriander\",\"zout\"]', '[\"Snijd vis in blokjes.\",\"Pers limoenen uit en marineer vis.\",\"Voeg ui en peper toe.\",\"Laat 20 min garen in zuur.\",\"Garneer met koriander.\"]'),
(30, 55, 2, 25, '[\"2 broodjes\",\"300 g rundergehakt\",\"2 plakken cheddar\",\"1 ui\",\"sla\",\"tomaat\",\"saus naar keuze\"]', '[\"Maak burgers van gehakt.\",\"Bak burgers in pan.\",\"Leg cheddar op burgers.\",\"Snijd broodjes open en beleg met sla en tomaat.\",\"Voeg burger en saus toe.\"]'),
(31, 56, 4, 120, '[\"200 g pure chocolade\",\"3 eieren\",\"50 g suiker\",\"200 ml slagroom\"]', '[\"Smelt chocolade au bain-marie.\",\"Splits eieren, klop eiwitten stijf.\",\"Klop slagroom lobbig.\",\"Meng alles voorzichtig.\",\"Laat 2 uur opstijven in koelkast.\"]'),
(32, 57, 4, 25, '[\"250 g couscous\",\"1 courgette\",\"1 paprika\",\"1 wortel\",\"300 ml groentebouillon\",\"kikkererwten\",\"kruiden (komijn, koriander)\"]', '[\"Snijd groenten klein.\",\"Kook bouillon en laat couscous wellen.\",\"Bak groenten kort.\",\"Meng couscous, groenten en kikkererwten.\",\"Breng op smaak met kruiden.\"]'),
(34, 59, 4, 15, '[\"3 tomaten\",\"1 komkommer\",\"1 rode ui\",\"150 g feta\",\"olijven\",\"olijfolie\",\"oregano\"]', '[\"Snijd tomaten, komkommer en ui.\",\"Voeg feta en olijven toe.\",\"Besprenkel met olijfolie.\",\"Bestrooi met oregano.\"]'),
(35, 60, 6, 10, '[\"1 blik kikkererwten\",\"3 el tahin\",\"1 teen knoflook\",\"sap van 1 citroen\",\"3 el olijfolie\"]', '[\"Pureer kikkererwten met tahin en knoflook.\",\"Voeg citroensap toe.\",\"Voeg olijfolie toe tot romig.\",\"Serveer met brood of groenten.\"]'),
(36, 61, 4, 45, '[\"400 g kipfilet\",\"2 el ketjap\",\"1 teen knoflook\",\"1 ui\",\"pindasaus\",\"sateprikkers\"]', '[\"Snijd kip in blokjes en marineer.\",\"Rijg kip aan prikkers.\",\"Grill kip 10 min.\",\"Serveer met pindasaus.\"]'),
(37, 62, 4, 40, '[\"400 g gehakt\",\"1 ui\",\"1 ei\",\"50 g paneermeel\",\"100 ml room\",\"aardappelpuree\",\"lingonberry jam\"]', '[\"Meng gehakt met ui, ei en paneermeel.\",\"Draai balletjes.\",\"Bak in boter.\",\"Serveer met roomsaus, puree en jam.\"]'),
(38, 63, 4, 30, '[\"400 g kipfilet\",\"2 paprika’s\",\"1 rode peper\",\"3 el sojasaus\",\"2 el rijstazijn\",\"pinda’s\"]', '[\"Snijd kip en groenten.\",\"Bak kip bruin.\",\"Voeg groenten en saus toe.\",\"Laat kort sudderen.\",\"Strooi pinda’s erover.\"]'),
(39, 64, 4, 60, '[\"4 wraps\",\"200 g gehakt\",\"1 ui\",\"1 paprika\",\"tomatenpuree\",\"peterselie\",\"kruiden\"]', '[\"Bak gehakt met ui en paprika.\",\"Voeg tomatenpuree toe.\",\"Besmeer wraps met mengsel.\",\"Bak kort in oven.\",\"Bestrooi met peterselie.\"]'),
(40, 65, 4, 90, '[\"500 g lamsvlees\",\"2 wortels\",\"1 ui\",\"2 rollen bladerdeeg\",\"300 ml bouillon\",\"1 el bloem\"]', '[\"Bak vlees bruin, voeg groenten toe.\",\"Bestrooi met bloem en roer.\",\"Voeg bouillon toe en laat sudderen.\",\"Bekleed vorm met deeg, vul en dek af.\",\"Bak 40 min in oven.\"]'),
(42, 67, 6, 50, '[\"12 loempiavellen\",\"200 g kip\",\"150 g groentenmix\",\"2 el sojasaus\",\"olie om te frituren\"]', '[\"Bak kip en groenten.\",\"Vul loempiavellen en rol op.\",\"Frituur in hete olie.\",\"Serveer warm met saus.\"]'),
(43, 68, 6, 60, '[\"300 g rijst\",\"200 g garnalen\",\"200 g kip\",\"1 paprika\",\"1 ui\",\"1 liter kippenbouillon\",\"saffraan\"]', '[\"Fruit ui en paprika.\",\"Voeg rijst toe en bak kort.\",\"Voeg bouillon en saffraan toe.\",\"Laat zachtjes garen.\",\"Voeg kip en garnalen toe.\",\"Laat nog 10 min sudderen.\"]'),
(44, 69, 4, 40, '[\"800 g pompoen\",\"1 ui\",\"2 tenen knoflook\",\"1 liter groentebouillon\",\"kruiden\",\"room\"]', '[\"Snijd pompoen in blokjes.\",\"Fruit ui en knoflook.\",\"Voeg pompoen en bouillon toe.\",\"Kook 25 min.\",\"Pureer en voeg room toe.\"]'),
(45, 70, 4, 60, '[\"1 rol bladerdeeg\",\"3 eieren\",\"200 ml room\",\"200 g spekblokjes\",\"100 g kaas\"]', '[\"Bekleed vorm met deeg.\",\"Bak spek kort.\",\"Klop eieren met room.\",\"Vul vorm met spek, kaas en mengsel.\",\"Bak 40 min in oven.\"]'),
(46, 71, 2, 40, '[\"200 g ramen noedels\",\"1 liter kippenbouillon\",\"2 eieren\",\"100 g varkensvlees\",\"paksoi\",\"sojasaus\"]', '[\"Kook bouillon met sojasaus.\",\"Kook noedels apart.\",\"Kook eieren zacht.\",\"Bak vlees en snijd in plakjes.\",\"Serveer bouillon met noedels, vlees, ei en groenten.\"]'),
(47, 72, 4, 30, '[\"400 g kipfilet\",\"2 el rode currypasta\",\"200 ml kokosmelk\",\"1 paprika\",\"1 ui\",\"rijst\"]', '[\"Bak ui en kip.\",\"Voeg currypasta toe.\",\"Voeg kokosmelk en groenten toe.\",\"Laat 15 min sudderen.\",\"Serveer met rijst.\"]'),
(48, 73, 4, 20, '[\"400 g spaghetti\",\"200 g spekblokjes\",\"3 eieren\",\"60 g Parmezaanse kaas\",\"1 teen knoflook\",\"peper\"]', '[\"Kook spaghetti.\",\"Bak spek met knoflook, verwijder knoflook.\",\"Klop eieren met kaas en peper.\",\"Meng hete pasta met spek en eimengsel.\"]'),
(49, 74, 4, 30, '[\"8 taco shells\",\"300 g rundergehakt\",\"1 ui\",\"1 zakje tacokruiden\",\"sla\",\"tomaat\",\"kaas\"]', '[\"Bak gehakt met ui en kruiden.\",\"Verwarm taco’s.\",\"Vul met sla, tomaat en gehakt.\",\"Bestrooi met kaas.\"]'),
(50, 75, 4, 30, '[\"250 g bloem\",\"2 eieren\",\"50 g suiker\",\"1 tl bakpoeder\",\"300 ml melk\",\"50 g boter\"]', '[\"Meng bloem, suiker en bakpoeder.\",\"Voeg eieren en melk toe.\",\"Klop tot glad beslag.\",\"Bak in wafelijzer.\",\"Serveer warm.\"]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`) VALUES
(1, 'alice', 'alice@example.com', '$2b$10$hX.mKlqhxKTN5vXYGtBWk.urW7fSh/c/.rklY5RWDWCHdRZQOHopG'),
(2, 'bob', 'bob@example.com', '$2b$10$q/PNepXHL2lh/pMtmvSbjO9B2maSDAEdvQSJwEZK64hjj70c1zRD2'),
(3, 'charlie', 'charlie@example.com', '$2b$10$2yipK2hprSnToT9U3HYO2OvVa/ZJLz2nbW1bgzTGvQ9N5ih.XvyGq'),
(4, 'david', 'david@example.com', '$2b$10$YI5Ovd3yTYxiV/8f9dJJXuPn/oTZjOfnyOfOI49pOLXFuQTg3OgAS'),
(5, 'emma', 'emma@example.com', '$2b$10$q2kHXeNWhRB2.4EQZ9fE5uLtvJ5ckd1KFyKUZCeEmRMoXyH6Mql7q'),
(6, 'felix', 'felix@example.com', '$2b$10$mcye053/7JP1QHEBQ8wfpePCHPxs0BObUE7TTaTiJ5tKYD22tI4oi'),
(7, 'isabella', 'isabella@example.com', '$2b$10$k4PnlH5xa9mc5y.agYX.OOo/S36g6Q8e/rAhFRMqfeWYDoVR072Um'),
(8, 'lucas', 'lucas@example.com', '$2b$10$QzaXknVeHyE1s8vlgjgVges5uLfInGOGI29r3HZwchyM3v4jgNyg.'),
(9, 'finn', 'finnvangaal@gmail.com', '$2y$10$65THQTSA7PTWR5EvoAG9o.1I2PGce/twEihZlB2NqPBxluch02fUS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_posts` (`post_id`),
  ADD KEY `fk_comments_users` (`user_id`),
  ADD KEY `fk_comments_guests` (`guest_id`);

--
-- Indexes for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_vote` (`comment_id`,`user_id`,`guest_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_posts_users` (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipes_posts` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `comment_votes`
--
ALTER TABLE `comment_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_guests` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_comments_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD CONSTRAINT `comment_votes_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipes_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
