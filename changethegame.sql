-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: changethegame_mariadb
-- Generation Time: Aug 23, 2021 at 04:15 PM
-- Server version: 10.3.28-MariaDB-1:10.3.28+maria~focal
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `changethegame`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `name`, `value`) VALUES
(2, 'show_is_going_on', 'false'),
(3, 'recipient', 'testshow'),
(4, 'timeline_cursor', '1450'),
(5, 'timestamp_show_start', '1629663072');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210817184432', '2021-08-17 20:44:47', 36),
('DoctrineMigrations\\Version20210817185003', '2021-08-17 20:50:08', 42),
('DoctrineMigrations\\Version20210817185446', '2021-08-17 20:54:51', 18);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `timestamp`, `message`, `sender`) VALUES
(6, 167, 'Hallo Pion. De zet die u voor vandaag is toegewezen: het computerpark van het Zwarte Huis vernieuwen. Teamleden: D3 & B6. \r\nAutomatisch bericht van Deep Blue BV', 'deepbluebv'),
(7, 317, 'Denk je dat Move\'app veilig is?', 'deschuine'),
(8, 320, 'Volg de “moves” van andere stukken. Willekeurig speciaal voor jou uitgekozen, wijd verspreid over heel New-Ebony. De Schuine', 'deschuine'),
(9, 748, '%date%, %time% - K1: Ik ben klaar. Waar ben je?\r\n\r\n%date%, %time% - C4: Is hij gesprongen?\r\n\r\n%date%, %time% - K1: Uiteraard.\r\n\r\n%date%, %time% - C4: Die lui zijn totaal geschift :)\r\n\r\n%date%, %time% - K1: Niet grappig.\r\n\r\n%date%, %time% - K1: Moge de speler ons verplaatsen.', 'deschuine'),
(10, 768, '%date%, %time% - C4: Ik ben op de honk.\r\n\r\n%date%, %time% - C4: <Media omitted>\r\n\r\n%date%, %time% - C4: Ziet er niet slecht uit hè?\r\n\r\n%date%, %time% - K1: Stuur me ff de link van het verhoor.\r\n\r\n%date%, %time% - C4: policenewebony.org/codeinterogarrivalsIOR.72065', 'deschuine'),
(11, 973, '%date%, %time% - K1: Check of ze een koele pit heeft.\r\n\r\n%date%, %time% - C4: ok\r\n\r\n%date%, %time% - K1: OK. Hou haar.\r\n\r\n%date%, %time% - K1: Zet haar op onze politica, “Van H8”.\r\n\r\n%date%, %time% - C4: Done', 'deschuine'),
(12, 1457, 'If they can read your move-apps, you can read theirs.', 'deschuine1'),
(13, 1459, '%date%, %time% - Van H8: Commissaris K1, in het Zwarte Huis hebben twee technici zojuist officiële bestanden gestolen.\r\n\r\n%date%, %time% - Van H8: Pas, ik geloof dat ze gewapend zijn! Dank\r\n\r\n%date%, %time% - Van H8: Ik wil de bestanden terug in eigen handen.\r\n\r\n%date%, %time% - K1: We zijn onderweg\r\n\r\n%date%, %time% - K1: Wordt geregeld.', 'deschuine1'),
(14, 1554, 'Deze pion wordt verdacht van een misdrijf of is daarvan juist slachtoffer. Herkent u deze, of hebt u informatie over deze? Neem dan contact op met de politie. Klik op de link voor om zijn foto te zien:', 'emergencyalert'),
(15, 1555, 'https://changethegame.k-and-a.co/D3.jpg', 'emergencyalert'),
(16, 2027, '%date%, %time% - D3: Thanks voor alles A4, wil je niet in de problemen brengen. Cool dat je het boek van Zweig nog hebt. Tot later hoop ik, D3.\r\n\r\n%date%, %time% - A4: D3!?\r\n\r\n%date%, %time% - A4: Waar ben je?', 'deschuine'),
(17, 2129, '%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: C4! Waar ben je?\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Neem die fucking telefoon op!\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Verdomme!\r\n\r\n%date%, %time% - K1: Check de cover van de Pion.\r\n\r\n%date%, %time% - K1: We moeten iets doen.\r\n\r\n%date%, %time% - K1: Missed voice call\r\n\r\n%date%, %time% - K1: Nu!', 'deschuine'),
(18, 2188, 'THE GAME IS ROTTEN', 'deschuine1'),
(19, 2189, 'THE GAME IS ROTTEN', 'deschuine1'),
(20, 2189, 'THE GAME IS ROTTEN', 'deschuine111'),
(21, 2189, 'THE GAME IS ROTTEN', 'deschuine33'),
(22, 2191, 'THE GAME IS ROTTEN', 'deschuine23'),
(23, 2192, 'THE GAME IS ROTTEN', 'deschuine71'),
(24, 2191, 'THE GAME IS ROTTEN', 'deschuine23'),
(25, 2192, 'THE GAME IS ROTTEN', 'deschuine71'),
(26, 2191, 'THE GAME IS ROTTEN', 'deschuine11'),
(27, 2192, 'THE GAME IS ROTTEN', 'deschuine69'),
(28, 2192, 'THE GAME IS ROTTEN', 'deschuine83'),
(29, 2276, 'De Schuine', 'deschuine1'),
(30, 2276, 'De Schuine', 'deschuine11'),
(31, 2276, 'De Schuine', 'deschuine111'),
(32, 2428, '%date%, %time% - K1: <Media omitted>\r\n\r\n%date%, %time% - K1: Pion D3\r\n\r\n%date%, %time% - K1: Een junk met een snee op zijn hoofd\r\n\r\n%date%, %time% - N°5: You deleted this message', 'deschuine'),
(33, 2603, '%date%, %time% - N°5: Missed voice call\r\n\r\n%date%, %time% - N°5: Missed voice call\r\n\r\n%date%, %time% - N°5: A4, staat uw interviewaanbod nog steeds?\r\n\r\n%date%, %time% - N°5: Ik wil praten...\r\n\r\n%date%, %time% - N°5: Ik wil met de pers spreken namens de madammen… N°5\r\n\r\n%date%, %time% - A4: Missed voice call\r\n\r\n%date%, %time% - A4: Ja zeker.\r\n\r\n%date%, %time% - A4: Waar en wanneer?', 'deschuine1'),
(34, 3078, '%date%, %time% - N°5: Ik heb een combinatie opgezet ;)\r\n\r\n%date%, %time% - N°5: Kom D3 vanavond maar ophalen, bij mij thuis.\r\n\r\n%date%, %time% - K1: Goed werk N°5, we vormen een prima team.\r\n\r\n%date%, %time% - K1: Zie je straks', 'deschuine'),
(35, 3276, '%date%, %time% - K1: Fuck N5!!!! Wat heb je gedaan ?\r\n\r\n%date%, %time% - K1: Waar is D3\r\n\r\n%date%, %time% - K1: ??\r\n\r\n%date%, %time% - N°5: Als je je schaakbord dan toch wilt ontdoen van de madammen, zal ik je helpen.\r\n\r\n%date%, %time% - N°5: Vaarwel. N°5', 'deschuine1'),
(36, 3278, '%date%, %time% - K1: Verdomme, N°5 is er van door!\r\n\r\n%date%, %time% - K1: D3 is niet hier.\r\n\r\n%date%, %time% - C4: ‘Genie is: de regels op het juiste moment weten te overtreden.’\r\n\r\n%date%, %time% - C4: NIMZOWITSCH BOEK VIII. VERS XVII.\r\n\r\n%date%, %time% - K1: C4...\r\n\r\n%date%, %time% - K1: Houd je muil.', 'deschuine'),
(37, 3503, 'THE GAME IS ROTTEN\r\n\r\n%date%, %time% - Koning: Ik verdubbel de bedragen.\r\n\r\n%date%, %time% - Koning: We moeten elkaar gauw ontmoeten.\r\n\r\n%date%, %time% - De Schuine: Tot u dienst, Majesteit.', 'deschuine1'),
(39, 1458, 'Intercepted & transmitted by De Schuine:', 'deschuine1'),
(40, 2427, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(41, 3077, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(42, 747, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(43, 767, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(44, 972, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(45, 2026, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(46, 3277, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(47, 3275, 'Intercepted & transmitted by De Schuine:', 'deschuine1'),
(48, 2128, 'Intercepted & transmitted by De Schuine:', 'deschuine'),
(49, 2602, 'Intercepted & transmitted by De Schuine:', 'deschuine1'),
(50, 3232, 'Intercepted & transmitted by De Schuine:', 'deschuine11'),
(51, 3233, '%date%, %time% - Van H8: Fase 2 van het protocol is achter de rug.\r\n\r\n%date%, %time% - Van H8: De koning van de zwarte kant heeft geen keus. Ons plan werkt perfect.\r\n\r\n%date%, %time% - WhiteQueen: Uitstekend werk. Felicitaties. Zet het plan door.\r\n\r\n%date%, %time% - Van H8: Goed ik neem later weer contact op.', 'deschuine11'),
(52, 1453, 'Intercepted & transmitted by De Schuine:', 'deschuine1'),
(53, 1454, '%date%, %time% - B2 (Assistent Zwart Huis): Hallo chef, de opname met de stem van de premier minister is ontdekt door twee pionnen… Wat nu?\r\n\r\n%date%, %time% - Van H8: Ik zorg dat het wordt opgelost. Dank', 'deschuine1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
